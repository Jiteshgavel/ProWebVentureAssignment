<?php

namespace App\Http\Controllers;

use Session;
use Exception;
use Razorpay\Api\Api;
use Illuminate\Http\Request;

class RazorpayPaymentController extends Controller
{
    public function index()
    {
        return view('razorpayView');
    }
    public function store(Request $request)
    {
        $input = $request->all();

        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        $payment = $api->payment->fetch($input['razorpay_payment_id']);

        if (count($input) && !empty($input['razorpay_payment_id'])) {
            try {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount' => $payment['amount']));

            } catch (Exception $e) {
                return $e->getMessage();
                Session::put('error', $e->getMessage());
                return redirect()->back();
            }
        }

        Session::flash('success', 'Payment successful');
        return redirect()->back();
    }
}
