<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    {{-- CSS --}}
        <link href="{{ asset('/css/admin/adminDashboard.css') }}" rel="stylesheet">
        <link rel="shortcut icon" href="{{ URL('/assets/frontend/logoo.webp')}}" type="image/x-icon">
        @include('cdn')
    {{-- CSS --}}
    <title>TARA NA</title>
</head>
<body>

    <div class="d-flex" id="wrapper">
        {{-- SIDE NAV --}}
            @include('layouts.adminSidebar')
        {{-- SIDE NAV --}}

        {{-- MAIN CONTENT --}}
            <div id="page-content-wrapper">
                <div class="loader"></div>
                {{-- NAV BAR --}}
                    <nav class="navbar navbar-expand-lg text-white border-bottom">
                        <div class="container-fluid">
                            {{-- <button class="btn btn-lg text-white" id="sidebarToggle"><i class="fa-solid fa-bars"></i></button> --}}
                            <h4 class="ms-2">ON-CALL WORKERS</h4>
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
                        <div class="container-fluid">
                            <div class="container-fluid bg-light px-5 py-4 bg-body rounded shadow-lg">
                                    <ul class="nav nav-tabs mb-4">
                                    <li class="nav-item">
                                        <a class="nav-link" href="/adminOldApplicantsRoutes">Available Project Workers</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="/inactiveOldApplicantsRoutes">Not Available Project Workers</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#">&nbsp;&nbsp;Blocked Project Workers&nbsp;&nbsp;</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="/utilizedApplication">Currently Active</a>
                                    </li>
                                </ul>
                                    <table id="blockOldApplicants" class="table table-sm table-bordered text-center align-middle">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No.</th>
                                                <th class="text-center">Full Name</th>
                                                <th class="text-center">Phone Number</th>
                                                <th class="text-center">Reason</th>
                                                <th class="text-center col-3">Actions</th>
                                            </tr>
                                        </thead>
                                    </table>
                            </div>
                        </div>
                    </div>
                {{-- MAIN CONTENT --}}
            </div>
        {{-- END MAIN CONTENT --}}
    </div>

    {{-- JS --}}
        <script src="{{ asset('/js/administrator/oldApplicants.js') }}"></script>
        <script src="{{ asset('/js/dateTime.js') }}"></script>
        <script src="{{ asset('/js/logout.js') }}"></script>
    {{-- END JS --}}

    {{-- MODAL --}}
        {{-- SHOW DETAILS OF APPLICANTS --}}
            <div class="modal fade" id="viewApplicantsDetails" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-body pb-4">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="row">
                                        <div class="col-11">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Project Workers Information</h1>
                                        </div>
                                        <div class="col-1">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                    </div>
                                    <div class="row my-3">
                                        <div class="col-7">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <img src="" loading="lazy" class="img-thumbnail mx-auto" style="width:50%; height:125px; clip-path:circle();" id="applicantsPhoto">
                                                            </div>
                                                            <div class="row">
                                                                <ul class="list-group list-group-flush align-middle">
                                                                    <li class="list-group-item fw-bold">Fullname: <span id="applicantsFirstname" class="fw-normal"></span> <span  class="fw-normal" id="applicantsMiddlename"> </span> <span  class="fw-normal" id="applicantsLastname"> <span  class="fw-normal" id="applicantsExt"></span></span>
                                                                    <br> Role: <span  class="fw-normal">Cargo Handler</span>
                                                                    </li>
                                                                    <li class="list-group-item fw-bold">Gender: <span  class="fw-normal" id="applicantsGender"></span> <br> Birthdate: <span  class="fw-normal" id="applicantsBirthday"></span> <br>Age: <span  class="fw-normal" id="applicantsAge"> </span> <span class='fw-normal'>years old</span></li>
                                                                    <li class="list-group-item fw-bold">Phone Number: <span  class="fw-normal" id="applicantsPnumber"></span> <br> Email:
                                                                        <span  class="fw-normal" id="applicantsEmail"></span>
                                                                    </li>
                                                                    <li class="list-group-item fw-bold">Address: <span  class="fw-normal" id="applicantsAddress"></span></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="card p-1">
                                                        <div class="card-header bg-white">
                                                            <h5 class="card-title pt-1" style="font-size:16px;">Identity</h5>
                                                        </div>
                                                        <img src="" loading="lazy" style="width:100%; height:13rem;" id="personalId">
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-header bg-white">
                                                            <h5 class="card-title pt-2" style="font-size:16px;">Other Details</h5>
                                                        </div>
                                                        <ul class="list-group list-group-flush align-middle">
                                                            <li class="list-group-item">Performance Rating: <span id='overallRatingPerWorker'></span>%</li>
                                                            <li class="list-group-item">Back Out In Operation: <span id='totalBackOutPerWorker'></span> Total</li>
                                                            <li class="list-group-item">Declined Invitation: <span id='totalDeclinedPerWorker'></span> Total</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-5">
                                            <div class="card" style="height:442px; overflow-y:auto;">
                                                <div class="card-header bg-white">
                                                    <h5 class="card-title">Latest Works</h5>
                                                </div>
                                                <div class="card-body" id="showExperience">
                                                    {{-- <ul class="list-group text-center">
                                                        <li class="list-group-item py-4 text-uppercase fw-normal">Cable Operation: <span class="fw-normal" id="cableExp"></span></li>
                                                        <li class="list-group-item py-4 text-uppercase fw-normal">Wood Operation: <span class="fw-normal" id="woodExp"></span></li>
                                                        <li class="list-group-item py-4 text-uppercase fw-normal">Plywood Operation: <span class="fw-normal" id="plyWoodExp"></span></li>
                                                        <li class="list-group-item py-4 text-uppercase fw-normal">Soya Operation: <span class="fw-normal"  id="soyaExp"></span></li>
                                                        <li class="list-group-item py-4 text-uppercase fw-normal">Rice Operation: <span class="fw-normal"  id="riceExp"></span></li>
                                                    </ul> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        {{-- SHOW DETAILS OF APPLICANTS --}}
    {{-- MODAL --}}
</body>
</html>
