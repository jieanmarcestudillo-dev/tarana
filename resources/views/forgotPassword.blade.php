<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="shortcut icon" href="{{ URL('/assets/frontend/logoo.webp')}}" type="image/x-icon">
    @include('cdn')
    <title>Tara Na</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row mt-lg-5 pt-lg-5 pt-0 mt-0">
            <div class="col-lg-3 col-12 mx-lg-auto mt-lg-5 pt-lg-5 pt-0 mt-0">
                <div class="card" style="width: 22rem;">
                    <div class="card-body">
                        <form id='appForgotPassword' name='appForgotPassword'>
                            <div class="mb-3">
                              <label for="exampleInputEmail1" class="form-label">Email address</label>
                              <input type="email" class="form-control" name="applicantEmail" id="applicantEmail" aria-describedby="emailHelp">
                              <div id="emailHelp" class="form-text">We send link to your email address</div>
                            </div>
                            <button type="submit" class="btn btn-primary rounded-0">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- JS --}}
        <script src="{{ asset('/js/applicantsAuthentication.js') }}"></script>
    {{-- JS --}}
</body>
</html>