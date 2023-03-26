<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
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
                            <h4 class="ms-2">MANAGE ACCOUNT</h4>
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
                    <div class="container-fluid mainBar mb-3">
                        <div>
                            <div class="card bg-light p-5 bg-body rounded shadow-lg">
                                <h4>Personal Information</h4>
                                <ul class="nav nav-tabs my-4">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#">&nbsp;&nbsp;Information&nbsp;&nbsp;</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="/recruiterCredentials">Credentials</a>
                                    </li>
                                </ul>
                                <form class="text-start" id="recruitInformationForm" name="recruitInformationForm">
                                <div class="row gap-0">
                                    <div class="col-3 pt-5">
                                        <div class="mb-3">
                                            <label class="form-label" style="padding-top: 50px">Company Id:</label>
                                            <input disabled class="form-control rounded-0 text-start shadow-sm rounded " type="text"  id="updateCompanyId">
                                        </div>
                                    </div>
                                    <div class="col-6 pt-5" >
                                        <div class="mb-3">
                                            <label class="form-label" style="padding-top: 50px">Profile Picture:</label>
                                            <input class="form-control rounded-0 text-start shadow-sm bg-body rounded" type="file" name="updateEmployeePhoto" accept="image/png, image/jpg, image/jpeg, image/gif, image/svg">
                                        </div>
                                    </div>
                                    <div class="col-3 text-start">
                                        <div class="mb-3">
                                            <img class="img-thumbnail border-0 profilePicture" id="updateEmployeePhoto" style="height:170px;" src="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row gap-0">
                                    <div class="col-3">
                                        <div class="mb-3">
                                            <label class="form-label">First Name:</label>
                                            <input disabled class="form-control rounded-0 text-start shadow-sm rounded" type="text"  id="updateEmployeeFirstname">
                                            <input class="form-control rounded-0 text-start shadow-sm rounded" type="hidden"  id="uniqueEmployeeId" name="uniqueEmployeeId">
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="mb-3">
                                            <label class="form-label">Middle Name:</label>
                                            <input disabled class="form-control rounded-0 text-start shadow-sm rounded" type="text"  id="updateEmployeeMiddlename">
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="mb-3">
                                            <label class="form-label">Last Name:</label>
                                            <input disabled class="form-control rounded-0 text-start shadow-sm rounded" type="text"  id="updateEmployeeLastname">
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="mb-3">
                                            <label class="form-label">Extention: </label>
                                            <select class="form-select text-start shadow-sm rounded" aria-label="Default select example" id="updateEmployeeExt" name="updateEmployeeExt">
                                                <option value="" selected>None</option>
                                                <option value="Jr.">Jr.</option>
                                                <option value="Sr.">Sr.</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row gap-0">
                                    <div class="col-2">
                                        <div class="mb-3">
                                            <label class="form-label">Nationality:</label>
                                            <input class="form-control rounded-0 text-start shadow-sm rounded" type="text"  id="updateEmployeeNationality" name="updateEmployeeNationality">
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="mb-3">
                                            <label class="form-label">Religion:</label>
                                            <input class="form-control rounded-0 text-start shadow-sm rounded" type="text"  id="updateEmployeeReligion" name="updateEmployeeReligion">
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="mb-3">
                                            <label class="form-label">Status: </label>
                                            <select class="form-select text-start shadow-sm bg-body rounded" aria-label="Default select example" id="updateEmployeeStatus" Name="updateEmployeeStatus">
                                                <option value="Single" selected>Single</option>
                                                <option value="Married">Married</option>
                                                <option value="Widowed">Widowed</option>
                                                <option value="Seperated">Seperated</option>
                                                <option value="Divorced">Divorced</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="mb-3">
                                            <label class="form-label">Birthday: </label>
                                            <input disabled type="date" class="form-control rounded-0 text-start shadow-sm rounded" id="updateEmployeeBirthday">
                                        </div>
                                    </div>
                                    <div class="col-1">
                                        <div class="mb-3">
                                            <label class="form-label">Age:</label>
                                            <input type="number" class="form-control rounded-0 text-start shadow-sm bg-body rounded" id="updateEmployeeAge" Name="updateEmployeeAge">
                                        </div>
                                    </div>
                                    <div class="col-1">
                                        <div class="mb-3">
                                            <label class="form-label">Sex:</label>
                                            <input type="text" disabled class="form-control rounded-0 text-start shadow-sm rounded" id="updateEmployeesSex">
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="mb-3">
                                            <label class="form-label">Phone Number: </label>
                                            <input type="text" class="form-control rounded-0 text-start shadow-sm bg-body rounded" id="updateEmployeePnumber" Name="updateEmployeePnumber">
                                        </div>
                                    </div>
                                </div>
                                <div class="row gap-0">
                                    <div class="col-8">
                                        <div class="mb-3">
                                            <label class="form-label">Address</label>
                                            <input type="text" class="form-control rounded-0 text-start shadow-sm bg-body rounded" id="updateEmployeeAddress" name="updateEmployeeAddress">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label class="form-label">Email Address</label>
                                            <input type="text" class="form-control rounded-0 text-start shadow-sm bg-body rounded" id="updateEmployeeEmail" name="updateEmployeeEmail">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-3 d-flex ms-auto">
                                        <button type="submit" class="btn btn-primary px-3 rounded-0">Save Changes</button>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                {{-- MAIN CONTENT --}}
            </div>
        {{-- END MAIN CONTENT --}}
    </div>

    {{-- JS --}}
        <script src="{{ asset('/js/dateTime.js') }}"></script>
        <script src="{{ asset('/js/recruiter/manageAccount.js') }}"></script>
        <script src="{{ asset('/js/logout.js') }}"></script>
    {{-- END JS --}}

</body>
</html>