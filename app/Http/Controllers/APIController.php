<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MpesaResponse;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class APIController extends Controller
{
	// Call the python script that reqeusts the STK push menu
    public function callPy(){
    	$phone_number = 254724442515;
    	$process = new Process(['python3', '/var/www/pyscripts/mpesa_api.py', $phone_number]);
    	$process->run();
		// executes after the command finishes
    	if (!$process->isSuccessful()) {
    		throw new ProcessFailedException($process);
    	}

    	return $process->getOutput();
    }
    public function parseCallback(){
    	if ($request->input('Body.stkCallback.ResultCode') == 0) {
	    $transaction_amount = array_values($request->input('Body.stkCallback.CallbackMetadata.Item')[0] )[1];
	     $mpesa_receipt_number = array_values($request->input('Body.stkCallback.CallbackMetadata.Item')[1] )[1];
	     $balance = !empty(array_values($request->input('Body.stkCallback.CallbackMetadata.Item')[2] )[1]) ? array_values($request->input('Body.stkCallback.CallbackMetadata.Item')[2])[1] : null;
	     $transaction_date = array_values($request->input('Body.stkCallback.CallbackMetadata.Item')[3] )[1];
	     $phone_number = array_values($request->input('Body.stkCallback.CallbackMetadata.Item')[4] )[1];
	         $query = new MpesaResponse;
             $query -> responseData = json_encode($request->input('Body'));
             $query -> result_code = $request->input('Body.stkCallback.ResultCode');
             $query -> result_description = $request->input('Body.stkCallback.ResultDesc');
             $query -> checkout_request_id = $request->input('Body.stkCallback.CheckoutRequestID');
             $query -> merchant_request_id = $request->input('Body.stkCallback.MerchantRequestID');
             $query -> phone_number = $phone_number;
             $query -> transaction_amount = $transaction_amount;
             $query -> mpesa_receipt_number = $mpesa_receipt_number;
             $query -> balance = $balance;
             $query -> transaction_date = date("F j, Y, g:i a",strtotime($transaction_date));
	         $query -> save();
        }
    	else{
            $query = new MpesaResponse;
            $query -> responseData = json_encode($request->input('Body'));
            $query -> result_code = $request->input('Body.stkCallback.ResultCode');
            $query -> result_description = $request->input('Body.stkCallback.ResultDesc');
	        $query -> checkout_request_id = $request->input('Body.stkCallback.CheckoutRequestID');
	        $query -> merchant_request_id = $request->input('Body.stkCallback.MerchantRequestID');
            $query -> save();
        }
    }
}
