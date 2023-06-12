<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <h3>Dear Workers,</h3>
            <p>We have received a request to reset the password for your email account,
                To ensure the security of your account, please follow the instructions below to reset your password.</p>

            <p>1. Click on the following link to access the password reset page: <span><a class="fw-bold" href="http://127.0.0.1:8000/resetPassword">RESET PASSWORD LINK </a></span></p>
            <p>2. On the password reset page, you will be prompted to enter a new password for your account.
                  Choose a strong and unique password that you haven't used before.</p>
            <p>3. Once you have entered your new password, click the "Reset Password"
                or "Save Changes" button to finalize the password reset process.</p>

        </div>
    </div>

    <script src="{{ asset('/js/userForgotPassword.js') }}"></script>
</body>
</html>
