<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @include('cdn')
        <!-- CSS -->
            <link href="{{ asset('/css/admin/adminDashboard.css') }}" rel="stylesheet">
            <link rel="shortcut icon" href="{{ URL('/assets/frontend/logoo.webp')}}" type="image/x-icon">
            <!-- CSS -->
    <title>TARA NA</title>
</head>
<body>
    <div class="d-flex" id="wrapper">

        <!-- SIDE NAV -->
            @include('layouts.adminSidebar')
        <!-- SIDE NAV -->

        <!-- MAIN CONTENT -->
            <div id="page-content-wrapper">
                <div class="loader"></div>
                <!-- NAV BAR -->
                    <nav class="navbar navbar-expand-lg border-bottom">
                        <div class="container-fluid">
                            {{-- <button class="btn btn-lg" id="sidebarToggle"><i class="fa-solid fa-bars"></i></button> --}}
                            <h4 class="ms-2"> DASHBOARD</h4>
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
                <!-- NAV BAR -->

                <!-- MAIN CONTENT -->
                    <div class="container-fluid mainBar">
                            <div class="row mb-3">
                                <div class="col-3">
                                    <div class="card shadow" style="height:8rem; border-radius:10px; background-color:#ffff;">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-3 text-center">
                                                    <i class="bi bi-briefcase"></i>
                                                </div>
                                                <div class="col-9 text-center" style="line-height:19px; padding-top:1.5rem">
                                                    <p class="card-text fw-bold" style="font-size: 2rem; color:#D72323;" id="totalUpcomingOperation"></p>
                                                    <p class="card-text fw-bold" style="font-size: 13px; color:#D72323;">UPCOMING OPERATION</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="card shadow" style="height:8rem; border-radius:10px; background-color:#ffff;">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-3 text-start">
                                                   <i class="bi bi-calendar-check"></i>
                                                </div>
                                                <div class="col-9 text-start" style="line-height:19px; padding-top:1.5rem">
                                                    <p class="card-text fw-bold text-center pe-4" style="font-size: 2rem; color:#D72323;" id="totalCompletedOperation"></p>
                                                    <p class="card-text fw-bold" style="font-size: 12px; color:#D72323;">COMPLETED OPERATION</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="card shadow" style="height:8rem; border-radius:10px; background-color:#ffff;">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-3 text-start">
                                                    <i class="bi bi-person-workspace"></i>
                                                </div>
                                                <div class="col-9 text-center" style="line-height:19px; padding-top:1.5rem">
                                                    <p class="card-text fw-bold pe-2" style="font-size: 2rem; color:#D72323;" id="totalForeman"></p>
                                                    <p class="card-text fw-bold" style="font-size: 13px; letter-spacing:1px; color:#D72323;">TOTAL RECRUITER</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="card shadow" style="height:8rem; border-radius:10px; background-color:#ffff;">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-3 text-start">
                                                    <i class="bi bi-people-fill"></i> 
                                                </div>
                                                <div class="col-9 text-center" style="line-height:19px; padding-top:1.5rem">
                                                    <p class="card-text fw-bold pe-2" style="font-size: 2rem; color:#D72323;" id="totalApplicants"></p>
                                                    <p class="card-text fw-bold" style="font-size: 13px; letter-spacing:1px; color:#D72323;">TOTAL APPLICANTS</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 mt-2 border-2 shadow">
                                <div class="card p-4" id="visualization">
                                    <H5>OPERATION REPORT</H5>
                                    <canvas id="myChart"></canvas>
                                </div>
                            </div>
                    </div>
                <!-- MAIN CONTENT -->
            </div>
        <!-- MAIN CONTENT -->
    </div>

        <!-- JS -->
            <script src="{{ asset('/js/administrator/dashboard.js') }}"></script>
            <script src="{{ asset('/js/dateTime.js') }}"></script>
            <script src="{{ asset('/js/logout.js') }}"></script>
        <!-- JS -->
</body>
</html>