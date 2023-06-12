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
    <div class="container d-flex flex-column">
        <div class="row align-items-center justify-content-center
            min-vh-100 g-0">
          <div class="col-12 col-md-8 col-lg-4 border-top border-3 border-danger">
            <div class="card shadow-sm">
              <div class="card-body">
                <div class="mb-4">
                  <h5>Forgot Password?</h5>
                  <p class="mb-2">Enter your registered email to receive a link for reset password page.
                  </p>
                </div>
                <form id='userForgotPassword' name='userForgotPassword'>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="userEmail" id="userEmailForgotPass" class="form-control rounded-0" placeholder="Enter Your Email"
                      required="">
                  </div>
                  <div class="mb-3 d-grid">
                    <button type="submit" class="btn btn-danger rounded-0">
                      Submit
                    </button>
                  </div>
                  <span>Remember your password? <a class="text-danger" href="/applicantsAuthentication">sign in</a></span>
                </form>
              </div>
            </div>
          </div>
        </div>
    </div>

    {{-- JS --}}
        <script src="{{ asset('/js/userForgotPassword.js') }}"></script>
    {{-- JS --}}
</body>
</html>
