<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('cdn')
    {{-- CSS --}}
    <link href="{{ asset('/css/applicants/applicantsDashboard.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/applicants/sideBar.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ URL('/assets/frontend/logoo.webp')}}" type="image/x-icon">
    {{-- CSS --}}
    <title>TARA NA</title>
</head>
<body>

    <div class="d-flex mb-3" id="wrapper">
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
                            <h4 class="ms-2 pt-2 text-lg-start">MANAGE ACCOUNT</h4>
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
                        <div class="mt-3">
                            <div class="card bg-light p-4 bg-body rounded shadow-lg">
                                <h5 class="mb-4 text-lg-start text-center">Personal Information</h4>
                                <ul class="nav nav-tabs mb-4 text-lg-start text-center">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#">&nbsp;&nbsp;Information&nbsp;&nbsp;</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="/applicantCredentialsRoutes">Credentials</a>
                                    </li>
                                </ul>
                                {{-- INFO --}}
                                    <form id="manageAccountForm" name="manageAccountForm">
                                        <div class="row gap-0">
                                            <div class="col-lg-12 col-sm-12 text-center">
                                                <div class="mb-3">
                                                    <img class="img-thumbnail border-0 profilePicture" id="appPhotos" style="height:170px; clip-path:circle();" src="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row gap-0">
                                            <div class="col-12">
                                                <div class="mb-3">
                                                    <label for="formFile" class="form-label">Profile Picture</label>
                                                    <input class="form-control shadow-sm bg-body rounded" type="file" name="appPhotos"  id="appPhotos2" accept="image/png, image/jpg, image/jpeg, image/gif, image/svg">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row gap-0">
                                            <div class="col-lg-3 col-sm-12">
                                                <div class="mb-3">
                                                    <label for="formFile" class="form-label">First Name</label>
                                                    <input required class="form-control shadow-sm bg-body rounded" type="text"  id="appFirstName" name="appFirstName">
                                                    <input required class="form-control shadow-sm bg-body rounded" type="hidden"  id="appId" name="appId">
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-sm-12">
                                                <div class="mb-3">
                                                    <label for="formFile" class="form-label">Middle Name</label>
                                                    <input class="form-control shadow-sm bg-body rounded" type="text"  id="appMiddleName" name="appMiddleName">
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-sm-12">
                                                <div class="mb-3">
                                                    <label for="formFile" class="form-label">Last Name</label>
                                                    <input required class="form-control shadow-sm bg-body rounded" type="text"  id="appLastName" name="appLastName">
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-sm-12">
                                                <div class="mb-3">
                                                    <label for="formFile" class="form-label">Extention</label>
                                                    <select class="form-select  shadow-sm bg-body rounded" aria-label="Default select example" id="appExtention" name="appExtention">
                                                        <option value="" selected>None</option>
                                                        <option value="Jr.">Jr.</option>
                                                        <option value="Sr.">Sr.</option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row gap-0">
                                            <div class="col-lg-2 col-sm-12">
                                                <div class="mb-3">
                                                    <label for="formFile" class="form-label">Sex:</label>
                                                    <select required class="form-select  shadow-sm bg-body rounded" aria-label="Default select example" id="appGender" Name="appGender">
                                                        <option value="Male" selected>Male</option>
                                                        <option value="Female">Female</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-sm-12">
                                                <div class="mb-3">
                                                    <label for="formFile" class="form-label">Status</label>
                                                    <select required class="form-select  shadow-sm bg-body rounded" aria-label="Default select example" id="appStatus" Name="appStatus">
                                                        <option value="Single" selected>Single</option>
                                                        <option value="Married">Married</option>
                                                        <option value="Widowed">Widowed</option>
                                                        <option value="Divorced">Divorced</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-sm-12">
                                                <div class="mb-3">
                                                    <label for="formFile" class="form-label">Birthday: d/m/y</label>
                                                    <input required type="date" class="form-control shadow-sm bg-body rounded" onchange="calculateAge()" id="appBirthday" Name="appBirthday">
                                                </div>
                                            </div>
                                            <div class="col-lg-1 col-sm-12">
                                                <div class="mb-3">
                                                    <label for="formFile" class="form-label">Age</label>
                                                    <input required type="number" readonly class="form-control shadow-sm bg-body rounded" id="appAge" Name="appAge">
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-sm-12">
                                                <div class="mb-3">
                                                    <label for="formFile" class="form-label">Phone Number: </label>
                                                    <input required type="text" class="form-control shadow-sm bg-body rounded" id="appPhoneNumber" Name="appPhoneNumber">
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-sm-12">
                                                <div class="mb-3">
                                                    <label for="formFile" class="form-label">Email Address</label>
                                                    <input required type="email" class="form-control shadow-sm bg-body rounded" id="appEmail" name="appEmail">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row gap-0">
                                            {{-- <div class="col-lg-2 col-sm-12">
                                                <div class="mb-3">
                                                    <label for="formFile" class="form-label">Nationality</label>
                                                    <input required type="text" class="form-control shadow-sm bg-body rounded" id="appNationality" name="appNationality">
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-sm-12">
                                                <div class="mb-3">
                                                    <label for="formFile" class="form-label">Religion</label>
                                                    <input required type="text" class="form-control shadow-sm bg-body rounded" id="appReligion" name="appReligion">
                                                </div>
                                            </div> --}}
                                            <div class="col-12">
                                                <div class="mb-3">
                                                    <label for="formFile" class="form-label">Address</label>
                                                    <input required type="text" class="form-control shadow-sm bg-body rounded" id="appAddress" name="appAddress">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-lg-2 ms-auto col-sm-12 text-lg-end text-center">
                                                <button type="submit" class="btn btn-primary px-3">Save Changes</button>
                                            </div>
                                        </div>
                                    </form>
                                {{-- INFO --}}
                            </div>
                        </div>
                        {{-- PERSONAL ID --}}
                            <div class="mt-3">
                                <form id="updatePersonalIdForm" name="updatePersonalIdForm">
                                <div class="card bg-light p-4 bg-body rounded shadow-lg">
                                    <h5 class="mb-4 text-lg-start text-center">Project Workers Identification</h5>
                                    <div class="row">
                                        <div class="col-lg-6 col-sm-12">
                                            <div class="mb-3">
                                                <label for="formFile" class="form-label">Insert here your id:</label>
                                                <input name="updatePersonalId" id="updatePersonalId1" class="form-control shadow-sm bg-body rounded" type="file" accept="image/png, image/jpg, image/jpeg, image/gif, image/svg">
                                            </div>
                                            <div class="mb-3">
                                                <img id="updatePersonalId" class="img-thumbnail border-0" style='width:100%;'>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-2 ms-auto col-sm-12 text-lg-end text-center">
                                                <button type="button" id="updatePersonalIdBtn" class="btn btn-primary px-3">Save Changes</button>
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        {{-- PERSONAL ID --}}
                    </div>
                {{-- MAIN CONTENT --}}
            </div>
        {{-- END MAIN CONTENT --}}
    </div>

    {{-- JS --}}
        <script src="{{ asset('/js/dateTime.js') }}"></script>
        <script src="{{ asset('/js/applicants/sidenav.js') }}"></script>
        <script src="{{ asset('/js/applicants/account.js') }}"></script>
        <script src="{{ asset('/js/logout.js') }}"></script>
    {{-- END JS --}}
</body>
</html>
