<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @include('cdn')
    {{-- CSS --}}
    <link href="{{ asset('/css/recruiter/recruiterDashboard.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ URL('/assets/frontend/logoo.webp')}}" type="image/x-icon">
    @include('cdn')
    {{-- CSS --}}
    <title>TARA NA</title>
</head>
<body>
    
    <div class="d-flex" id="wrapper">
        {{-- SIDE NAV --}}
            @include('layouts.recruiterSidebar')
        {{-- SIDE NAV --}}

        {{-- MAIN CONTENT --}}
            <div id="page-content-wrapper">
                <div class="loader"></div>
                {{-- NAV BAR --}}
                    <nav class="navbar navbar-expand-lg text-white border-bottom">
                        <div class="container-fluid">
                            <h4 class="ms-2">CREDENTIALS</h4>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                                    <li>
                                        <a class="nav-link me-3">
                                            <span>{{ auth()->guard('employeesModel')->user()->firstname}}</span>
                                            <span>{{ auth()->guard('employeesModel')->user()->lastname}}</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                {{-- NAV BAR --}}

                {{-- MAIN CONTENT --}}
                    <div class="container-fluid mainBar mb-3">
                        <div>
                            <div class="card bg-light p-5 bg-body rounded-0 shadow-lg">
                                <h5 class="mb-4 text-lg-start text-center">PERSONAL INFORMATION</h4>
                                <ul class="nav nav-tabs mb-4 text-lg-start text-center">
                                    <li class="nav-item">
                                        <a class="nav-link" href="/recruiterDetailsRoutes">&nbsp;&nbsp;Information&nbsp;&nbsp;</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#">Credentials</a>
                                    </li>
                                </ul>
                                <form id='usersPasswordForm' name='usersPasswordForm'>
                                    <div class="row g-1">
                                        <div class="col-auto">
                                            <input type="password" class="form-control rounded-0" id="currentPassword" name="currentPassword" placeholder="Current Password">
                                        </div>
                                        <div class="col-auto">
                                            <input type="password" class="form-control rounded-0" id="newPassword" name="newPassword" placeholder="New Password">
                                        </div>
                                        <div class="col-auto">
                                            <input type="password" class="form-control rounded-0" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password">
                                        </div>
                                    </div>
                                    <div class="col-auto mt-3">
                                        <button type="button" onclick="seePassword()" class="btn btn-secondary rounded-0 px-4 py-1">Show</button>
                                        <button type="submit" class="btn btn-primary rounded-0 px-3 py-1">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                {{-- MAIN CONTENT --}}
            </div>
        {{-- END MAIN CONTENT --}}
    </div>

    {{-- JS --}}
        <script src="{{ asset('/js/dateTime.js') }}"></script>
        <script src="{{ asset('/js/recruiter/manageAccount.js') }}"></script>
        <script src="{{ asset('/js/logout.js') }}"></script>
    {{-- END JS --}}
</body>
</html>