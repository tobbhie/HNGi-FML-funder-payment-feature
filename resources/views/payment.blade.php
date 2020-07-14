@extends('layout.app')

@push('styles')
    <link rel="stylesheet" href="{{asset('css/custom-css/payment-page.css')}}">
@endpush


@section('content')

    <div class="container mx-auto mb-5" style="margin-top: 88px;">
        <header>
            <h1 id="title" class="mt-5 mb-4">Fund {{ $request->user->firstName }} {{ $request->user->lastName }}'s Laptop Purchase</h1>

            <h3 class="text-muted">Loan Amount</h3>
            <p style="font-size: 2rem;"><strong>&#x20A6; {{ $request->amount }}</strong></p>
        </header>
        <div class="row">
            <div class="col-md-6 mt-4">
                <!-- Video -->
                <div class="video embed-responsive-4by3">
                    <img class="img img-fluid" src="../img/video-placeholder.png" alt="video-placeholder">
                    <!-- <iframe src="" frameborder="0"></iframe> -->
                </div>

                <p class="my-4" id="creationDate">{{ $request->created_at }}</p>
                <hr>

                <div class="user-info my-4">
                    <img src="../img/card-image (4).png" height="40px" width="40px" alt="user photo"
                         class="img-icon rounded-circle">
                    <p class="m-0">{{ $request->user->firstName }} {{ $request->user->lastName }}</p>
                </div>

                <div class="repayment-info">
                    <h3 class="text-muted">Proposed Repayment Period:</h3>
                    <p>3 months</p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="alert alert-danger d-none" style="padding: 0.5rem 1rem;" id="alert" role="alert">
                    <p class="my-0" id="alertMessage"></p>
                </div>
            <form action="{{ route('campaign/pay') }}" class="payment-form d-flex flex-column p-4" method="POST" novalidate>
                @csrf
                    <div class="form-group mb-4">
                        <label class="form__label" for="amount">Amount</label>
                        <div class="input-group">
                            <span class="input-group-text" id="selectedCurrency">&#x20A6;</span>
                            <input name="amount" class="form-control form-control-lg form__input" type="number" id="amount"
                                   value="{{ $request->amount}}" required>
                            <select class="input-group-text" id="chooseCurrency">
                                <option value="NGN" selected>NGN</option>
                                <option value="USD">USD</option>
                                <option value="GBP">GBP</option>
                                <option value="EUR">EUR</option>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="form-group mb-2">
                        <label class="form__label" for="fullName">Full Name</label>
                        <input name="first_name" class="form-control form-control-lg form__input" type="text" id="fullName"
                               value="{{ $user->firstName }} {{ $user->lasttName }}">
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="form-group mg-4">
                        <input class="" type="checkbox" id="stayAnonymous">
                        <label class="form__label" for="stayAnonymous">Donate Anonymously</label>
                    </div>


                    <div class="form-group mb-4">
                        <label class="form__label" for="email">Email Address</label>
                        <input name="email" class="form-control form-control-lg form__input" type="email" id="email"
                               value="{{ $user->email }}" disabled>
                        <div class="invalid-feedback"></div>
                    </div>
                    <input type="hidden" name="quantity" value="1">
                    <input type="hidden" name="email" value="{{ $user->email }}">
                    <input id="orderid" type="hidden" name="orderID">
                    <input type="hidden" name="metadata" value="{{ json_encode($metadata)}}" >
                    <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}">


                    <!-- <h3>Select Payment Method</h3> -->

                    <button class="btn btn-danger btn-lg mx-auto btn-block my-4 form__button" type="submit">Pay &#x20A6;</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        const orderId = document.getElementById('orderid');

        orderId.value = Math.floor(Math.random()*10000001);

    </script>

@endsection
