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
                            <h4 class="ms-2">ON-CALL EMPLOYEES</h4>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                                    <li>
                                        <a class="text-white nav-link me-3">
                                            <span id="fetchFirstname"></span>
                                            <span id="fetchLastname"></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                {{-- NAV BAR --}}

                {{-- MAIN CONTENT --}}
                    <div class="container-fluid mainBar mb-3">
                            <div class=" bg-light p-5 bg-body rounded-0 shadow-lg">
                                <div class=" mt-4">
                                    <table id="applicants" class="table table-responsive table-bordered table-sm text-center align-middle">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th class="text-center">First Name</th>
                                                <th class="text-center">Middle Name</th>
                                                <th class="text-center">Last Name</th>
                                                <th class="text-center">Phone Number</th>
                                                <th class="text-center">Phone Number</th>
                                                <th class="text-center">Actions</th>
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
        <script src="{{ asset('/js/dateTime.js') }}"></script>
        <script src="{{ asset('/js/recruiter/applicant.js') }}"></script>
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
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Applicant Information</h1>
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
                                                                <img src="" loading="lazy" class="img-thumbnail mx-auto" style="width:50%; height:10%; clip-path:circle();" id="applicantsPhoto">
                                                            </div>
                                                            <div class="row">
                                                                <ul class="list-group list-group-flush align-middle">
                                                                    <li class="list-group-item fw-bold">Fullname: <span id="applicantsFirstname" class="fw-normal"></span> <span  class="fw-normal" id="applicantsMiddlename"> </span> <span  class="fw-normal" id="applicantsLastname"> <span  class="fw-normal" id="applicantsExt"></span></span>
                                                                    <br> Role: <span  class="fw-normal" id="applicantsPosition"></span>
                                                                    </li>
                                                                    <li class="list-group-item fw-bold">Gender: <span  class="fw-normal" id="applicantsGender"></span> <br> Birthdate: <span  class="fw-normal" id="applicantsBirthday"></span> <br>Age: <span  class="fw-normal" id="applicantsAge"> </span> years old</li>
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
                                                    <div class="row">
                                                        <img src="" loading="lazy" style="width:100%; height:13.8rem;" id="personalId">
                                                    </div>
                                                    <div class="row">
                                                        <img src="" loading="lazy" style="width:100%; height:13.8rem;" id="personalId2">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-5">
                                            <div class="card" style="height:442px; overflow-y:auto;">
                                                <div class="card-header bg-white">
                                                    <h5 class="card-title">Experience</h5>
                                                </div>
                                                <div class="card-body" id="showExperience">
                                                    <ul class="list-group text-center">
                                                        <li class="list-group-item py-4 text-uppercase fw-normal">Cable Operation: <span class="fw-normal" id="cableExp"></span></li>
                                                        <li class="list-group-item py-4 text-uppercase fw-normal">Wood Operation: <span class="fw-normal" id="woodExp"></span></li>
                                                        <li class="list-group-item py-4 text-uppercase fw-normal">Plywood Operation: <span class="fw-normal" id="plyWoodExp"></span></li>
                                                        <li class="list-group-item py-4 text-uppercase fw-normal">Soya Operation: <span class="fw-normal"  id="soyaExp"></span></li>
                                                        <li class="list-group-item py-4 text-uppercase fw-normal">Rice Operation: <span class="fw-normal"  id="riceExp"></span></li>
                                                      </ul>
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