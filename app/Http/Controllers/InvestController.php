<?php

namespace App\Http\Controllers;

use App\Notifications\sendPaymentDetailsEmail;
use App\Request as FundRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Paystack;
use App\Transaction;
use App\User;
use Illuminate\Support\Facades\Notification;

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
        $request = FundRequest::where('id', $id)->with('user')->first();
        $metadata = [
            'funder_id' => $user->id,
            'request_id' => $id,
            'requester_id' => $request->user->id
        ];
        return view('payment', compact('user', 'request', 'metadata'));
    }

    public function redirectToGateway(Request $request)
    {
        //dd($request->amount);
        $rules = array(
            'amount'      => 'required'
        );
        $validator = Validator::make($request->all(), $rules);

        if (!$validator->fails()) {
            $request->amount = $request->amount * 100;
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
        $user = Auth::user();

        $trans->request_id       = $paymentDetails['data']['metadata']['request_id'];
        $trans->user_id     = $paymentDetails['data']['metadata']['funder_id'];
        $trans->transaction_ref    = $paymentDetails['data']['reference'];
        $trans->status      = $paymentDetails['data']['status'];
        $trans->amount      = ($paymentDetails['data']['amount'])/100;
        $trans->response_code       = 200;
        $saved = $trans->save();

        if($saved){
        $request = FundRequest::where('id', $trans->request_id)->with('user')->first();
            $details = [
                'greeting' => 'Hi ' . $user->firstName,
                'body' => 'Your investment of ' . $trans->amount . 'in '. $request->user->firstName . '\'s campaign -' . url(`/campaign/$trans->request_id`). '- has been acknowledged',
                'thanks' => 'Thank you for trusting fundmylaptop.com!',
            ];

            $trans->notify(new sendPaymentDetailsEmail($details), $user->email);

            //dd($trans->notifications);

            return redirect()->route('campaign', $trans->request_id);
        }
        // else{
        //     dd('Not saved');
        
        // }

    }

}
