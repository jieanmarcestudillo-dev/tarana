<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="shortcut icon" href="{{ URL('/assets/frontend/scpi.webp')}}" type="image/x-icon">
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
                  <h5>Reset Password Page</h5>
                </div>
                <form id='resetPasswordForm' name='resetPasswordForm'>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" readonly name="userEmail" id="userEmail" class="form-control rounded-0" placeholder="Enter Your Email">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">New Password</label>
                    <input type="password" name="newPassword" id="newPassword" class="form-control rounded-0" placeholder="Enter Your New Password" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">New Password</label>
                    <input type="password" name="confirmPassword" id="confirmPassword" class="form-control rounded-0" placeholder="Re-Enter Your Password   " required>
                </div>
                <div class="mb-3 checkBox">
                    <input type="checkbox" class="form-check-input ms-1" onclick="seePassword()">
                    <label class="form-check-label">Show Password</label>
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

    <script src="{{ asset('/js/userForgotPassword.js') }}"></script>
</body>
</html>
