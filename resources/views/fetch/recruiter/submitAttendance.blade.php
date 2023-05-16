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
            @foreach($data as $certainData)
            <div id="page-content-wrapper">
                <div class="loader"></div>
                {{-- NAV BAR --}}
                    <nav class="navbar navbar-expand-lg text-white border-bottom">
                        <div class="container-fluid">
                            <h4 class="ms-2">SUBMIT ATTENDANCE</h4>
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
                    <div class="container-fluid mainBar mb-2">
                        {{-- CARDS --}}
                            <div class='col-12'>
                                <div class='card shadow border-2 border rounded-top'>
                                    <div class='row g-0'>
                                        <div class='col-md-5'>
                                            <img loading='lazy' src='{{$certainData->photos}}' class='card-img-top img-thumdnail rounded-0' style='height: 15.5rem; width:100%;'>
                                        </div>
                                        <div class='col-md-4'>
                                            <ul class='list-group list-group-flush'>
                                                <li class='list-group-item fw-bold'>Ship's Name:<a class='fw-normal text-dark' style='text-decoration:none;'> {{$certainData->shipName}}</a></li>
                                                <li class='list-group-item fw-bold'>Ship's Carry:<a class='fw-normal text-dark' style='text-decoration:none;'> {{$certainData->shipCarry}}</a></li>
                                                <li class='list-group-item fw-bold'>Operation Start: </br>
                                                    <a class='fw-normal nav-link'>Date: <span>{{date('F d, Y | D',strtotime($data[0]->operationStart))}}</span></br></a>
                                                    <a class='fw-normal nav-link'>Time: <span>{{date('h:i: A ',strtotime($data[0]->operationStart))}}</span></a>
                                                </li>
                                                <li class='list-group-item fw-bold'>Operation End: </br>
                                                    <a class='fw-normal nav-link'>Date: <span>{{date('F d, Y | D',strtotime($data[0]->operationEnd))}}</span></br></a>
                                                    <a class='fw-normal nav-link'>Time: <span>{{date('h:i: A ',strtotime($data[0]->operationEnd))}}</span></a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class='col-md-3'>
                                            <h4 class='text-center' style='margin-top:7.3rem; color:#000;'>{{$certainData->totalWorkers - $certainData->slot}} Total Workers</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>    
                        {{-- CARDS --}}

                        {{-- TABLES --}}
                            <div class="card p-5 mt-2 shadow rounded-0">
                                <table id="applicantsAttendance" class="table table-sm table-bordered text-center align-middle text-center align-middle">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Applicants</th>
                                            <th class="text-center">Phone Number</th>
                                            <th class="text-center">Position</th>
                                            <th class="text-center col-2">Attendance</th>
                                            <th class="text-center col-3">Performance Rating</th>
                                            <th class="text-center col-1">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($certainData->applicants as $count => $applicantInfo)
                                        <tr>
                                            <td>{{$count = $count +1;}}</td>
                                            <td>{{$applicantInfo->firstname.' '.$applicantInfo->lastname.' '.$applicantInfo->extention}}</td>
                                            <td>{{$applicantInfo->phoneNumber}}</td>
                                            <td>{{$applicantInfo->position}}</td>
                                            <td scope='col'>
                                                <div class='form-check form-check-inline'>
                                                    <input class='form-check-input isAttend' type='checkbox' name='applicantPresent[]' value='$certainApplicantData->applicant_id'>
                                                    <label class='form-check-label'>Is Attend</label>
                                                </div>
                                            </td>
                                            <td scope='col'>
                                                <div class='form-check form-check-inline'>
                                                    <label for="points">Rates (between 0 and 100):</label>
                                                    <input type="range" class="ratePerformance" disabled name="points" min="0" max="100" value="0" step="5">
                                                    <p class="rateValue text-center"></p>
                                                </div>
                                            </td>
                                            <td>
                                                <button type="button" onclick='viewApplicants({{$applicantInfo->applicant_id}})' class="btn btn-outline-secondary btn-sm rounded-0">View</button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-2 ms-auto">
                                        <button type="button" class="btn btn-success btn-sm rounded-0 mt-4 py-2 px-5">SUBMIT</button>
                                    </div>
                                </div>
                            </div>
                        {{-- TABLES --}}
                    </div>
                {{-- MAIN CONTENT --}}
            </div>
        {{-- END MAIN CONTENT --}}
        @endforeach
    </div>

    {{-- JS --}}
        <script src="{{ asset('/js/recruiter/certainGroup4.js') }}"></script>
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
                                                                <img src="" class="img-thumbnail mx-auto" style="width:50%; height:10%; clip-path:circle();" id="applicantsPhoto">
                                                            </div>
                                                            <div class="row">
                                                                <ul class="list-group list-group-flush align-middle">
                                                                    <li class="list-group-item fw-bold">Name: <span id="applicantsFirstname" class="fw-normal"></span> <span  class="fw-normal" id="applicantsMiddlename"> </span> <span  class="fw-normal" id="applicantsLastname"> <span  class="fw-normal" id="applicantsExt"></span></span>
                                                                    <br> Preferred Role: <span  class="fw-normal" id="applicantsPosition"></span>
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
