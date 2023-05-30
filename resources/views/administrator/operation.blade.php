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
                            <h4 class="ms-2">OPERATION DETAILS</h4>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav ms-auto">
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
                        <div class="p-5 shadow">
                            <ul class="nav nav-tabs mb-4">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#">&nbsp;&nbsp;On going / Upcoming&nbsp;&nbsp;</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/adminCompletedOperation">Completed</a>
                                </li>
                                <li class="nav-item ms-auto">
                                    {{-- <button type="button" class="btn btn-success ms-auto py-2 px-3 btn-sm my-1 rounded-0" data-bs-toggle="modal" data-bs-target="#importExcel">Import Operation <i class="bi bi-file-earmark-excel"></i></button> --}}
                                    <button type="button" class="btn btn-primary ms-auto btn-sm py-2 px-3 my-1 rounded-0" data-bs-toggle="modal" data-bs-target="#addOperationModal">Add Operation <i class="bi bi-plus-lg"></i></button>
                                </li>
                            </ul>
                            <table id="operationTable" class="table table-sm table-bordered text-center mt-2 align-middle">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Operation ID</th>
                                        <th class="text-center">Ship's Name</th>
                                        <th class="text-center">Ship's Carry</th>
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
        <script src="{{ asset('/js/administrator/operation.js') }}"></script>
        <script src="{{ asset('/js/logout.js') }}"></script>
    {{-- END JS --}}

    {{-- MODAL --}}
        {{-- NEW OPERATION --}}
            <div class="modal fade" id="addOperationModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <form name="addOperationForm" id="addOperationForm">
                                @CSRF 
                            <div class="row">
                                <div class="col-11">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">New Operation</h1>
                                </div>
                                <div class="col-1">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                            </div>
                            @if(count($errors) > 0){
                                <p>{{$errors->first()}}</p>
                            }
                            @endif
                            <div class="row g-1 mt-3">
                                <div class="col-4">
                                    <label class="form-label">Operation Id:</label>
                                    <input type="text" readonly class="form-control shadow-sm bg-body rounded" required id="addOperationId" name="addOperationId">
                                </div>
                                <div class="col-8">
                                    <label class="form-label">Ship's Photo:</label>
                                    <input type="file" class="form-control shadow-sm bg-body rounded" required id="addOperationPhoto" name="addOperationPhoto" accept="image/png, image/jpg, image/jpeg, image/gif, image/svg">
                                </div>
                            </div>
                            <div class="row g-1 mt-3">
                                <div class="col-4">
                                    <label class="form-label">Ship's Name:</label>
                                    <input type="text" class="form-control shadow-sm bg-body rounded" required id="addShipsName" name="addShipsName">
                                </div>
                                <div class="col-4">
                                    <label class="form-label">Ship's Carry:</label>
                                    <select class="form-select" aria-label="Default select example" required id="addShipsCarry" name="addShipsCarry">
                                        <option selected>Select Here</option>
                                        <option value="Wood">Wood</option>
                                        <option value="Plywood">Plywood</option>
                                        <option value="Soya">Soya</option>
                                        <option value="Cable">Cable</option>
                                        <option value="Rice">Rice</option>
                                    </select>
                                </div>
                                <div class="col-4">
                                    <label class="form-label">Workers Slot:</label>
                                    <input type="number" value="0" min='0' class="form-control shadow-sm bg-body rounded text-center" id="addApplicantsSlot" name="addApplicantsSlot">
                                </div>
                            </div>
                            <div class="row g-1 mt-3">
                                <div class="col-6">
                                    <label class="form-label">Operation Start:</label>
                                    <input type="datetime-local" class="form-control shadow-sm bg-body rounded" required id="addOperationStart" name="addOperationStart">
                                </div>
                                <div class="col-6">
                                    <label class="form-label">Operation End:</label>
                                    <input type="datetime-local" class="form-control shadow-sm bg-body rounded" required id="addOperationEnd" name="addOperationEnd">
                                </div>
                            </div>
                            <div class="row g-1 mt-4">
                                <div class="col-4 ms-auto text-end">
                                    <button type="submit" id="submitOperations" name="submitOperations" class="btn btn-primary px-5 py-2">Submit</button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        {{-- NEW OPERATION --}}

        {{-- UPDATE OPERATION --}}
            <div class="modal fade" id="updateOperationModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <form name="updateOperationForm" id="updateOperationForm">
                                <div class="row">
                                    <div class="col-11">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Update Operation</h1>
                                    </div>
                                    <div class="col-1">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                </div>
                                <div class="row g-1 mt-3">
                                    <img src="" class="rounded mx-auto d-block" id="operationPhoto" style="height: 200px; width:100%;">
                                </div>
                                <div class="row g-1 mt-3">
                                    <div class="col-4">
                                        <label class="form-label">Operation Id:</label>
                                        <input type="text" disabled class="form-control shadow-sm bg-body rounded" required id="operationId" name="operationId">
                                        <input type="hidden" class="form-control shadow-sm bg-body rounded" required id="certainOperation_id" name="certainOperation_id">
                                    </div>
                                    <div class="col-8">
                                        <label class="form-label">Ship's Photo:</label>
                                        <input type="file" class="form-control shadow-sm bg-body rounded" id="clearPhoto" name="operationPhoto" accept="image/png, image/jpg, image/jpeg, image/gif, image/svg">
                                    </div>
                                </div>
                                <div class="row g-1 mt-3">
                                    <div class="col-5">
                                        <label class="form-label">Ship's Name:</label>
                                        <input type="text" class="form-control shadow-sm bg-body rounded" required id="shipName" name="shipName">
                                    </div>
                                    <div class="col-4">
                                        <label class="form-label">Ship's Carry:</label>
                                        <select class="form-select" aria-label="Default select example" required id="shipCarry" name="shipCarry">
                                            <option selected>Open this select menu</option>
                                            <option value="Wood">Wood</option>
                                            <option value="Plywood">Plywood</option>
                                            <option value="Soya">Soya</option>
                                            <option value="Cable">Cable</option>
                                            <option value="Rice">Rice</option>
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <label class="form-label">Applicants Slot:</label>
                                        <input type="number" value="0" class="form-control shadow-sm bg-body rounded text-center" id="slot" name="slot">
                                    </div>
                                </div>
                                <div class="row g-1 mt-3">
                                    <div class="col-6">
                                        <label class="form-label">Operation Start:</label>
                                        <input type="datetime-local" class="form-control shadow-sm bg-body rounded" required id="operationStart" name="operationStart">
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label">Operation End:</label>
                                        <input type="datetime-local" class="form-control shadow-sm bg-body rounded" required id="operationEnd" name="operationEnd">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-4 ms-auto">
                                        <button type="submit" id="updateOperations" name="updateOperations" class="btn btn-primary py-2">Save Changes</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        {{-- UPDATE OPERATION --}}

        {{-- EXCEL MODAL --}}
            <div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-10">
                                <h5 class="modal-title" id="exampleModalLongTitle">Import Operation</h5>
                            </div>
                            <div class="col-2 ms-auto">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                        </div>
                        <form id="importOperationForm" name="importOperationForm">
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