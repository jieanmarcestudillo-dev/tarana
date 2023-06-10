$(document).ready(function(){
    manageAccount();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

// MANAGE EMPLOYEES
    $('#recruitInformationForm').on( 'submit' , function(e){
        e.preventDefault();
        var extension = /(\.jpg|\.jpeg|\.png)$/i;
        if (!extension.exec($('#addOperationPhoto').val())) {
            Swal.fire(
            'Add Failed',
            'Sorry the file not supported',
            'error'
            )
        }else{
        var currentForm = $('#recruitInformationForm')[0];
        var data = new FormData(currentForm);
            $.ajax({
                url: "/editRecruiterInfo",
                type:"POST",
                method:"POST",
                dataType: "text",
                data:data,
                cache: false,
                contentType: false,
                processData: false,
                success:function(response){
                    if(response == 1){
                        manageAccount();
                        $("#recruitInformationForm").trigger("reset");
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'INFORMATION HAS BEEN UPDATE SUCCESSFULLY',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }else if(response == 3){
                        Swal.fire(
                        'SUBMIT FAILED',
                        'Sorry, The email is already exist',
                        'error'
                        )
                    }else if(response == 2){
                        Swal.fire(
                        'SUBMIT FAILED',
                        'File is not an image.',
                        'warning'
                        )
                    }
                },
                error:function(error){
                    console.log(error)
                }
            });
        }
    });
// MANAGE EMPLOYEES

// FETCH INFO MANAGE ACCOUNT
    function manageAccount(){
        $.ajax({
            url: "/getEmployeesData",
            type: 'GET',
            dataType: 'json',
        })
        .done(function(response) {
            $('#uniqueEmployeeId').val(response[0].employee_id)
            $('#updateCompanyId').val(response[0].companyId)
            $('#updateEmployeeLastname').val(response[0].lastname)
            $('#updateEmployeeFirstname').val(response[0].firstname)
            $('#updateEmployeeMiddlename').val(response[0].middlename)
            $('#employeesStatus').val(response[0].status)
            $('#employeesPosition').val(response[0].position)
            $('#updateEmployeeAge').val(response[0].age)
            $('#updateEmployeeAddress').val(response[0].address)
            $('#updateEmployeeStatus').val(response[0].status)
            $('#updateEmployeeBirthday').val(response[0].birthday)
            $('#updateEmployeePnumber').val(response[0].phoneNumber)
            $('#updateEmployeeEmail').val(response[0].emailAddress)
            $('#updateEmployeesSex').val(response[0].gender)
            $('#empUsername').val(response[0].username)
            if(response[0].extention != ''){
                $('#updateEmployeeExt').val(response[0].extention)
            }else{
                $('#updateEmployeeExt').val
            }
            if(response[0].photos != ''){
                $('#updateEmployeePhoto').attr("src",response[0].photos)
            }else{
                $('#updateEmployeePhoto').attr("src","/storage/employees/defaultImage.png")
            }
        })
    }
// FETCH INFO MANAGE ACCOUNT

// MANAGE CREDENTIALS
    $('#manageCredentials').on( 'submit' , function(e){
        e.preventDefault();
        var currentForm = $('#manageCredentials')[0];
        var data = new FormData(currentForm);
            $.ajax({
                url: "/php/employeeCredentials.php",
                type:"post",
                method:"post",
                dataType: "text",
                data:data,
                cache: false,
                contentType: false,
                processData: false,
                success:function(response){
                    if(response == 1){
                        manageAccount();
                        $("#manageCredentials").trigger("reset");
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'INFORMATION HAS BEEN SUBMIT SUCCESSFULLY',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }else if(response == 'wrong password'){
                        Swal.fire(
                        'SUBMIT FAILED',
                        'Sorry, your old password is incorrect',
                        'error'
                        )
                    }else if(response == 0){
                        Swal.fire(
                        'SUBMIT FAILED',
                        'Sorry, Error',
                        'error'
                        )
                    }
                },
                error:function(error){
                    console.log(error)
                }
            })
    });
// MANAGE CREDENTIALS

// FUNCTION FOR PASSWORD ENABLE
    function seePassword() {
        var x = document.getElementById("empOldPassword");
        var a = document.getElementById("empNewPassword");
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
    function seePassword() {
        var x = document.getElementById("currentPassword");
        var a = document.getElementById("newPassword");
        var b = document.getElementById("confirmPassword");
        if (x.type === 'password' && a.type === 'password' && b.type === 'password'){
            x.type ="text";
            a.type ="text";
            b.type ="text";
        }else{
            x.type="password";
            a.type="password";
            b.type="password";
        }

    }
// FUNCTION FOR PASSWORD ENABLE

    $('#usersPasswordForm').on( 'submit' , function(e){
    e.preventDefault();
    var currentForm = $('#usersPasswordForm')[0];
    var data = new FormData(currentForm);
    if( $("#newPassword").val() !=  $("#confirmPassword").val()){
        Swal.fire(
            'UPDATE FAILED',
            'Sorry new password and confirm password not matched',
            'error'
        )
    }else{
        $.ajax({
            url: "/updateUsersPassword",
            type:"post",
            method:"post",
            dataType: "text",
            data:data,
            cache: false,
            contentType: false,
            processData: false,
            success:function(response){
                if(response == 1){
                    $("#usersPasswordForm").trigger("reset");
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'PASSWORD HAS BEEN UPDATE SUCCESSFULLY',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }else if(response == 0){
                    Swal.fire(
                        'UPDATE FAILED',
                        'Sorry current password was not correct',
                        'error'
                    )
                }
            },
            error:function(error){
                console.log(error)
            }
        })
    }

    });
