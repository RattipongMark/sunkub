<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class DepositController extends Controller
{
    public function index()
    {
        $ports = DB::table('ports')->get(); // Fetch portfolios from 'ports' table
        return view('deposit_form', compact('ports'));
    }

    public function processDeposit(Request $request)
    {
        // Validate input
        $validator = Validator::make($request->all(), [
            'port_ids.*' => 'required|exists:ports,port_id', // Check if each port_id exists in the ports table
            'port_amounts.*' => 'nullable|numeric|min:0', // Allow empty or numeric values for port amounts
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Start a database transaction
        DB::beginTransaction();

        try {
            $userId = 1;//Auth::id(); // Get the authenticated user's ID
            $timestamp = now(); // Current timestamp

            // Initialize variables for deposit details
            $totalAmount = 0;

            // Process deposit for each selected port
            foreach ($request->input('port_ids') as $port_id) {
                $amount = $request->input('port_amounts.' . $port_id);

                if ($amount !== null && $amount > 0) { // Check if an amount is provided for the port
                    // Update portfolio balance
                    DB::table('ports')
                        ->where('port_id', $port_id)
                        ->increment('balance', $amount);

                    // Update the updated_at column
                    DB::table('ports')
                        ->where('port_id', $port_id)
                        ->update(['updated_at' => now()]);

                    // Accumulate the total amount deposited
                    $totalAmount += $amount;
                }
            }

            // Generate a single deposit_id for this transaction
            $deposit_id = DB::table('deposit_details')->insertGetId([
                'user_id' => $userId,
                'payment_amount' => $totalAmount,
                'timestamp' => $timestamp,
            ]);

            // Save payment details for each port
            foreach ($request->input('port_ids') as $port_id) {
                $amount = $request->input('port_amounts.' . $port_id);

                if ($amount !== null && $amount > 0) {
                    DB::table('payment_details')->insert([
                        'deposit_id' => $deposit_id,
                        'port_id' => $port_id,
                        'amount' => $amount,
                    ]);
                }
            }

            // Commit the transaction
            DB::commit();

            return redirect()->back()->with('success', 'Payment processed successfully.');
        } catch (\Exception $e) {
            // Rollback the transaction if an exception occurs
            DB::rollback();

            // Log the exception for debugging (optional)
            logger()->error('Deposit processing error: ' . $e->getMessage());

            // Display a user-friendly error message
            return redirect()->back()->with('error', 'An error occurred while processing deposits.');
        }
    }
}
