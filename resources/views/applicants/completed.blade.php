<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- CSS --}}
        <link href="{{ asset('/css/applicants/applicantsDashboard.css') }}" rel="stylesheet">
        <link href="{{ asset('/css/applicants/sideBar.css') }}" rel="stylesheet">
        <link rel="shortcut icon" href="{{ URL('/assets/frontend/logoo.webp')}}" type="image/x-icon">
        @include('cdn')
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
                            <h4 class="ms-2 pt-2">OPERATION COMPLETED</h4>
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
                        <div class="row mt-3 g-2 table-responsive" id="showCompletedDetails">
                            <table id="applicantCompletedOperation" class="table table-bordered text-center align-middle">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Recruiter</th>
                                        <th class="text-center">Operation</th>
                                        <th class="text-center">Operation Start</th>
                                        <th class="text-center">Operation End</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                {{-- MAIN CONTENT --}}
            </div>
        {{-- END MAIN CONTENT --}}
    </div>

    {{-- JS --}}
        <script src="{{ asset('/js/dateTime.js') }}"></script>
        <script src="{{ asset('/js/applicants/sidenav.js') }}"></script>
        <script src="{{ asset('/js/applicants/completed.js') }}"></script>
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
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Applicants Information</h1>
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
                                                                <img src="" class="img-thumbnail mx-auto" style="width:50%; height:10%; clip-path:circle();" id="applicantsPhoto">
                                                            </div>
                                                            <div class="row">
                                                                <ul class="list-group list-group-flush align-middle">
                                                                    <li class="list-group-item">Fullname: <span id="applicantsFirstname" class="fw-normal"></span> <span id="applicantsMiddlename"> </span> <span id="applicantsLastname"> <span id="applicantsExt"></span></span>
                                                                    <br> Role: <span id="applicantsPosition"></span>
                                                                    </li>
                                                                    <li class="list-group-item">Gender: <span id="applicantsGender"></span> <br> Birthdate: <span id="applicantsBirthday"></span> <br>Age: <span id="applicantsAge"> </span> years old</li>
                                                                    <li class="list-group-item">Phone Number: <span id="applicantsPnumber"></span> <br> Email:
                                                                        <span id="applicantsEmail"></span>
                                                                    </li>
                                                                    <li class="list-group-item">Address: <span id="applicantsAddress"></span></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="row">
                                                        <img src="" style="width:100%; height:13.8rem;" id="personalId">
                                                    </div>
                                                    <div class="row">
                                                        <img src="" style="width:100%; height:13.8rem;" id="personalId2">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-5">
                                            <div class="card" style="height:442px; overflow-y:auto;">
                                                <div class="card-header bg-white">
                                                    <h5 class="card-title">Experience</h5>
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
            </div>
        {{-- SHOW DETAILS OF APPLICANTS --}}

        {{-- UPDATE OPERATION --}}
            <div class="modal fade" id="viewOperationModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-11">
                                </div>
                                <div class="col-1">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                            </div>
                            <div class="row g-1 mt-3">
                                <img src="" class="rounded mx-auto d-block" id="operationPhoto" style="height: 300px; width:100%;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        {{-- UPDATE OPERATION --}}
    {{-- MODAL --}}
</body>
</html>