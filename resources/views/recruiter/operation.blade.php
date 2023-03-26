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
                            <h4 class="ms-2">SCHEDULED OPERATION</h4>
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
                        <div class="row g-2" id="showTotalOperation">

                        </div>
                    </div>
                {{-- MAIN CONTENT --}}
            </div>
        {{-- END MAIN CONTENT --}}
    </div>

    {{-- JS --}}
        <script src="{{ asset('/js/dateTime.js') }}"></script>
        <script src="{{ asset('/js/recruiter/operation.js') }}"></script>
        <script src="{{ asset('/js/logout.js') }}"></script>
    {{-- END JS --}}

    {{-- MODAL --}}
        {{-- VIEW APPLICANTS --}}
                <div class="modal fade" id="operationDetailsModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-11">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">ON-CALL APPLICANTS</h1>
                                    </div>
                                    <div class="col-1">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <table class="table table-borderless table-striped text-center">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">First Name</th>
                                            <th scope="col">Last Name</th>
                                            <th scope="col">Phone Number</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <th>1</th>
                                            <td>Mark</td>
                                            <td>Otto</td>
                                            <td>09398320588</td>
                                            <td>
                                                <button type="button" onclick=viewDetails() class="btn btn-secondary btn-sm">Details</button>
                                                <button type="button" onclick=recruit() class="btn btn-primary btn-sm">Recruit</button>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        {{-- VIEW APPLICANTS --}}

        {{-- VIEW DETAILS --}}
                <div class="modal fade" id="applicantsDetailsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-11">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">APPLICANTS INFORMATION</h1>
                                    </div>
                                    <div class="col-1">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <table class="table table-borderless table-striped text-center">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">First Name</th>
                                            <th scope="col">Last Name</th>
                                            <th scope="col">Phone Number</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <th>1</th>
                                            <td>Mark</td>
                                            <td>Otto</td>
                                            <td>09398320588</td>
                                            <td>
                                                <button type="button" onclick=viewDetails() class="btn btn-secondary btn-sm">Details</button>
                                                <button type="button" onclick=recruit() class="btn btn-primary btn-sm">Recruit</button>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        {{-- VIEW DETAILS --}}
    {{-- MODAL --}}
</body>
</html>