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
                            <h4 class="ms-2">MANPOWER POOLING</h4>
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
                                <ul class="nav nav-tabs mb-4 ">
                                    <li class="nav-item">
                                        <a class="nav-link" href="/adminEmployeesRoutes">Available</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#">&nbsp;&nbsp;Not Available&nbsp;&nbsp;</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="/utilizedAppRecruiter">Currently Active</a>
                                    </li>
                                </ul>
                                <div class="container-fluid mt-4">
                                    <table id="inactiveEmployees" class="table table-sm table-bordered text-center align-middle">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No.</th>
                                                <th class="text-center">First Name</th>
                                                <th class="text-center">Middle Name</th>
                                                <th class="text-center">Last Name</th>
                                                <th class="text-center col-3">Actions</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                {{-- MAIN CONTENT --}}
            </div>
        {{-- END MAIN CONTENT --}}
    </div>

    {{-- JS --}}
        <script src="{{ asset('/js/administrator/employee.js') }}"></script>
        <script src="{{ asset('/js/dateTime.js') }}"></script>
        <script src="{{ asset('/js/logout.js') }}"></script>
    {{-- END JS --}}

    {{-- MODAL --}}
        {{-- UPDATE EMPLOYEES --}}
            <div class="modal fade" id="updateEmployeesModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-body pb-4">
                            <div class="row">
                                <div class="col-11">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Update Employee</h1>
                                </div>
                                <div class="col-1">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                            </div>
                            <div class="row">
                                <form name="editEmployeeForm" id="editEmployeeForm">
                                <div class="row g-1">
                                    <div class="col-3" style="padding-top: 6rem;">
                                        <label class="form-label">Company Id:</label>
                                        <input type="text" class="form-control shadow-sm bg-body rounded" id="employeeId" name="employeeId">
                                        <input type="hidden" class="form-control shadow-sm bg-body rounded" id="uniqueEmployeeId" name="uniqueEmployeeId">
                                    </div>
                                    <div class="col-5" style="padding-top: 6rem;">
                                        <label class="form-label">Employee Photo:</label>
                                        <input type="file" class="form-control shadow-sm bg-body rounded" name="employeePhoto">
                                    </div>
                                    <div class="col-4 text-center">
                                        <img class="img-thumbnail border-0 profilePicture" id="employeePhoto" style="height:170px;" src="">
                                    </div>
                                </div>
                                <div class="row mt-3 g-2">
                                    <div class="col-3">
                                        <label class="form-label">Last Name:</label>
                                        <input type="text" class="form-control shadow-sm bg-body rounded" id="employeeLastname" name="employeeLastname">
                                    </div>
                                    <div class="col-3">
                                        <label class="form-label">First Name:</label>
                                        <input type="text" class="form-control shadow-sm bg-body rounded" id="employeeFirstname" name="employeeFirstname">
                                    </div>
                                    <div class="col-3">
                                        <label class="form-label">Middle Name:</label>
                                        <input type="text" class="form-control shadow-sm bg-body rounded" id="employeeMiddlename" name="employeeMiddlename">
                                    </div>
                                    <div class="col-3">
                                        <label class="form-label">Extention:</label>
                                        <select class="form-select" aria-label="Default select example" id="employeeExt" name="employeeExt">
                                            <option value="">None</option>
                                            <option value="Sr.">Sr.</option>
                                            <option value="Jr.">Jr.</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-3 g-2">
                                    <div class="col-3">
                                        <label class="form-label">Position:</label>
                                        <select class="form-select" aria-label="Default select example" id="employeePosition" name="employeePosition">
                                            <option value="Administrator">Administrator</option>
                                            <option value="Recruiter">Recruiter</option>
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <label class="form-label">Status:</label>
                                        <select class="form-select" aria-label="Default select example" id="employeeStatus" name="employeeStatus">
                                            <option value="Single">Single</option>
                                            <option value="Widowed">Widowed</option>
                                            <option value="Jr.">Jr.</option>
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <label class="form-label">Birthday:</label>
                                        <input type="date" class="form-control shadow-sm bg-body rounded" id="employeeBirthday" name="employeeBirthday">
                                    </div>
                                    <div class="col-1">
                                        <label class="form-label">Age:</label>
                                        <input type="text" class="form-control shadow-sm bg-body rounded" id="employeeAge" name="employeeAge">
                                    </div>
                                    <div class="col-2">
                                        <label class="form-label">Sex:</label>
                                        <select class="form-select" aria-label="Default select example" id="employeesSex" name="employeesSex">
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-3 g-2">
                                    <div class="col-4">
                                        <label class="form-label">Phone Number:</label>
                                        <input type="text" class="form-control shadow-sm bg-body rounded" id="employeePnumber" name="employeePnumber">
                                    </div>
                                    <div class="col-4">
                                        <label class="form-label">Nationality:</label>
                                        <input type="text" class="form-control shadow-sm bg-body rounded" id="employeeNationality" name="employeeNationality">
                                    </div>
                                    <div class="col-4">
                                        <label class="form-label">Religion:</label>
                                        <input type="text" class="form-control shadow-sm bg-body rounded" id="employeeReligion" name="employeeReligion">
                                    </div>
                                </div>
                                <div class="row mt-3 g-2">
                                    <div class="col-8">
                                        <label class="form-label">Address:</label>
                                        <input type="text" class="form-control shadow-sm bg-body rounded" id="employeeAddress" name="employeeAddress">
                                    </div>
                                    <div class="col-4">
                                        <label class="form-label">Email Address:</label>
                                        <input type="email" class="form-control shadow-sm bg-body rounded" id="employeeEmail" name="employeeEmail">
                                    </div>
                                </div>
                                <div class="row mt-3 g-2">
                                    <div class="col-4 ms-auto" style="padding-top: 8px;">
                                        <button type="submit" class="btn btn-primary ms-5 px-4 py-2" id="employeeBtn">Save Changes</button>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        {{-- UPDATE EMPLOYEES --}}
    {{-- MODAL --}}
</body>
</html>
