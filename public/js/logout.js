$(document).ready(function(){
    $("#logout").on('click',function(){
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to logout?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                sessionStorage.clear() 
                window.localStorage.clear();
                $.ajax({
                    type: 'GET',
                    url: "/employeesLogoutFunction",
                    success: function(response){
                        if(response == 1){
                            window.location = "/employeesLoginRoutes";
                        }
                        else{
                            Swal.fire({
                            icon: 'error',
                            title: 'Logout Failed',
                        })     
                        }
                    }
                })
            }
        })
    });

    $("#applicantslogout").on('click',function(){
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to logout?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                sessionStorage.clear() 
                window.localStorage.clear();
                $.ajax({
                    type: 'GET',
                    url: "/applicantLogout",
                    success: function(response){
                        if(response == 1){
                            window.location = "/applicantsAuthentication";
                        }
                        else{
                            // LOGOUT FAILED
                            Swal.fire({
                            icon: 'error',
                            title: 'Logout Failed',
                        })     
                        }
                    }
                })
            }
        })
    });
});