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
                            <h4 class="ms-2 pt-2">OPERATION SCHEDULE</h4>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                                    <li>
                                        <a class="text-white nav-link me-3">
                                            <span id="fetchFirstname"></span>
                                            <span id="fetchLastname"></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                {{-- NAV BAR --}}

                {{-- MAIN CONTENT --}}
                    <div class="container-fluid mainBar">
                        <div class='mb-4' id="fetchAllSchedule"></div>
                    </div>
                {{-- MAIN CONTENT --}}
            </div>
        {{-- END MAIN CONTENT --}}
    </div>

    {{-- JS --}}
        <script src="{{ asset('/js/dateTime.js') }}"></script>
        <script src="{{ asset('/js/applicants/sidenav.js') }}"></script>
        <script src="{{ asset('/js/applicants/scheduled.js') }}"></script>
        <script src="{{ asset('/js/logout.js') }}"></script>
    {{-- END JS --}}
</body>
</html>