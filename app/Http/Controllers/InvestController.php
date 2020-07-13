<?php

namespace App\Http\Controllers;

use App\Request as FundRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

}
