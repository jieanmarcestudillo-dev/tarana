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
                            <h4 class="ms-2">OPERATION DETAILS</h4>
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
                    <div class="container-fluid mainBar" id="showOperationDetails"></div>
                    <div class="container-fluid mt-4">
                        <div class='card mb-3 shadow border-2 border rounded-top p-5'>
                            <div class='row align-middle mb-2'>
                                <div class='col-10'>
                                    <ul class='nav nav-tabs mb-4 align-middle'>
                                            {{-- <li class='nav-item'>
                                                <a class='nav-link text-secondary' href='#'><span class='badge text-bg-secondary rounded-circle' id="badgeForAll"></span> Total(s)</a>
                                            </li> --}}
                                        <li class='nav-item'>
                                            <a class='nav-link text-secondary' href='recruitApplicantsRoutes'><span class='badge text-bg-secondary rounded-circle' id="badgeForTotalApplicants"></span> Applicants</a>
                                        </li>
                                        {{-- <li class='nav-item'>
                                            <a class='nav-link text-secondary' href='recruitedApplicants'><span class="badge text-bg-secondary rounded-circle" id="badgeForRecruitedApplicant"></span> Recruited Applicants</a>
                                        </li> --}}
                                        <li class='nav-item'>
                                            <a class='nav-link text-dark active' href='#'><span class='badge text-bg-secondary rounded-circle' id="badgeForRecommendApplicants"></span>  Recommended Workers</a>
                                        </li>
                                        <li class='nav-item'>
                                            <a class='nav-link text-secondary' href='recruiterAcceptInvitationRoutes'><span class='badge text-bg-secondary rounded-circle' id="badgeAcceptInvitation"></span> Project Workers</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class='col-2 text-end'>
                                    <button type='button' id='$certainData->certainOperation_id' class='btn btn-primary btn-sm rounded-0 px-3 py-2' onclick=recommendApplicantsModal(this.id)>Recommend</button>
                                </div>
                            </div>
                            <table class='table table-bordered text-center align-middle' id='viewRecommendedTable'>
                                <thead class='text-center'>
                                    <th class='text-center'>No.</th>
                                    <th class='text-center'>Project Workers</th>
                                    <th class='text-center'>Age</th>
                                    <th class='text-center'>Recommend By</th>
                                    <th class='text-center'>Actions</th>
                                </thead>
                                <tbody class='text-center'></tbody>
                            </table>
                        </div>
                    </div>
                {{-- MAIN CONTENT --}}
            </div>
        {{-- END MAIN CONTENT --}}
    </div><link href="https://cdn.datatables.net/v/bs5/dt-1.13.4/b-2.3.6/b-html5-2.3.6/datatables.min.css" rel="stylesheet"/>
    <script src="https://cdn.datatables.net/v/bs5/dt-1.13.4/b-2.3.6/b-html5-2.3.6/datatables.min.js"></script>

    {{-- JS --}}
        <script src="{{ asset('/js/dateTime.js') }}"></script>
        <script src="{{ asset('/js/recruiter/viewRecommend.js') }}"></script>
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
                                            <button class="btn btn-outline-secondary btn-sm" data-bs-target="#recommendApplicantModal" data-bs-toggle="modal">X</button>
                                        </div>
                                    </div>
                                    <div class="row my-3">
                                        <div class="col-7">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <img src="" class="img-thumbnail mx-auto" style="width:50%; height:125px; clip-path:circle();" id="applicantsPhoto1">
                                                            </div>
                                                            <div class="row">
                                                                <ul class="list-group list-group-flush align-middle">
                                                                    <li class="list-group-item fw-bold">Name: <span id="applicantsFirstname1" class="fw-normal"></span> <span  class="fw-normal" id="applicantsMiddlename1"> </span> <span  class="fw-normal" id="applicantsLastname1"> <span  class="fw-normal" id="applicantsExt1"></span></span>
                                                                    <br> Preferred Role: <span  class="fw-normal"></span>
                                                                    </li>
                                                                    <li class="list-group-item fw-bold">Gender: <span  class="fw-normal" id="applicantsGender1"></span> <br> Birthdate: <span  class="fw-normal" id="applicantsBirthday1"></span> <br>Age: <span  class="fw-normal" id="applicantsAge1"> </span> years old</li>
                                                                    <li class="list-group-item fw-bold">Phone Number: <span  class="fw-normal" id="applicantsPnumber1"></span> <br> Email:
                                                                        <span  class="fw-normal" id="applicantsEmail1"></span>
                                                                    </li>
                                                                    <li class="list-group-item fw-bold">Address: <span  class="fw-normal" id="applicantsAddress1"></span></li>
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
                                                        <img src="" loading="lazy" style="width:100%; height:13rem;" id="personalId1">
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-header bg-white">
                                                            <h5 class="card-title pt-2" style="font-size:16px;">Other Details</h5>
                                                        </div>
                                                        <ul class="list-group list-group-flush align-middle">
                                                            <li class="list-group-item">Performance Rating: <span id='overallRatingPerWorker1'></span>%</li>
                                                            <li class="list-group-item">Back Out In Operation: <span id='totalBackOutPerWorker1'></span> Total</li>
                                                            <li class="list-group-item">Declined Invitation: <span id='totalDeclinedPerWorker1'></span> Total</li>
                                                            <li class="list-group-item">Not Attend: <span id='totalNotAttend'></span> Total</li>
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
                                                <div class="card-body" id="showExperience1"></div>
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

        {{-- SHOW DETAILS OF APPLICANTS --}}
            <div class="modal fade" id="viewWorkerDetails" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                                                            <li class="list-group-item">Not Attend: <span id='totalNotAttend'></span> Total</li>
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
                                                <div class="card-body" id="showExperience"></div>
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

        {{-- RECOMMEND APPLICANTS --}}
            <div class="modal fade" id="recommendApplicantModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <div class="row my-4">
                                <form class="d-flex" role="search">
                                    <input class="form-control me-2 text-center round-pill" type="search" placeholder="Search Last Name of Project Worker" aria-label="Search" id="searchLastname">
                                </form>
                            </div>
                            <div>
                                <table id="resultsOfApplicants" class="table table-bordered text-center align-middle"></table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        {{-- RECOMMEND APPLICANTS --}}
    {{-- MODAL --}}
</body>
</html>


