$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});
// LOGIN
    $('#employeesLoginForm').on( 'submit' , function(e){
    e.preventDefault();
    var data = $('#employeesLoginForm').serialize();
    $.ajax({
    url:"/employeesLoginFunction",
    method:"POST",
    dataType:"text",
    data:data,
    success: function(response) {
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
                    window.location = "/adminDashboardRoutes";
                  }
                })
                Toast.fire({
                  icon: 'success',
                  title: 'Signed in successfully',
                  text: 'Welcome Admin',
                })
            }
            else if(response == 3){
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
                      window.location = "/recruiterDashboardRoutes";
                  }
                })
                Toast.fire({
                  icon: 'success',
                  title: 'Signed in successfully',
                  text: 'Welcome Recruiter',
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
            'Your account is disable to access the TARA NA Application',
            'error'
            )
            }else if(response == 4){
              Swal.fire(
              "Already Login",
              "You've already logged into your account on another device",
              'error'
              )
              }
            },
            error:function(er){
            console.log(er)
            }
            });
    });
// LOGIN

// FUNCTION FOR PASSWORD ENABLE
    function seePassword() {
      var x = document.getElementById("employeesPassword");
      if (x.type==='password'){
        x.type ="text";
        y.style.display="block";
        z.style.display="none";
      }else{
        x.type="password";
        y.style.display="none"
        z.style.display="block";
      }
    }
// FUNCTION FOR PASSWORD ENABLE


// FORGOT PASSWORD
