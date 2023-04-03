<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
                                        <a class="nav-link active" href="#">&nbsp;&nbsp;Old Workers&nbsp;&nbsp;</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="/inactiveOldApplicantsRoutes">Inactive Old Workers</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="/blockedOldApplicantsRoutes">Blocked Old Workers</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Currently Utilizing</a>
                                    </li>
                                </ul>
                                    <table id="oldApplicants" class="table table-sm table-bordered text-center align-middle">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th class="text-center">First Name</th>
                                                <th class="text-center">Middle Name</th>
                                                <th class="text-center">Last Name</th>
                                                <th class="text-center">Phone Number</th>
                                                <th class="text-center">Position</th>
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
        <script src="{{ asset('/js/dateTime.js') }}"></script>
        <script src="{{ asset('/js/administrator/oldApplicants.js') }}"></script>
        <script src="{{ asset('/js/logout.js') }}"></script>
    {{-- END JS --}}

    {{-- MODAL --}}
        <div class="modal fade" id="viewApplicantsDetails" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-body pb-4 text-center">
                        <div class="row">
                            <div class="col-11">
                                <h1 class="modal-title fs-5 text-start" id="exampleModalLabel">Applicants Information</h1>
                            </div>
                            <div class="col-1">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                        </div>
                        <div class="row my-2">
                            <img src="" class="img-thumbnail mx-auto" style="width:30%; height:5%; clip-path:circle();" id="applicantsPhoto">
                            <div class="row mt-3 g-2">
                                <div class="col-3">
                                    <label class="form-label">Last Name:</label>
                                    <input type="text" disabled class="form-control text-center shadow-sm bg-body rounded" id="applicantsLastname" name="applicantsLastname">
                                </div>
                                <div class="col-3">
                                    <label class="form-label">First Name:</label>
                                    <input type="text" disabled class="form-control text-center shadow-sm bg-body rounded" id="applicantsFirstname" name="applicantsFirstname">
                                </div>
                                <div class="col-3">
                                    <label class="form-label">Middle Name:</label>
                                    <input type="text" disabled class="form-control text-center shadow-sm bg-body rounded" id="applicantsMiddlename" name="applicantsMiddlename">
                                </div>
                                <div class="col-3">
                                    <label class="form-label">Extention:</label>
                                    <input type="text" disabled class="form-control text-center shadow-sm bg-body rounded" id="applicantsExt" name="applicantsPosition">
                                </div>
                            </div>
                            <div class="row mt-3 g-2">
                                <div class="col-3">
                                    <label class="form-label">Position:</label>
                                    <input type="text" disabled class="form-control text-center shadow-sm bg-body rounded" id="applicantsPosition" name="applicantsPosition">
                                </div>
                                <div class="col-2">
                                    <label class="form-label">Status:</label>
                                    <input type="text" disabled class="form-control text-center shadow-sm bg-body rounded" id="applicantsStatus" name="applicantsStatus">
                                </div>
                                <div class="col-2">
                                    <label class="form-label">Sex:</label>
                                    <input type="text" disabled class="form-control text-center shadow-sm bg-body rounded" id="applicantsSex" name="applicantsSex">
                                </div>
                                <div class="col-3">
                                    <label class="form-label">Birthday:</label>
                                    <input type="date" disabled class="form-control text-center shadow-sm bg-body rounded" id="applicantsBirthday" name="applicantsBirthday">
                                </div>
                                <div class="col-2">
                                    <label class="form-label">Age:</label>
                                    <input type="text" disabled class="form-control text-center shadow-sm bg-body rounded" id="applicantsAge" name="applicantsAge">
                                </div>
                            </div>
                            <div class="row mt-3 g-2">
                                <div class="col-3">
                                    <label class="form-label">Phone Number:</label>
                                    <input type="text" disabled class="form-control text-center shadow-sm bg-body rounded" id="applicantsPnumber" name="applicantsPnumber">
                                </div>
                                <div class="col-3">
                                    <label class="form-label">Nationality:</label>
                                    <input type="email" disabled class="form-control text-center shadow-sm bg-body rounded" id="applicantsNationality" name="applicantsNationality">
                                </div>
                                <div class="col-3">
                                    <label class="form-label">Religion:</label>
                                    <input type="email" disabled class="form-control text-center shadow-sm bg-body rounded" id="applicantsReligion" name="applicantsReligion">
                                </div>
                                <div class="col-3">
                                    <label class="form-label">Email Address:</label>
                                    <input type="email" disabled class="form-control text-center shadow-sm bg-body rounded" id="applicantsEmail" name="applicantsEmail">
                                </div>
                            </div>
                            <div class="row mt-3 g-2">
                                <div class="col-12">
                                    <label class="form-label">Address:</label>
                                    <input type="text" disabled class="form-control text-center shadow-sm bg-body rounded" id="applicantsAddress" name="applicantsAddress">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {{-- MODAL --}}
</body>
</html>