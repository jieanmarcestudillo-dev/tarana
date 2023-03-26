<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

    <div class="d-flex" id="wrapper">
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
                            <h4 class="ms-2 ms-lg-3 pt-2">UPCOMING OPERATION</h4>
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
                    <div class="container-fluid mainBar mt-0 mt-lg-2">
                        <div class="row px-0 px-lg-2" id="fetchAllOperation"></div>
                    </div>
                {{-- MAIN CONTENT --}}
            </div>
        {{-- END MAIN CONTENT --}}
    </div>

    {{-- JS --}}
        <script src="{{ asset('/js/dateTime.js') }}"></script>
        <script src="{{ asset('/js/applicants/sidenav.js') }}"></script>
        <script src="{{ asset('/js/applicants/operations.js') }}"></script>
        <script src="{{ asset('/js/logout.js') }}"></script>
    {{-- END JS --}}

    {{-- MODAL --}}
        {{-- OPERATION DETAILS --}}
            <div class="modal fade" id="viewOperationDetails" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="row">
                                <div class='col-lg-11 col-10'>
                                </div>
                                <div class='col-lg-1 col-2'>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                            </div>
                            <div class='row' id='showScheduledDetails'></div>
                        </div>
                    </div>
                </div>
            </div>
        {{-- OPERATION DETAILS --}}
    {{-- MODAL --}}
</body>
</html>