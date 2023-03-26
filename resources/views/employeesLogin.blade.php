<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="{{ asset('/css/employeesLogin.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ URL('/assets/frontend/scpi.webp')}}" type="image/x-icon">
    @include('cdn')
    <title>Tara Na</title>
</head>
<body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-8 left text-white text-center">
                 
                </div>
                <div class="col-4 right text-center px-5">
                    <a class='homeButton2' href="/" data-title='Back to Home?'><i class="bi bi-house"></i></a>
                    <form class="employeesLoginForm" name="employeesLoginForm" id="employeesLoginForm">
                        @csrf
                        <img class="border-0 logo mt-5 pt-2" src="{{ URL('/assets/frontend/scpi.webp')}}">
                        <h5 class="welcome">Employees Portal</h5>
                        <div class="form-floating mb-3 mt-4 textBox pt-2 text-start">
                            <input type="email" required class="form-control" name="employeesEmail" id="employeesEmail" placeholder="Email" required>
                            <label for="floatingInput" class="text-muted">Email</label>
                        </div>
                        <div class="form-floating mb-3 text-start">
                            <input type="password" required class="form-control" name="employeesPassword" id="employeesPassword" placeholder="Password" required>
                            <label for="floatingInput" class="text-muted">Password</label>
                        </div>
                        <div class="mb-3 checkBox text-start my-4">
                            <input type="checkbox" class="form-check-input ms-1" onclick="seePassword()">
                            <label class="form-check-label fw-bold">Show Password</label>
                        </div>
                        <div class="mb-2">
                            <button type="submit" class="btn loginBtn mt-2" name="employeesLoginBtn" id="employeesLoginBtn">LOGIN</button>
                        </div>
                        <div class="mb-4 forgot mt-4">
                            <ul class="navbar-nav ms-auto"><li class="nav-item fw-bold"><a class="nav-link" href="employeesForgotPassword">Forgot Password?</a></li></ul>
                        </div>
                        <div class="mb-4 version">
                            <p class="fw-bold">v1.0</p>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <script src="{{ asset('/js/employeesLogin.js') }}"></script>
</body>
</html>