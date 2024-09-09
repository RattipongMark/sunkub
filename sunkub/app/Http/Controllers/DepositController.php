<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class DepositController extends Controller
{
    public function depositpage(Request $request)
    {
        $user = $request->user();
        $userId = $user->id;

        // SELECT * FROM ports WHERE user_id = user_id_value;
        $ports = DB::table('ports')->where('user_id', $userId)->get(); 

        // SELECT * FROM paymentmethods WHERE user_id = user_id_value;
        $paymentMethods = DB::table('paymentmethods')->where('user_id', $userId)->get(); 

        return view('real_pages.user_wallet_deposit_details', compact('user', 'ports', 'paymentMethods'));
    }

    public function processDeposit(Request $request)
    {
        try {
            logger()->info('Deposit process initiated.');
            DB::beginTransaction();

            $user = $request->user();
            $userId = $user->id;
            $timestamp = now(); 

            $cardNumber = $request->input('card_number');
            logger()->info('Card number received: ' . $cardNumber);
            if ($cardNumber === 'new') {
                logger()->info('new card.');
                $cardNumber = $request->input('card_number_new');
                logger()->info('Card number received: ' . $cardNumber);
                $firstName = $request->input('first_name');
                $lastName = $request->input('last_name');
                $expiryMonth = $request->input('expiry_month');
                $expiryYear = $request->input('expiry_year');
                $cvv = $request->input('cvv');

                // INSERT INTO paymentmethods (user_id, card_number, first_name, last_name, expiry_month, expiry_year, cvv)
                // VALUES (user_id_value, 'card_number_value', 'first_name_value', 'last_name_value', expiry_month_value, expiry_year_value, 'cvv_value');
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

            $totalAmount = 0;
            $portsData = [];
            foreach ($request->input('port_ids') as $portId) {
                $amount = $request->input('port_amounts.' . $portId);

                if ($amount !== null && $amount > 0) { 

                    // UPDATE ports SET balance = balance + amount WHERE port_id = $portId;
                    DB::table('ports')->where('port_id', $portId)->increment('balance', $amount);

                    $totalAmount += $amount;

                    // SELECT * FROM ports WHERE port_id = $portId LIMIT 1;
                    $port = DB::table('ports')->where('port_id', $portId)->first();
                    $portsData[] = [
                        'id' => $port->port_id,
                        'name' => $port->user_broker,
                        'balance' => $port->balance,
                        'amount_deposited' => $amount
                    ];
                }
            }

            // INSERT INTO deposit_details (user_id, payment_amount, card_number, timestamp)
            // VALUES (user_id_value, total_amount_value, 'card_number_value', timestamp_value);

            // SELECT LAST_INSERT_ID();
            $deposit_id = DB::table('deposit_details')->insertGetId([
                'user_id' => $userId,
                'payment_amount' => $totalAmount,
                'card_number' => $cardNumber,
                'timestamp' => $timestamp,
            ]);

           
            foreach ($request->input('port_ids') as $port_id) {
                $amount = $request->input('port_amounts.' . $port_id);
                if ($amount !== null && $amount > 0) {

                    // INSERT INTO payment_details (deposit_id, port_id, amount)
                    // VALUES (deposit_id_value, port_id_value, amount_value);
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

            return view('real_pages.depositCom', [
                'user' => $user,
                'totalAmount' => $totalAmount,
                'cardNumber' => $cardNumber,
                'portsData' => $portsData,
            ]);


            // return redirect()->back()->with('success', 'Payment processed successfully.');
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
