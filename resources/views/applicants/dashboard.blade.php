<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('cdn')
    {{-- CSS --}}
        <link href="{{ asset('/css/applicants/applicantsDashboard.css') }}" rel="stylesheet">
        <link href="{{ asset('/css/applicants/sideBar.css') }}" rel="stylesheet">
        <link rel="shortcut icon" href="{{ URL('/assets/frontend/logoo.webp')}}" type="image/x-icon">
    {{-- CSS --}}
    <title>TARA NA</title>
</head>
<body>

    <div class="d-flex" id="wrapper">
        {{-- SIDE NAV --}}
            @include('layouts.applicantSidebar')
        {{-- SIDE NAV --}}

        {{-- MAIN CONTENT --}}
            <div id="page-content-wrapper">
                <div class="loader"></div>
                {{-- NAV BAR --}}
                    <nav class="navbar navbar-expand-lg text-white border-bottom">
                        <div class="container-fluid">
                            <button class="btn btn-lg" id="sidebarToggle"><i class="fa-solid fa-bars"></i></button>
                            <h4 class="ms-2 pt-2">APPLICANT DASHBOARD</h4>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                                    <li>
                                        <a class="nav-link me-3">
                                            <span>{{ auth()->guard('applicantsModel')->user()->firstname}}</span>
                                            <span>{{ auth()->guard('applicantsModel')->user()->lastname}}</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                {{-- NAV BAR --}}

                {{-- MAIN CONTENT --}}
                    <div class="container-fluid mainBar">
                        <div class="row my-3">
                            <div class="col-lg-3 col-sm-12 mb-2">
                                <div class="card shadow" style="height:8rem; border-radius:10px; background-color:#ffff;">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-3 text-center">
                                                <i class="fa-solid fa-ship icons"></i>
                                            </div>
                                            <div class="col-9 text-center" style="line-height:19px; padding-top:1.5rem">
                                                <p class="card-text fw-bold" style="font-size: 2rem; color:#800000;" id="totalUpcomingOperation"></p>
                                                <p class="card-text fw-bold" style="font-size: 13px; color:#800000;">UPCOMING OPERATION</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-12 mb-2">
                                <div class="card shadow" style="height:8rem; border-radius:10px; background-color:#ffff;">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-3 text-center ">
                                                <i class="fa-solid fa-inbox icons"></i>
                                            </div>
                                            <div class="col-9 text-center" style="line-height:19px; padding-top:1.4rem">
                                                <p class="card-text fw-bold" style="font-size: 2rem; color:#800000;" id="totalInvitation"></p>
                                                <p class="card-text fw-bold" style="font-size: 13px; color:#800000;">TOTAL INVITATION</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-12 mb-2">
                                <div class="card res shadow" style="height:8rem; border-radius:10px; background-color:#ffff;">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-3 text-center ">
                                                <i class="fa-solid fa-calendar-days icons"></i>
                                            </div>
                                            <div class="col-9 text-center" style="line-height:19px; padding-top:1.4rem">
                                                <p class="card-text fw-bold" style="font-size: 2rem; color:#800000;" id="totalScheduledOperation"></p>
                                                <p class="card-text fw-bold" style="font-size: 13px; color:#800000;">SCHEDULED OPERATION</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-12 mb-2">
                                <div class="card shadow" style="height:8rem; border-radius:10px; background-color:#ffff;">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-3 text-center ">
                                                <i class="fa-regular fa-square-check icons"></i>
                                            </div>
                                            <div class="col-9 text-center" style="line-height:19px; padding-top:1.4rem">
                                                <p class="card-text fw-bold" style="font-size: 2rem; color:#800000;" id="totalCompletedOperation">0</p>
                                                <p class="card-text fw-bold" style="font-size: 13px; color:#800000;">COMPLETE OPERATION</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 mt-2 border-2 shadow">
                            <div class="card p-lg-4 p-0 rounded-0" id="fetchAllInvitation"></div>
                        </div>
                    </div>
                {{-- MAIN CONTENT --}}
            </div>
        {{-- END MAIN CONTENT --}}
    </div>

    {{-- JS --}}
        <script src="{{ asset('/js/dateTime.js') }}"></script>
        <script src="{{ asset('/js/applicants/sidenav.js') }}"></script>
        <script src="{{ asset('/js/applicants/dashboard.js') }}"></script>
        <script src="{{ asset('/js/logout.js') }}"></script>
    {{-- END JS --}}

    {{-- MODAL --}}
        {{-- OPERATION DETAILS --}}
        <div class="modal fade" id="viewOperationDetails" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <div class='col-lg-11 col-10'>
                            </div>
                            <div class='col-lg-1 col-2'>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                        </div>
                        <div class='row' id='showScheduledDetails'></div>
                    </div>
                </div>
            </div>
        </div>
        {{-- OPERATION DETAILS --}}
    {{-- MODAL --}}
</body>
</html>
