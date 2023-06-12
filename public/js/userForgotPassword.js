$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    userEmail();
});
$(document).ready(function () {
    $('#userForgotPassword').on( 'submit' , function(e){
        e.preventDefault();
        var email = $('#userEmailForgotPass').val();
        $.ajax({
        url:"/resetPasswordFunction",
        method:"POST",
        dataType:"text",
        data:{email:email},
        success: function(response) {
            if(response == 1){
                localStorage.setItem("userEmail", email);
                $('#loginForm').trigger("reset");
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top',
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                      toast.addEventListener('mouseenter', Swal.stopTimer)
                      toast.addEventListener('mouseleave', Swal.resumeTimer)
                    },
                    didClose: () =>{
                        window.location = "/";
                    }
                  })
                  Toast.fire({
                    icon: 'success',
                    title: 'PLEASE, CHECK YOUR EMAIL',
                    text: 'The reset password link has sent to your email',
                  })
            }
            else if(response == 0){
                Swal.fire(
                    'NO EMAIL FOUND',
                    'Please, insert your valid email',
                    'error'
                )
            }
        },
        });
    });

    $('#resetPasswordForm').on( 'submit' , function(e){
        e.preventDefault();
        var email = $('#userEmail').val();
        var password = $('#newPassword').val();
        var confirmPassword = $('#confirmPassword').val();

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
            $.ajax({
            url:"/newPasswordFunction",
            method:"POST",
            dataType:"text",
            data:{email:email,password:password},
            success: function(response) {
                if(response == 1){
                    localStorage.clear();
                    $('#resetPasswordForm').trigger("reset");
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                          toast.addEventListener('mouseenter', Swal.stopTimer)
                          toast.addEventListener('mouseleave', Swal.resumeTimer)
                        },
                        didClose: () =>{
                            window.location = "/applicantsAuthentication";
                        }
                      })
                      Toast.fire({
                        icon: 'success',
                        title: 'RESET SUCCESSFULLY',
                        text: 'Your password has been changed',
                      })
                }
                else if(response == 0){
                    Swal.fire(
                        'RESET FAILED',
                        'Your password not changed',
                        'error'
                    )
                }
            },
            });
        }

    });
});

function userEmail(){
    $("#userEmail").val(localStorage.getItem("userEmail"));
}

// FUNCTION FOR PASSWORD ENABLE
    function seePassword() {
        var x = document.getElementById("newPassword");
        var a = document.getElementById("confirmPassword");
        if (x.type === 'password' && a.type === 'password'){
            x.type ="text";
            a.type ="text";
        }else{
            x.type="password";
            a.type="password";
        }

    }
// FUNCTION FOR PASSWORD ENABLE
