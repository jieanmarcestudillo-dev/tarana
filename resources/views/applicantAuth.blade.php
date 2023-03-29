<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('/css/applicantLogin.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="shortcut icon" href="{{ URL('/assets/frontend/logoo.webp')}}" type="image/x-icon">
    @include('cdn')
    <title>TARA NA</title>
</head>
<body>
    {{-- CONTENT --}}
        <div class="back-image">
            <img src="./assets/frontend/background2.webp" alt="background image">
        </div>
        {{-- FOR REGISTRATION --}}
            <section class="left">
                <section class="side login">
                    {{-- <img src="./assets/frontend/login.webp"> --}}
                </section>
                <section class="main register">
                    <div class="container">
                        <a class='homeButton2' href="/" data-title='Back to Home?'><i class="bi bi-house"></i></a>
                        <form name="applicantRegistrationForm" id="applicantRegistrationForm">
                            @csrf
                            <p class="title mt-lg-3">CREATE ACCOUNT</p>
                            <div class="mb-3">
                                <input type="email" class="form-control rounded-pill" required id="applicantSignUpEmail" name="applicantSignUpEmail" placeholder="Email">
                            </div>
                            <div class="mb-3">
                                <input type="password" class="form-control rounded-pill" required id="applicantSignUpPassword" name="applicantSignUpPassword" placeholder="Password">
                            </div>
                            <div class="mb-3">
                                <input type="password" class="form-control rounded-pill" required id="applicantSignUpConfirmPassword" name="applicantSignUpConfirmPassword" placeholder="Confirm Password">
                            </div>
                            <div class="mb-3 checkBox">
                                <input type="checkbox" class="form-check-input ms-1" onclick="seePassword()">
                                <label class="form-check-label">Show Password</label>
                            </div>
                                <button type="submit" class="btn rounded-pill">SUBMIT</button>
                            <ul class="navbar-nav text-center">
                                <li class="nav-item"><a href="#" class="nav-link bottomLink">Already Have an Account?</a></li>
                            </ul>
                        </form>
                    </div>
                </section>
            </section>
        {{-- FOR REGISTRATION --}}

        {{-- FOR LOGIN --}}
            <section class="right">
                <section class="side register">
                    {{-- <img src="./assets/frontend/signup.webp"> --}}
                </section>
                <section class="main login">
                    <div class="container">
                        <a class='homeButton' href="/" data-title='Back to Home?'><i class="bi bi-house"></i></a>
                        <img class="border-0 logo" src="{{ URL('/assets/frontend/scpi.webp')}}">
                        <p class="title mt-lg-3">APPLICANT PORTAL</p>
                        <form name="applicantLoginForm" id="applicantLoginForm">
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" name="applicantEmail" id="applicantEmail" placeholder="Email" required>
                                <label for="floatingInput" class="text-muted">Email</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" name="applicantPassword" id="applicantPassword" placeholder="Password" required>
                                <label for="floatingInput" class="text-muted">Password</label>
                            </div>
                            <div class="mb-3 checkBox">
                                <input type="checkbox" class="form-check-input ms-1" onclick="seePassword2()">
                                <label class="form-check-label">Show Password</label>
                            </div>
                            <ul class="navbar-nav text-center">
                                <li class="nav-item"><a href="/forgotPasswordRoutes" class="nav-link">Forgot Password?</a></li>
                            </ul>
                                <button type="submit" id="appLoginBtn" name="appLoginBtn" class="btn rounded-pill">LOGIN</button>
                            <ul class="navbar-nav text-center">
                                <li class="nav-item"><a href="#" class="nav-link bottomLink">Create Your Account</a></li>
                            </ul>
                        </form>
                    </div>
                </section>
            </section>
        {{-- FOR LOGIN --}}
    {{-- END OF CONTENT --}}

    {{-- JS --}}
        <script src="{{ asset('/js/applicantsAuthentications.js') }}"></script>
    {{-- JS --}}
</body>
</html>