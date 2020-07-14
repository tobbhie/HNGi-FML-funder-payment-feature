<?php

namespace App\Http\Controllers;

use App\Request as FundRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Paystack;
use App\Transaction;
use App\User;
use Session;


class InvestController extends Controller
{
    public function __construct()
    {
        //allows only authenticated user
        $this->middleware('auth');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function fund($id)
    {
        $user = Auth::user();
        //$request = FundRequest::where('id', $id)->with('user')->first();
        return view('payment')->with('user', $user);
    }

    public function redirectToGateway(Request $request)
    {
        $rules = array(
            'amount'      => 'required'
        );
        $validator = Validator::make($request->all(), $rules);

        if (!$validator->fails()) {
            return Paystack::getAuthorizationUrl()->redirectNow();
        }        
    }

    /**
     * Obtain Paystack payment information
     * @return void
     */
    public function handleGatewayCallback(Transaction $trans)
    {
        $paymentDetails = Paystack::getPaymentData();

        //dd($paymentDetails);

        $fundRequest = FundRequest::where('user_id', Auth::user()->id)->first();

        $trans->request_id       = $fundRequest->id;
        $trans->user_id     = $fundRequest->user_id;
        $trans->transaction_ref    = $paymentDetails['data']['reference'];
        $trans->status      = $paymentDetails['data']['status'];
        $trans->amount      = $paymentDetails['data']['amount'];
        $trans->response_code       = 200;
        $saved = $trans->save();

        if($saved){
            return redirect()->route('home');
        }
        // else{
        //     dd('Not saved');
        
        // }

    }

}
