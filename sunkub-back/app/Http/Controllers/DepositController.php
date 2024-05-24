<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class DepositController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user(); 
        $userId = $user->id;
        $ports = DB::table('ports')->where('user_id', $userId)->get(); // Fetch portfolios for user ID 1
        $paymentMethods = DB::table('paymentmethods')->where('user_id', $userId)->get(); // Fetch payment methods for user ID 1

        return view('deposit_form', compact('ports', 'paymentMethods'));
    }

    public function processDeposit(Request $request)
{
    try {
        logger()->info('Deposit process initiated.');

        // $validator = Validator::make($request->all(), [
        //     'port_ids.*' => 'required|exists:ports,port_id', // Check if each port_id exists in the ports table
        //     'port_amounts.*' => 'nullable|numeric|min:0', // Allow empty or numeric values for port amounts
        //     'card_number' => 'required|string', // Validate the selected payment method
        //     'card_number_new' => 'required_if:card_number,new|digits:16', // Validate card number only if a new method is added
        //     'first_name' => 'nullable|string|max:255', // Validate card holder first name
        //     'last_name' => 'nullable|string|max:255', // Validate card holder last name
        //     'expiry_month' => 'nullable|integer|min:1|max:12', // Validate expiry month
        //     'expiry_year' => 'nullable|integer|min:' . date('Y') . '|max:' . (date('Y') + 10), // Validate expiry year
        //     'cvv' => 'nullable|digits:3', // Validate CVV
        // ]);

        // if ($validator->fails()) {
        //     logger()->error('Validation failed: ' . $validator->errors()->first());
        //     return redirect()->back()->withErrors($validator)->withInput();
        // }

        // Start a database transaction
        DB::beginTransaction();

        $userId = $user->id;
        $timestamp = now(); // Current timestamp

        // Determine card number
        $cardNumber = $request->input('card_number');
        logger()->info('Card number received: ' . $cardNumber);
        if ($cardNumber === 'new') {
            logger()->info('new card.');
            // Handle adding a new payment method
            $cardNumber = $request->input('card_number_new');
            logger()->info('Card number received: ' . $cardNumber);
            $firstName = $request->input('first_name');
            $lastName = $request->input('last_name');
            $expiryMonth = $request->input('expiry_month');
            $expiryYear = $request->input('expiry_year');
            $cvv = $request->input('cvv');

            // Insert new payment method into the database
            DB::table('paymentmethods')->insert([
                'user_id' => $userId,
                'card_number' => $cardNumber,
                'first_name' => $firstName,
                'last_name' => $lastName,
                'expiry_month' => $expiryMonth,
                'expiry_year' => $expiryYear,
                'cvv' => $cvv,
            ]);
        }

        // Initialize variables for deposit details
        $totalAmount = 0;

        // Process deposit for each selected port
        foreach ($request->input('port_ids') as $portId) {
            $amount = $request->input('port_amounts.' . $portId);

            if ($amount !== null && $amount > 0) { // Check if an amount is provided for the port
                // Update portfolio balance
                DB::table('ports')->where('port_id', $portId)->increment('balance', $amount);

                // Accumulate the total amount deposited
                $totalAmount += $amount;
            }
        }

        // Save deposit details with card number
        $deposit_id = DB::table('deposit_details')->insertGetId([
            'user_id' => $userId,
            'payment_amount' => $totalAmount,
            'card_number' => $cardNumber, // Store the card number
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

        logger()->info('Deposit process completed successfully.');

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