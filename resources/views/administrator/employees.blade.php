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
                            <h4 class="ms-2">SCPI WORKERS DETAILS</h4>
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
                        <div class="">
                            <div class=" bg-light py-4 px-5 bg-body rounded shadow-lg">
                                <ul class="nav nav-tabs mb-4">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#">&nbsp;&nbsp;Active&nbsp;&nbsp;</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="/inactiveEmployees">Inactive</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="/utilizedAppRecruiter">Currently Utilizing</a>
                                    </li>
                                    <li class="nav-item ms-auto">
                                        <a href="{{ url('downloadTemplate/employeesImport.xlsx') }}" class="btn btn-secondary ms-auto py-2 px-3 btn-sm rounded-0 mb-1">Download Template <i class="bi bi-file-earmark-arrow-down"></i></a>
                                        <button type="button" class="btn btn-success ms-auto py-2 px-3 btn-sm rounded-0 mb-1" data-bs-toggle="modal" data-bs-target="#importExcel">Import Employee <i class="bi bi-file-earmark-excel"></i></button>
                                        <button type="button" class="btn btn-primary ms-auto py-2 px-3 btn-sm rounded-0 mb-1" data-bs-toggle="modal" data-bs-target="#addEmployeesModal">Add Employees <i class="bi bi-plus-lg"></i></button>
                                    </li>
                                </ul>
                                    <table id="activeEmployees" class="table table-sm table-bordered text-center align-middle">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th class="text-center">First Name</th>
                                                <th class="text-center">Middle Name</th>
                                                <th class="text-center">Last Name</th>
                                                <th class="text-center">Position</th>
                                                <th class="text-center col-2">Actions</th>
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
        <script src="{{ asset('/js/administrator/employees.js') }}"></script>
        <script src="{{ asset('/js/dateTime.js') }}"></script>
        <script src="{{ asset('/js/logout.js') }}"></script>
    {{-- END JS --}}

    {{-- MODAL --}}
        {{-- ADD EMPLOYEES --}}
            <div class="modal fade" id="addEmployeesModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-body pb-4">
                            <div class="row">
                                <div class="col-11">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">New Employee</h1>
                                </div>
                                <div class="col-1">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                            </div>
                            <div class="row">
                                <form name="addEmployeeForm" id="addEmployeeForm">
                                <div class="row mt-3 g-2">
                                    <div class="col-3">
                                        <label class="form-label">Company Id:</label>
                                        <input type="text" class="form-control shadow-sm bg-body rounded" required id="addEmployeeId" name="addEmployeeId">
                                    </div>
                                    <div class="col-9">
                                        <label class="form-label">Employees Photo:</label>
                                        <input type="file" class="form-control shadow-sm bg-body rounded" name="addEmployeePhoto" accept="image/png, image/jpg, image/jpeg, image/gif, image/svg">
                                    </div>
                                </div>
                                <div class="row mt-3 g-2">
                                    <div class="col-3">
                                        <label class="form-label">Last Name:</label>
                                        <input type="text" class="form-control shadow-sm bg-body rounded" required id="addEmployeeLastname" name="addEmployeeLastname">
                                    </div>
                                    <div class="col-3">
                                        <label class="form-label">First Name:</label>
                                        <input type="text" class="form-control shadow-sm bg-body rounded" required id="addEmployeeFirstname" name="addEmployeeFirstname">
                                    </div>
                                    <div class="col-3">
                                        <label class="form-label">Middle Name:</label>
                                        <input type="text" class="form-control shadow-sm bg-body rounded" id="addEmployeeMiddlename" name="addEmployeeMiddlename">
                                    </div>
                                    <div class="col-3">
                                        <label class="form-label">Extention:</label>
                                        <select class="form-select shadow-sm bg-body rounded" aria-label="Default select example" id="addEmployeeExt" name="addEmployeeExt">
                                            <option value="">None</option>
                                            <option value="Sr.">Sr.</option>
                                            <option value="Jr.">Jr.</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-3 g-2">
                                    <div class="col-3">
                                        <label class="form-label">Position:</label>
                                        <select class="form-select shadow-sm bg-body rounded" required aria-label="Default select example" id="addEmployeePosition" name="addEmployeePosition">
                                            <option value="Administrator">Administrator</option>
                                            <option value="Recruiter">Recruiter</option>
                                        </select>
                                    </div>
                                    <div class="col-2">
                                        <label class="form-label">Status:</label>
                                        <select class="form-select" aria-label="Default select example" required id="addEmployeeStatus" name="addEmployeeStatus">
                                            <option value="Single" selected>Single</option>
                                            <option value="Married">Married</option>
                                            <option value="Widowed">Widowed</option>
                                            <option value="Seperated">Seperated</option>
                                            <option value="Divorced">Divorced</option>
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <label class="form-label">Birthday:</label>
                                        <input type="date" class="form-control shadow-sm bg-body rounded" required  id="addEmployeeBirthday"  name="addEmployeeBirthday" onchange="calculateAge()">
                                    </div>
                                    <div class="col-1">
                                        <label class="form-label">Age:</label>
                                        <input type="text" readonly class="form-control shadow-sm bg-body rounded" required id="addEmployeeAge" name="addEmployeeAge">
                                    </div>
                                    <div class="col-3">
                                        <label class="form-label">Sex:</label>
                                        <select class="form-select" aria-label="Default select example" required id="addEmployeeGender" name="addEmployeeGender">
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-3 g-2">
                                    <div class="col-4">
                                        <label class="form-label">Phone Number:</label>
                                        <input type="text" class="form-control shadow-sm bg-body rounded" required id="addEmployeePnumber" name="addEmployeePnumber">
                                    </div>
                                    <div class="col-4">
                                        <label class="form-label">Nationality:</label>
                                        <input type="text" class="form-control shadow-sm bg-body rounded" required id="addEmployeeNationality" name="addEmployeeNationality">
                                    </div>
                                    <div class="col-4">
                                        <label class="form-label">Religion:</label>
                                        <input type="text" class="form-control shadow-sm bg-body rounded" required id="addEmployeeReligion" name="addEmployeeReligion">
                                    </div>
                                </div>
                                <div class="row mt-3 g-2">
                                    <div class="col-8">
                                        <label class="form-label">Address:</label>
                                        <input type="text" class="form-control shadow-sm bg-body rounded" required id="addEmployeeAddress" name="addEmployeeAddress">
                                    </div>
                                    <div class="col-4">
                                        <label class="form-label">Email Address:</label>
                                        <input type="email" class="form-control shadow-sm bg-body rounded" required id="addEmployeeEmail" name="addEmployeeEmail">
                                    </div>
                                </div>
                                <div class="row mt-3 g-2">
                                    <div class="col-4">
                                        <label class="form-label">Username:</label>
                                        <input type="text" class="form-control shadow-sm bg-body rounded" required id="addEmployeeUsername" name="addEmployeeUsername">
                                    </div>
                                    <div class="col-4">
                                        <label class="form-label">Password:</label>
                                        <input type="text" class="form-control shadow-sm bg-body rounded bg-white" value="default123" disabled>
                                    </div>
                                    <div class="col-4" style="padding-top: 31px;">
                                        <button type="submit" class="btn btn-primary ms-5 px-5 py-2" id="addEmployeeBtn">Submit</button>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        {{-- ADD EMPLOYEES --}}

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
                                        <input type="file" class="form-control shadow-sm bg-body rounded" name="employeePhoto" 
                                        accept="image/png, image/jpg, image/jpeg, image/gif, image/svg">
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
                                            <option value="None">None</option>
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
                                            <option value="Single" selected>Single</option>
                                            <option value="Married">Married</option>
                                            <option value="Widowed">Widowed</option>
                                            <option value="Seperated">Seperated</option>
                                            <option value="Divorced">Divorced</option>
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

        {{-- EXCEL MODAL --}}
            <div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-10">
                                <h5 class="modal-title" id="exampleModalLongTitle">Import Employee</h5>
                            </div>
                            <div class="col-2 ms-auto">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                        </div>
                        <form id="importEmployeeForm" name="importEmployeeForm">
                        <div class="row mt-3">
                            <input class="form-control" type="file" accept=".xls, .xlsx , .csv" id="fileImport" name="fileImport">
                        </div>
                        <div div class="row mt-3">
                            <div class="col-5 ms-auto">
                                <button type="submit" class="btn btn-success btn-sm rounded-0">Import Excel</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        {{-- EXCEL MODAL --}}
    {{-- MODAL --}}
</body>
</html>