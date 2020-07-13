<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>FUND MY LAPTOP | T & C</title>
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous"> -->
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@500&display=swap" rel="stylesheet">
    @include('includes.styles')

    @stack('styles')

</head>

<body>
@include('includes.auth-header')

<main class="main-content d-sm-flex ">
    <form class="login-box p-md-5 p-2"  method="POST" action="{{ route('login') }}">
        <h2 class="p-sm-3 p-1 welcome-text">Welcome to <br> <strong>Fund my Laptop</strong></h2>
    
        <p class="p-1 p-md-3 login-text mt-md-n4">Help Achieve Your dreams with funding for your laptops at little to no cost.</p>
        <div>
            <a href="#" class="text-center py-3 btn-google d-flex justify-content-center align-items-center">
            <img class="pr-3" src="../img/google icon.svg" alt="">
            Login with Google
            </a>
        </div>

        <div class="my-4 text-center or d-flex align-items-center or-box">
            <hr/>
            <span class="or-text">
            or
            </span>
            <hr/>
        </div>

        <div class="form-group">
            <input type="email" placeholder="Email" name="email" class="form-control" id="email">
            <p id="errorEmail" class="error  text-danger text-center text-sm-left"> </p>
        </div>
        <div class="form-group">
            <input type="password" placeholder="Password" name="password" class="form-control" id="password">
            <p id="errorPassword" class="error text-danger text-center text-sm-left">
                
            </p>
        </div>
        <div>
            <input type="submit" class="form-control login-btn  btn-fml-secondary" value="Log in">
        </div>
        <p class="account-info-text text-center py-4">Don't have an account? <a href="#" class="sign-up-link">Sign up</a></p>
       
        <!-- <div id="error" class="error p-1 "></div>
        </div> -->

    </form>

    <div class="login-img-box d-none d-md-block">
        <img src="../img/login-img.png" class="login-img" alt="login FundMyLaptop">
    </div>

</main>
@include('includes.footer')

@include('includes.scripts')

@stack('scripts')

</body>

</html>
    