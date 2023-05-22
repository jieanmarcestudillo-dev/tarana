<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
                            {{-- <button class="btn btn-lg text-white" id="sidebarToggle"><i class="fa-solid fa-bars"></i></button> --}}
                            <h4 class="ms-2">RECRUITER DASHBOARD</h4>
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
                    <div class="container-fluid mainBar">
                        <div class="row mb-3">
                            <div class="col-3">
                                <div class="card shadow" style="height:8rem; border-radius:10px; background-color:#ffff;">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-4">
                                                <i class="fa-solid fa-ship"></i>
                                            </div>
                                            <div class="col-8 text-center" style="line-height:19px; padding-top:1.4rem">
                                                <p class="card-text fw-bold" style="font-size: 2rem; color:#D72323;" id="totalScbeduledOperation"></p>
                                                <p class="card-text fw-bold" style="font-size: 13px; color:#D72323;">SCHEDULE OPERATION</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="card shadow" style="height:8rem; border-radius:10px; background-color:#ffff;">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-3">
                                                <i class="fa-regular fa-square-check"></i>
                                            </div>
                                            <div class="col-9 text-center" style="line-height:19px; padding-top:1.4rem">
                                                <p class="card-text fw-bold" style="font-size: 2rem; color:#D72323;" id="totalPendingInvitation"></p>
                                                <p class="card-text fw-bold" style="font-size: 13px; color:#D72323;">PENDING INVITATION</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="card shadow" style="height:8rem; border-radius:10px; background-color:#ffff;">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-4">
                                                <i class="fa-regular fa-square-check"></i>
                                            </div>
                                            <div class="col-8 text-center" style="line-height:19px; padding-top:1.4rem">
                                                <p class="card-text fw-bold" style="font-size: 2rem; color:#D72323;" id="totalDecline"></p>
                                                <p class="card-text fw-bold" style="font-size: 13px; color:#D72323;">DECLINE INVITATION</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="card shadow" style="height:8rem; border-radius:10px; background-color:#ffff;">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-4">
                                                <i class="fa-solid fa-users"></i>
                                            </div>
                                            <div class="col-8 text-center" style="line-height:19px; padding-top:1.4rem">
                                                <p class="card-text fw-bold" style="font-size: 2rem; color:#D72323;" id="totalBackout"></p>
                                                <p class="card-text fw-bold" style="font-size: 13px; color:#D72323;">BACK OUT</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card rounded-0">
                            <ul class="nav nav-tabs mt-4">
                                <li class="nav-item">
                                    <a class="nav-link align-middle text-secondary active" href="/recruiterDashboardRoutes">Pending Invitation <span class="badge rounded-circle bg-secondary align-middle"></span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link align-middle text-dark active" href="#">&nbsp;&nbsp;Back Out On Operation&nbsp;&nbsp; <span class="badge rounded-circle bg-secondary align-middle"></span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link align-middle text-secondary active" href="/recruiterApplicantDeclinedRoutes">Declined Invitation <span class="badge rounded-circle bg-secondary align-middle"></span></a>
                                </li>
                            </ul>
                            <div class="mb-3">
                                <div class="card p-4 rounded-0" id="fetchAllApplicantsBackout"></div>
                            </div>
                        </div>
                    </div>
                {{-- MAIN CONTENT --}}
            </div>
        {{-- END MAIN CONTENT --}}
    </div>

    {{-- JS --}}
        <script src="{{ asset('/js/dateTime.js') }}"></script>
        <script src="{{ asset('/js/recruiter/backout.js') }}"></script>
        <script src="{{ asset('/js/logout.js') }}"></script>
    {{-- END JS --}}

    {{-- MODAL --}}
        {{-- VIEW REASON --}}
            <div class="modal fade" id="backOutReasonModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-2 ms-auto">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                        </div>
                        <div class="row text-center">
                            <p class="my-4" id="backOutReason"></p>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        {{-- VIEW REASON --}}
    {{-- MODAL --}}
</body>
</html>