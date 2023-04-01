$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});
// LOGIN FUNCTION
    $('#applicantLoginForm').on( 'submit' , function(e){
        e.preventDefault();
        var data = $('#applicantLoginForm').serialize();
        $.ajax({
        url:"/applicantLoginFunction",
        method:"GET",
        dataType:"text",
        data:data
        })
        .done(function(response) {
            var parsed = JSON.parse(response);
            if(response == 1){
                    $('#loginForm').trigger("reset");
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                          toast.addEventListener('mouseenter', Swal.stopTimer)
                          toast.addEventListener('mouseleave', Swal.resumeTimer)
                        },
                        didClose: () =>{
                            window.location = "/applicantDashboardRoutes";
                        }
                      })
                      Toast.fire({
                        icon: 'success',
                        title: 'Signed in successfully',
                        text: 'Welcome Workers',
                      })
            }
            else if(response == 0){
            Swal.fire(
            'Sorry Login Failed',
            'Wrong Username/Password',
            'error'
            )
            }else if(response == 2){
            Swal.fire(
            'Inactive Account',
            'Your account is disable to access the A&S Application',
            'error'
            )
            }else if(response == 3){
                Swal.fire(
                "Already Login",
                "You've already logged into your account on another device.",
                "error"
                )
            }else if(parsed.reason){
                Swal.fire(
                "Sorry Login Failed",
                "You are blocked to access this application the reason is " +parsed.reason,
                "error"
                )
            }
            });
    });
// LOGIN FUNCTION

// FUNCTION FOR PASSWORD ENABLE
    function seePassword() {
        var x = document.getElementById("applicantSignUpPassword");
        var a = document.getElementById("applicantSignUpConfirmPassword");
        if (x.type === 'password' && a.type === 'password'){
            x.type ="text";
            a.type ="text";
        }else{
            x.type="password";
            a.type="password";
        }
        
    }
// FUNCTION FOR PASSWORD ENABLE

// FUNCTION FOR PASSWORD ENABLE
function seePassword2() {
    var x = document.getElementById("applicantPassword");
    if (x.type === 'password'){
        x.type ="text";
    }else{
        x.type="password";
    }
    
}
// FUNCTION FOR PASSWORD ENABLE

// SIGN UP FUNCTION
    $('#applicantRegistrationForm').on( 'submit' , function(e){
            e.preventDefault();
            var email = $('#applicantSignUpEmail').val();
            var password = $('#applicantSignUpPassword').val();
            var confirmPassword = $('#applicantSignUpConfirmPassword').val();
            if(password != confirmPassword){
                Swal.fire(
                    'PASSWORD MISMATCH',
                    'Please, check your password',
                    'error'
                )      
            }
            else if(password < 6 || password > 20){
                Swal.fire(
                    'PASSWORD FAILED',
                    'The password must be longer than 6 characters and less than 20 characters',
                    'error'
                )     
            }else if(password === 'password'){
                Swal.fire(
                    'PASSWORD FAILED',
                    'The password can not be set to password',
                    'error'
                )   
            }else{
                Swal.fire({
                    title: 'Have you ever worked before?',
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    denyButtonText: `No`,
                }).then((result) => {
                    if(result.isConfirmed) {
                        $.ajax({
                            url:"/applicantSignUpFunction",
                            method:"POST",
                            dataType:"text",
                            data:{email:email,password:password,isPro:1},
                            success: function(response) {
                            if(response == 1){
                            Swal.fire({
                            icon: 'success',
                            title: 'REGISTER SUCCESSFULLY',
                            showConfirmButton: false,
                            timer: 1500
                            }).then((result) => {
                            if (result) {
                                $("#applicantRegistrationForm").trigger("reset");
                            }
                            })
                            }
                            else if(response == 2){
                            Swal.fire(
                                'PASSWORD MISMATCH',
                                'Please, check your password',
                                'error'
                            )          
                            }
                            else if(response == 0){
                            Swal.fire(
                            'SORRY REGISTRATION FAILED',
                            'Sorry, please re-enter your credentials',
                            'error'
                            )
                            }
                            else if(response == 3){
                            Swal.fire(
                            'EMAIL ADDRESS NOT AVAILABLE',
                            'Sorry, please choose another valid email',
                            'error'
                            )
                            }
                            },
                            error:function(er){
                            console.log(er)
                            }
                        });
                    }else if(result.isDenied) {
                        $.ajax({
                            url:"/applicantSignUpFunction",
                            method:"POST",
                            dataType:"text",
                            data:{email:email,password:password,isPro:0},
                            success: function(response) {
                            if(response == 1){
                            Swal.fire({
                            icon: 'success',
                            title: 'REGISTER SUCCESSFULLY',
                            showConfirmButton: false,
                            timer: 1500
                            }).then((result) => {
                            if (result) {
                                $("#applicantRegistrationForm").trigger("reset");
                            }
                            })
                            }                   
                            else if(response == 2){
                            Swal.fire(
                            'EMAIL ADDRESS NOT AVAILABLE',
                            'Sorry, please choose another valid email',
                            'error'
                            )
                            }
                            else{
                            Swal.fire(
                            'SORRY REGISTRATION FAILED',
                            'Sorry, please re-enter your credentials',
                            'error'
                            )
                            }
                            },
                            error:function(er){
                            console.log(er)
                            }
                        });
                    }
                })
            }
    });
// SIGN UP FUNCTION

// LISTENER
var sideButtons = document.querySelectorAll('.bottomLink');
sideButtons.forEach(btn => btn.addEventListener('click', () => {
    document.body.classList.toggle('signup');
}))
// LISTENER

$('#appForgotPassword').on( 'submit' , function(e){
    e.preventDefault();
    var data = $('#appForgotPassword').serialize();
    $.ajax({
        url:"/forgotPassword",
        method:"POST",
        dataType:"text",
        data:data,
        success: function(response) {
            if(response == 1){
                Swal.fire({
                icon: 'success',
                title: 'REGISTER SUCCESSFULLY',
                showConfirmButton: false,
                timer: 1500
                }).then((result) => {
                if (result) {
                    $("#applicantRegistrationForm").trigger("reset");
                }
                })
            }
            else if(response == 2){
            Swal.fire(
                'PASSWORD MISMATCH',
                'Please, check your password',
                'error'
            )          
            }
            else if(response == 0){
            Swal.fire(
                'SORRY EMAIL NOT FOUND',
                'Please insert your email that you register to our application',
                'error'
                )
            }
            else if(response == 3){
                Swal.fire(
                'EMAIL ADDRESS NOT AVAILABLE',
                'Sorry, please choose another valid email',
                'error'
                )
                }
            },
            error:function(er){
            console.log(er)
            }
    });
});
