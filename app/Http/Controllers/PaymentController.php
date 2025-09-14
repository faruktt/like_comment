<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    public function pay(Request $request)
    {
        // Validate amount
        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        $tran_id = uniqid('tran_'); // unique transaction id
        $amount = $request->amount;

        $data = [
            'store_id' => 'testbox',        // Sandbox Store ID
            'store_passwd' => 'qwerty',    // Sandbox Password
            'total_amount' => $amount,
            'currency' => 'BDT',
            'tran_id' => $tran_id,
            'success_url' => url('/success'),
            'fail_url' => url('/fail'),
            'cancel_url' => url('/cancel'),
            'cus_name' => auth()->guard('customer')->user()->name ?? 'Customer',
            'cus_email' => auth()->guard('customer')->user()->email ?? 'customer@example.com',
            'cus_add1' => 'Customer Address',
            'cus_phone' => '017xxxxxxxx',
        ];

        // Send request to SSLCommerz
        $response = Http::asForm()->post('https://sandbox.sslcommerz.com/gwprocess/v4/api.php', $data);

        $res = $response->json();

        if (isset($res['GatewayPageURL']) && !empty($res['GatewayPageURL'])) {
            // Redirect user to payment page
            return redirect($res['GatewayPageURL']);
        } else {
            // Payment initiation failed, debug response or show error
            return back()->with('error', 'Failed to initiate payment. ' . ($res['failedreason'] ?? 'Unknown error'));
        }
    }

    public function success(Request $request)
    {
        // Handle payment success here (e.g. verify payment, save data)
        return "Payment Success!";
    }

    public function fail(Request $request)
    {
        // Handle payment failure here
        return "Payment Failed!";
    }

    public function cancel(Request $request)
    {
        // Handle payment cancellation here
        return "Payment Cancelled!";
    }
}
