<?php

namespace App\Http\Controllers;

use App\Request as FundRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{
    public function __construct()
    {
        //allows only authenticated user
        $this->middleware('auth');
    }

/*     public function index()
    {
        $query = FundRequest::with('user')->paginate(30);

        return response()->json([
            'message' => 'Requests retrieved',
            'data' => $query
        ], 200);
    } */
    public function show($id)
    {
        $request = FundRequest::where('id', $id)->with('user')->first();
        return view('campaign')->with('request', $request); 
    }
}
