<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tara Na</title>
    <meta name="description" content="Wave is a Bootstrap 5 One Page Template.">
    <link href="{{ asset('/css/mainHome/homePlugin.css') }}" rel="stylesheet">
    <link rel="icon" type="image/webp"  href="./assets/frontend/logo_title.webp" style="clip-path:circle();">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;300;400;500;600;700&family=Satisfy&display=swap" rel="stylesheet">
    @include('cdn')
</head>
  <body class="has-fixed-navbar" data-bs-spy="scroll" data-bs-target="#navbar-wave" data-bs-smooth-scroll="true" tabindex="0">
  
    <!-- HEADER -->
        <header id="header">
        <nav class="navbar navbar-expand-md bg-white fixed-top ">
            <div class="container">
                <div class="navbar-brand fw-bold d-lg-block d-none">
                    <img src="./assets/frontend/logo.webp" class="img-thumnail" width="50%">
                </div>
            <button class="navbar-toggler border-0 ms-auto" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
                </svg>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                <ul id="navbar-wave" class="navbar-nav justify-content-end flex-grow-1 text-center mt-5 pt-5 mt-lg-0 pt-lg-0">
                    <li class="nav-item mt-5 pt-5 mt-lg-0 pt-lg-0">
                        <a type="button" href="/applicantsAuthentication" class="btn py-2">Sign In</a> 
                    </li>
                    <li class="nav-item mt-2 pt-2 mt-lg-0 pt-lg-0">
                        <a type="button" href="/applicantSignUp" style="background-color:#800" class="btn text-white rounded-0 py-2 px-4 ms-2">Sign Up</a>
                    </li>
                </ul>
                </div>
            </div>
            </div>
        </nav>

        <section id="scrollspyHome" class="wave-bg-white py-3 mt-xl-0 mt-xxl-0">
            <div class="container overflow-hidden">
            <div class="row gy-5 gy-lg-0 align-items-lg-center justify-content-lg-between">
                <div class="col-12 col-lg-6 order-1 order-lg-0">
                <h1 class="display-3 fw-bolder mb-3">SUBIC<br><span class="fw-bold" style="color:#800">CONSOLIDATED</span> <br>PROJECTS, INC.</h1>
                <p class="fs-4 mb-5">SCPI is a fast growing company engaged in heavy equipment rental services for construction, logistic</p>
                <div class="d-grid gap-2 d-sm-flex">
                    <a type="button" href="/applicantsAuthentication" style="background-color:#800" class="btn text-white btn-2xl rounded-0 px-4 gap-3">Learn More</a>
                </div>
                </div>
                <div class="col-12 col-lg-5 text-center">
                <img class="img-fluid mask-position-center-center mask-repeat-no-repeat mask-size-auto rounded-pill" loading="lazy" src="./assets/frontend/cargoWorker.webp">
                </div>
            </div>
            </div>
        </section>
        </header>
    <!-- HEADER -->

    <!-- MAIN -->
        <main id="main">
        <!-- SERVICES-->
            <section id="scrollspyServices" class="py-xl-8 py-5 my-xl-8">
                <div class="container mb-5 mb-md-6 mb-xl-10">
                <div class="row justify-content-md-center">
                    <div class="col-12 col-md-10 col-lg-9 col-xl-8 col-xxl-7 text-center">
                    <h5 class="display-4 fw-bolder mb-4 text-uppercase">An Interactive <br> <span class="fw-bold" style="color:#800"> on-call staff</span> Scheduling System for SCPI</h5>
                    </div>
                </div>
                </div>

                <div class="container overflow-hidden">
                <div class="row gy-5 gy-md-6 gx-md-4 gy-lg-0 gx-xxl-5">
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="badge wave-bg-pink text-primary p-3 mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-airplane-engines" viewBox="0 0 16 16">
                            <path d="M8 0c-.787 0-1.292.592-1.572 1.151A4.347 4.347 0 0 0 6 3v3.691l-2 1V7.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.191l-1.17.585A1.5 1.5 0 0 0 0 10.618V12a.5.5 0 0 0 .582.493l1.631-.272.313.937a.5.5 0 0 0 .948 0l.405-1.214 2.21-.369.375 2.253-1.318 1.318A.5.5 0 0 0 5.5 16h5a.5.5 0 0 0 .354-.854l-1.318-1.318.375-2.253 2.21.369.405 1.214a.5.5 0 0 0 .948 0l.313-.937 1.63.272A.5.5 0 0 0 16 12v-1.382a1.5 1.5 0 0 0-.83-1.342L14 8.691V7.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v.191l-2-1V3c0-.568-.14-1.271-.428-1.849C9.292.591 8.787 0 8 0ZM7 3c0-.432.11-.979.322-1.401C7.542 1.159 7.787 1 8 1c.213 0 .458.158.678.599C8.889 2.02 9 2.569 9 3v4a.5.5 0 0 0 .276.447l5.448 2.724a.5.5 0 0 1 .276.447v.792l-5.418-.903a.5.5 0 0 0-.575.41l-.5 3a.5.5 0 0 0 .14.437l.646.646H6.707l.647-.646a.5.5 0 0 0 .14-.436l-.5-3a.5.5 0 0 0-.576-.411L1 11.41v-.792a.5.5 0 0 1 .276-.447l5.448-2.724A.5.5 0 0 0 7 7V3Z"/>
                            </svg>
                        </div>
                        <h4 class="mb-3">Manage Operation</h4>
                        <p class="mb-3 text-secondary">Vestibulum bibendum, lorem a blandit lacinia, nisi velit posuere nisl, vel placerat magna mauris mollis maximus est.</p>
                        <a href="#!" class="fw-bold text-decoration-none" style="color:#800">
                            Learn More
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"/>
                            </svg>
                        </a>
                        </div>
                    <div class="col-12 col-sm-6 col-lg-3">
                    <div class="badge wave-bg-yellow text-primary p-3 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-pie-chart" viewBox="0 0 16 16">
                        <path d="M7.5 1.018a7 7 0 0 0-4.79 11.566L7.5 7.793V1.018zm1 0V7.5h6.482A7.001 7.001 0 0 0 8.5 1.018zM14.982 8.5H8.207l-4.79 4.79A7 7 0 0 0 14.982 8.5zM0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8z"/>
                        </svg>
                    </div>
                    <h4 class="mb-3">Provide Job</h4>
                    <p class="mb-3 text-secondary">Vestibulum bibendum, lorem a blandit lacinia, nisi velit posuere nisl, vel placerat magna mauris mollis maximus est.</p>
                    <a href="#!" class="fw-bold text-decoration-none" style="color:#800">
                        Learn More
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"/>
                        </svg>
                    </a>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-3">
                    <div class="badge wave-bg-green text-primary p-3 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-aspect-ratio" viewBox="0 0 16 16">
                        <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h13A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 12.5v-9zM1.5 3a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-13z"/>
                        <path d="M2 4.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1H3v2.5a.5.5 0 0 1-1 0v-3zm12 7a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1 0-1H13V8.5a.5.5 0 0 1 1 0v3z"/>
                        </svg>
                    </div>
                    <h4 class="mb-3">Easily Recruit</h4>
                    <p class="mb-3 text-secondary">Vestibulum bibendum, lorem a blandit lacinia, nisi velit posuere nisl, vel placerat magna mauris mollis maximus est.</p>
                    <a href="#!" class="fw-bold text-decoration-none" style="color:#800">
                        Learn More
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"/>
                        </svg>
                    </a>
                    </div>            
                    <div class="col-12 col-sm-6 col-lg-3">
                    <div class="badge wave-bg-cyan text-primary p-3 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-alarm" viewBox="0 0 16 16">
                        <path d="M8.5 5.5a.5.5 0 0 0-1 0v3.362l-1.429 2.38a.5.5 0 1 0 .858.515l1.5-2.5A.5.5 0 0 0 8.5 9V5.5z"/>
                        <path d="M6.5 0a.5.5 0 0 0 0 1H7v1.07a7.001 7.001 0 0 0-3.273 12.474l-.602.602a.5.5 0 0 0 .707.708l.746-.746A6.97 6.97 0 0 0 8 16a6.97 6.97 0 0 0 3.422-.892l.746.746a.5.5 0 0 0 .707-.708l-.601-.602A7.001 7.001 0 0 0 9 2.07V1h.5a.5.5 0 0 0 0-1h-3zm1.038 3.018a6.093 6.093 0 0 1 .924 0 6 6 0 1 1-.924 0zM0 3.5c0 .753.333 1.429.86 1.887A8.035 8.035 0 0 1 4.387 1.86 2.5 2.5 0 0 0 0 3.5zM13.5 1c-.753 0-1.429.333-1.887.86a8.035 8.035 0 0 1 3.527 3.527A2.5 2.5 0 0 0 13.5 1z"/>
                        </svg>
                    </div>
                    <h4 class="mb-3">Generate Reports</h4>
                    <p class="mb-3 text-secondary">Vestibulum bibendum, lorem a blandit lacinia, nisi velit posuere nisl, vel placerat magna mauris mollis maximus est.</p>
                    <a href="#!" class="fw-bold text-decoration-none" style="color:#800">
                        Learn More
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"/>
                        </svg>
                    </a>
                    </div>
                </div>
                </div>
            </section>
        <!-- SERVICES-->

        <!-- PORT IMAGES -->
            <section class="px-2 py-8 py-xxl-16 background-position-center background-size-cover background-attachment-fixed bsb-overlay" style="background-image: url('./assets/frontend/cargo.webp');">
                <div class="container">
                <div class="row">
                    <div class="col-12 col-md-9 col-lg-8 col-xl-8 col-xxl-7">
                    <h3 class="fs-5 mb-3 text-white text-uppercase"><mark class="text-white wave-highlight">Subic Bay Freeport Zone</mark></h3>
                    <h2 class="display-3 text-white fw-bolder mb-4 pe-xl-5">We are a company who offer best cargo management services at the Subic Bay Port.</h2>
                    <a href="#!" class="btn text-white btn-3xl rounded-0 mb-0 text-nowrap" style="background-color: #800;">Join Us</a>
                    </div>
                </div>
                </div>
            </section>
        <!-- PORT IMAGES -->

        <!-- BLOG -->
            {{-- <section id="scrollspyBlog" class="wave-bg-linen py-5 py-xl-8 py-xxl-16">
                <div class="container">
                <div class="row gy-5 gy-lg-0 gx-lg-8 align-items-center">
                    <div class="col-12 col-lg-5">
                    <h2 class="display-3 fw-bolder mb-4">Our <mark class="wave-highlight wave-highlight-yellow"><span class="wave-font-hw display-1 fw-normal" style="color: #800;">Blog</span></mark></h2>
                    <p class="fs-4 mb-4 mb-xl-5">Stay tuned and updated by the latest updates from our blog.</p>
                    <a href="#!" class="btn btn-2xl rounded-0 text-white" style="background-color: #800">More News</a>
                    </div>
                    <div class="col-12 col-lg-7">
                    <div class="row gy-4 gy-xxl-5 gx-xxl-5">
                        <div class="col-12 col-lg-6">
                        <article>
                            <figure class="rounded-0 overflow-hidden mb-3 bsb-hover-overlay">
                            <a href="#!">
                                <img class="img-fluid bsb-scale bsb-hover-scale-up" loading="lazy" src="./assets/frontend/blog-image-1.webp" alt="">
                            </a>
                            <figcaption>
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-eye text-white bsb-hover-fadeInRight" viewBox="0 0 16 16">
                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                </svg>
                                <h4 class="h6 text-white bsb-hover-fadeInLeft mt-2">Read More</h4>
                            </figcaption>
                            </figure>
                            <div class="entry-header mb-3">
                            <div class="entry-meta">
                                <ul class="nav mb-2">
                                <li class="nav-item">
                                    <a class="nav-link d-inline px-1 link-primary" href="#!">Business</a>
                                </li>
                                </ul>
                            </div>
                            <h2 class="entry-title h4 mb-0">
                                <a class="link-dark text-decoration-none" href="#!">How to Improve Your Project Management Skills</a>
                            </h2>
                            </div>
                            <div class="entry-footer">
                            <div class="entry-meta">
                                <ul class="nav mb-0 bsb-nav-sep">
                                <li class="nav-item text-secondary">
                                    <a class="nav-link link-muted p-0 pe-3 d-inline-flex align-items-center" href="#!">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-calendar3" viewBox="0 0 16 16">
                                        <path d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857V3.857z"/>
                                        <path d="M6.5 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                                    </svg>
                                    <span class="ms-2 fs-7">7 Dec 2023</span>
                                    </a>
                                </li>
                                <li class="nav-item text-secondary">
                                    <a class="nav-link link-secondary p-0 ps-3 d-inline-flex align-items-center" href="#!">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-chat-dots" viewBox="0 0 16 16">
                                        <path d="M5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                                        <path d="m2.165 15.803.02-.004c1.83-.363 2.948-.842 3.468-1.105A9.06 9.06 0 0 0 8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6a10.437 10.437 0 0 1-.524 2.318l-.003.011a10.722 10.722 0 0 1-.244.637c-.079.186.074.394.273.362a21.673 21.673 0 0 0 .693-.125zm.8-3.108a1 1 0 0 0-.287-.801C1.618 10.83 1 9.468 1 8c0-3.192 3.004-6 7-6s7 2.808 7 6c0 3.193-3.004 6-7 6a8.06 8.06 0 0 1-2.088-.272 1 1 0 0 0-.711.074c-.387.196-1.24.57-2.634.893a10.97 10.97 0 0 0 .398-2z"/>
                                    </svg>
                                    <span class="ms-2 fs-7">55</span>
                                    </a>
                                </li>
                                </ul>
                            </div>
                            </div>
                        </article>
                        </div>
                        <div class="col-12 col-lg-6">
                        <article>
                            <figure class="rounded-0 overflow-hidden mb-3 bsb-hover-overlay">
                            <a href="#!">
                                <img class="img-fluid bsb-scale bsb-hover-scale-up" loading="lazy" src="./assets/frontend/blog-image-2.webp" alt="">
                            </a>
                            <figcaption>
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-eye text-white bsb-hover-fadeInLeft" viewBox="0 0 16 16">
                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                </svg>
                                <h4 class="h6 text-white bsb-hover-fadeInRight mt-2">Read More</h4>
                            </figcaption>
                            </figure>
                            <div class="entry-header mb-3">
                            <div class="entry-meta">
                                <ul class="nav mb-2">
                                <li class="nav-item">
                                    <a class="nav-link d-inline px-1 link-primary" href="#!">Technology</a>
                                </li>
                                </ul>
                            </div>
                            <h2 class="entry-title h4 mb-0">
                                <a class="link-dark text-decoration-none" href="#!">Modern Cybersecurity Trends to Watch in 2023</a>
                            </h2>
                            </div>
                            <div class="entry-footer">
                            <div class="entry-meta">
                                <ul class="nav mb-0 bsb-nav-sep">
                                <li class="nav-item text-secondary">
                                    <a class="nav-link link-secondary p-0 pe-3 d-inline-flex align-items-center" href="#!">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-calendar3" viewBox="0 0 16 16">
                                        <path d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857V3.857z"/>
                                        <path d="M6.5 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                                    </svg>
                                    <span class="ms-2 fs-7">12 Sep 2023</span>
                                    </a>
                                </li>
                                <li class="nav-item text-secondary">
                                    <a class="nav-link link-secondary p-0 ps-3 d-inline-flex align-items-center" href="#!">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-chat-dots" viewBox="0 0 16 16">
                                        <path d="M5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                                        <path d="m2.165 15.803.02-.004c1.83-.363 2.948-.842 3.468-1.105A9.06 9.06 0 0 0 8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6a10.437 10.437 0 0 1-.524 2.318l-.003.011a10.722 10.722 0 0 1-.244.637c-.079.186.074.394.273.362a21.673 21.673 0 0 0 .693-.125zm.8-3.108a1 1 0 0 0-.287-.801C1.618 10.83 1 9.468 1 8c0-3.192 3.004-6 7-6s7 2.808 7 6c0 3.193-3.004 6-7 6a8.06 8.06 0 0 1-2.088-.272 1 1 0 0 0-.711.074c-.387.196-1.24.57-2.634.893a10.97 10.97 0 0 0 .398-2z"/>
                                    </svg>
                                    <span class="ms-2 fs-7">39</span>
                                    </a>
                                </li>
                                </ul>
                            </div>
                            </div>
                        </article>
                        </div>
                        <div class="col-12 col-lg-6">
                        <article>
                            <figure class="rounded-0 overflow-hidden mb-3 bsb-hover-overlay">
                            <a href="#!">
                                <img class="img-fluid bsb-scale bsb-hover-scale-up" loading="lazy" src="./assets/frontend/blog-image-3.webp" alt="">
                            </a>
                            <figcaption>
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-eye text-white bsb-hover-fadeInDown" viewBox="0 0 16 16">
                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                </svg>
                                <h4 class="h6 text-white bsb-hover-fadeInUp mt-2">Read More</h4>
                            </figcaption>
                            </figure>
                            <div class="entry-header mb-3">
                            <div class="entry-meta">
                                <ul class="nav mb-2">
                                <li class="nav-item">
                                    <a class="nav-link d-inline px-1 link-primary" href="#!">Health</a>
                                </li>
                                </ul>
                            </div>
                            <h2 class="entry-title h4 mb-0">
                                <a class="link-dark text-decoration-none" href="#!">Health Care Job Growth Outpaces Other Industries</a>
                            </h2>
                            </div>
                            <div class="entry-footer">
                            <div class="entry-meta">
                                <ul class="nav mb-0 bsb-nav-sep">
                                <li class="nav-item text-secondary">
                                    <a class="nav-link link-secondary p-0 pe-3 d-inline-flex align-items-center" href="#!">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-calendar3" viewBox="0 0 16 16">
                                        <path d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857V3.857z"/>
                                        <path d="M6.5 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                                    </svg>
                                    <span class="ms-2 fs-7">13 Jul 2023</span>
                                    </a>
                                </li>
                                <li class="nav-item text-secondary">
                                    <a class="nav-link link-secondary p-0 ps-3 d-inline-flex align-items-center" href="#!">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-chat-dots" viewBox="0 0 16 16">
                                        <path d="M5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                                        <path d="m2.165 15.803.02-.004c1.83-.363 2.948-.842 3.468-1.105A9.06 9.06 0 0 0 8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6a10.437 10.437 0 0 1-.524 2.318l-.003.011a10.722 10.722 0 0 1-.244.637c-.079.186.074.394.273.362a21.673 21.673 0 0 0 .693-.125zm.8-3.108a1 1 0 0 0-.287-.801C1.618 10.83 1 9.468 1 8c0-3.192 3.004-6 7-6s7 2.808 7 6c0 3.193-3.004 6-7 6a8.06 8.06 0 0 1-2.088-.272 1 1 0 0 0-.711.074c-.387.196-1.24.57-2.634.893a10.97 10.97 0 0 0 .398-2z"/>
                                    </svg>
                                    <span class="ms-2 fs-7">61</span>
                                    </a>
                                </li>
                                </ul>
                            </div>
                            </div>
                        </article>
                        </div>
                        <div class="col-12 col-lg-6">
                        <article>
                            <figure class="rounded-0 overflow-hidden mb-3 bsb-hover-overlay">
                            <a href="#!">
                                <img class="img-fluid bsb-scale bsb-hover-scale-up" loading="lazy" src="./assets/frontend/blog-image-4.webp" alt="">
                            </a>
                            <figcaption>
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-eye text-white bsb-hover-fadeInUp" viewBox="0 0 16 16">
                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                </svg>
                                <h4 class="h6 text-white bsb-hover-fadeInDown mt-2">Read More</h4>
                            </figcaption>
                            </figure>
                            <div class="entry-header mb-3">
                            <div class="entry-meta">
                                <ul class="nav mb-2">
                                <li class="nav-item">
                                    <a class="nav-link d-inline px-1 link-primary" href="#!">Networking</a>
                                </li>
                                </ul>
                            </div>
                            <h2 class="entry-title h4 mb-0">
                                <a class="link-dark text-decoration-none" href="#!">Five Essential Network Security Trends to Watch</a>
                            </h2>
                            </div>
                            <div class="entry-footer">
                            <div class="entry-meta">
                                <ul class="nav mb-0 bsb-nav-sep">
                                <li class="nav-item text-secondary">
                                    <a class="nav-link link-secondary p-0 pe-3 d-inline-flex align-items-center" href="#!">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-calendar3" viewBox="0 0 16 16">
                                        <path d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857V3.857z"/>
                                        <path d="M6.5 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                                    </svg>
                                    <span class="ms-2 fs-7">21 Feb 2023</span>
                                    </a>
                                </li>
                                <li class="nav-item text-secondary">
                                    <a class="nav-link link-secondary p-0 ps-3 d-inline-flex align-items-center" href="#!">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-chat-dots" viewBox="0 0 16 16">
                                        <path d="M5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                                        <path d="m2.165 15.803.02-.004c1.83-.363 2.948-.842 3.468-1.105A9.06 9.06 0 0 0 8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6a10.437 10.437 0 0 1-.524 2.318l-.003.011a10.722 10.722 0 0 1-.244.637c-.079.186.074.394.273.362a21.673 21.673 0 0 0 .693-.125zm.8-3.108a1 1 0 0 0-.287-.801C1.618 10.83 1 9.468 1 8c0-3.192 3.004-6 7-6s7 2.808 7 6c0 3.193-3.004 6-7 6a8.06 8.06 0 0 1-2.088-.272 1 1 0 0 0-.711.074c-.387.196-1.24.57-2.634.893a10.97 10.97 0 0 0 .398-2z"/>
                                    </svg>
                                    <span class="ms-2 fs-7">61</span>
                                    </a>
                                </li>
                                </ul>
                            </div>
                            </div>
                        </article>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </section> --}}
        <!-- BLOG -->

        <!-- CONTACTS -->
            <section id="scrollspyContact" class="py-5 py-xl-8 py-xxl-16">
                <div class="container">
                <div class="row gy-5 gy-lg-0 gx-lg-6 gx-xxl-8 align-items-lg-center">
                    <div class="col-12 col-lg-6">
                    <img class="img-fluid rounded-0" loading="lazy" src="./assets/frontend/contact-img-1.webp" alt="">
                    </div>
                    <div class="col-12 col-lg-6">
                    <h2 class="h1 mb-3">Get in touch</h2>
                    <p class="lead fs-4 text-secondary mb-5">We're always on the lookout to work with new applicants. If you're interested in working with us, please get in touch in one of the following ways.</p>
                    <div class="d-flex mb-4">
                        <div class="me-4 text-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#800000" class="bi bi-geo" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 1a3 3 0 1 0 0 6 3 3 0 0 0 0-6zM4 4a4 4 0 1 1 4.5 3.969V13.5a.5.5 0 0 1-1 0V7.97A4 4 0 0 1 4 3.999zm2.493 8.574a.5.5 0 0 1-.411.575c-.712.118-1.28.295-1.655.493a1.319 1.319 0 0 0-.37.265.301.301 0 0 0-.057.09V14l.002.008a.147.147 0 0 0 .016.033.617.617 0 0 0 .145.15c.165.13.435.27.813.395.751.25 1.82.414 3.024.414s2.273-.163 3.024-.414c.378-.126.648-.265.813-.395a.619.619 0 0 0 .146-.15.148.148 0 0 0 .015-.033L12 14v-.004a.301.301 0 0 0-.057-.09 1.318 1.318 0 0 0-.37-.264c-.376-.198-.943-.375-1.655-.493a.5.5 0 1 1 .164-.986c.77.127 1.452.328 1.957.594C12.5 13 13 13.4 13 14c0 .426-.26.752-.544.977-.29.228-.68.413-1.116.558-.878.293-2.059.465-3.34.465-1.281 0-2.462-.172-3.34-.465-.436-.145-.826-.33-1.116-.558C3.26 14.752 3 14.426 3 14c0-.599.5-1 .961-1.243.505-.266 1.187-.467 1.957-.594a.5.5 0 0 1 .575.411z"/>
                        </svg>
                        </div>
                        <div>
                        <h4 class="mb-3">Address</h4>
                        <address class="mb-0 text-secondary">Bldg. 867 Remy Field Cmpd Canal Rd CBD Area, Olongapo, Philippines</address>
                        </div>
                    </div>
                    <div class="d-flex mb-4">
                        <div class="me-4 text-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#800000" class="bi bi-telephone-outbound" viewBox="0 0 16 16">
                            <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511zM11 .5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V1.707l-4.146 4.147a.5.5 0 0 1-.708-.708L14.293 1H11.5a.5.5 0 0 1-.5-.5z"/>
                        </svg>
                        </div>
                        <div>
                        <h4 class="mb-3">Phone</h4>
                        <p class="mb-0">
                            <a class="link-secondary text-decoration-none" href="tel:+15057922430">(047) 252 1877</a>
                        </p>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="me-4 text-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#800000" class="bi bi-envelope-at" viewBox="0 0 16 16">
                            <path d="M2 2a2 2 0 0 0-2 2v8.01A2 2 0 0 0 2 14h5.5a.5.5 0 0 0 0-1H2a1 1 0 0 1-.966-.741l5.64-3.471L8 9.583l7-4.2V8.5a.5.5 0 0 0 1 0V4a2 2 0 0 0-2-2H2Zm3.708 6.208L1 11.105V5.383l4.708 2.825ZM1 4.217V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v.217l-7 4.2-7-4.2Z"/>
                            <path d="M14.247 14.269c1.01 0 1.587-.857 1.587-2.025v-.21C15.834 10.43 14.64 9 12.52 9h-.035C10.42 9 9 10.36 9 12.432v.214C9 14.82 10.438 16 12.358 16h.044c.594 0 1.018-.074 1.237-.175v-.73c-.245.11-.673.18-1.18.18h-.044c-1.334 0-2.571-.788-2.571-2.655v-.157c0-1.657 1.058-2.724 2.64-2.724h.04c1.535 0 2.484 1.05 2.484 2.326v.118c0 .975-.324 1.39-.639 1.39-.232 0-.41-.148-.41-.42v-2.19h-.906v.569h-.03c-.084-.298-.368-.63-.954-.63-.778 0-1.259.555-1.259 1.4v.528c0 .892.49 1.434 1.26 1.434.471 0 .896-.227 1.014-.643h.043c.118.42.617.648 1.12.648Zm-2.453-1.588v-.227c0-.546.227-.791.573-.791.297 0 .572.192.572.708v.367c0 .573-.253.744-.564.744-.354 0-.581-.215-.581-.8Z"/>
                        </svg>
                        </div>
                        <div>
                        <h4 class="mb-3">E-Mail</h4>
                        <p>
                            <a class="link-secondary text-decoration-none" href="mailto:scpi.ph@gmail.com">scpi.ph@gmail.com</a>
                        </p>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </section>
        <!-- CONTACTS -->
        </main>
    <!-- MAIN -->

    <!-- FOOTER -->
        <footer class="footer">
            <section class="wave-bg-lotion border-top py-4 py-md-5 py-xl-8">
                <div class="container overflow-hidden">
                <div class="row gy-4 gy-lg-0 justify-content-xl-between">
                    <div class="col-12 col-md-4 col-lg-3 col-xl-2">
                    <div class="widget">
                        <a href="#!">
                        <img src="./assets/frontend/scpi.webp" alt="" width="100%" height="100%" style="filter: brightness(70%)">
                        </a>
                    </div>
                    </div>
                    <div class="col-12 col-md-4 col-lg-3 col-xl-2">
                    <div class="widget">
                        <h4 class="widget-title mb-4">Get in Touch</h4>
                        <address class="mb-4">Bldg. 867 Remy Field Cmpd Canal Rd CBD Area, Olongapo, Philippines</address>
                        <p class="mb-1">
                        <a class="link-secondary text-decoration-none" href="tel:+15057922430">(047) 252 1877</a>
                        </p>
                        <p class="mb-0">
                        <a class="link-secondary text-decoration-none" href="mailto:demo@yourdomain.com">scpi.ph@gmail.com</a>
                        </p>
                    </div>
                    </div>
                    <div class="col-12 col-md-4 col-lg-3 col-xl-2">
                    <div class="widget">
                        <h4 class="widget-title mb-4">Learn More</h4>
                        <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="#!" class="link-secondary text-decoration-none">About</a>
                        </li>
                        <li class="mb-2">
                            <a href="#!" class="link-secondary text-decoration-none">Contact</a>
                        </li>
                        <li class="mb-2">
                            <a href="#!" class="link-secondary text-decoration-none">Advertise</a>
                        </li>
                        <li class="mb-2">
                            <a href="#!" class="link-secondary text-decoration-none">Terms of Service</a>
                        </li>
                        <li class="mb-0">
                            <a href="/employeesLoginRoutes" class="link-secondary text-decoration-none">Employees Login</a>
                        </li>
                        </ul>
                    </div>
                    </div>
                    <div class="col-12 col-lg-3 col-xl-4">
                    <div class="widget">
                        <h4 class="widget-title mb-4">Our Newsletter</h4>
                        <p class="mb-4">Subscribe to our newsletter to get our news & discounts delivered to you.</p>
                        <form action="#!">
                        <div class="row gy-4">
                            <div class="col-12">
                            <div class="input-group">
                                <span class="input-group-text" id="email-addon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#800000" class="bi bi-envelope" viewBox="0 0 16 16">
                                    <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z" />
                                </svg>
                                </span>
                                <input type="email" class="form-control" id="email" value="" placeholder="Email Address" aria-label="email" aria-describedby="email-addon" required>
                            </div>
                            </div>
                            <div class="col-12">
                            <div class="d-grid">
                                <button class="btn rounded-0 text-white" style="background-color:#800" type="submit">Subscribe</button>
                            </div>
                            </div>
                        </div>
                        </form>
                    </div>
                    </div>
                </div>
                </div>
            </section>

            <section class="wave-bg-lotion border-top py-4 py-md-5 py-xl-8">
                <div class="container overflow-hidden">
                <div class="row gy-4 gy-md-0">
                    <div class="col-xs-12 col-md-7 order-1 order-md-0">
                    <div class="copyright text-center text-md-start">
                        &copy; 2023. All Rights Reserved.
                    </div>
                    <div class="credits text-secondary text-center text-md-start mt-2 fs-7">
                        Built by <a href="#" class="link-secondary text-decoration-none">In The </a> Script Team<span class="text-primary"></span>
                    </div>
                    </div>

                    <div class="col-xs-12 col-md-5 order-0 order-md-1">
                    <ul class="nav justify-content-center justify-content-md-end">
                        <li class="nav-item">
                        <a class="nav-link link-dark px-2" href="#!">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                            <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z" />
                            </svg>
                        </a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link link-dark px-2" href="#!">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-youtube" viewBox="0 0 16 16">
                            <path d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.007 2.007 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.007 2.007 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31.4 31.4 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.007 2.007 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A99.788 99.788 0 0 1 7.858 2h.193zM6.4 5.209v4.818l4.157-2.408L6.4 5.209z" />
                            </svg>
                        </a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link link-dark px-2" href="#!">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-twitter" viewBox="0 0 16 16">
                            <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z" />
                            </svg>
                        </a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link link-dark px-2" href="#!">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                            <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z" />
                            </svg>
                        </a>
                        </li>
                    </ul>
                    </div>
                </div>
                </div>
            </section>
        </footer>
    <!-- FOOTER -->

    <!-- JS FUNCTION -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
        <script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>
        <script src="https://unpkg.com/imagesloaded@5/imagesloaded.pkgd.js"></script>
        <script src="https://raw.githubusercontent.com/metafizzy/isotope-packery/master/packery-mode.pkgd.min.js"></script>
        <script src="{{ asset('/js/mainHome/project-2.js') }}"></script>
        <script src="{{ asset('/js/mainHome/global.js') }}"></script>
    <!-- JS FUNCTION -->
  </body>
</html>