$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    manageAccount();
});

// MANAGE EMPLOYEES
    $('#updateAdminAccountForm').on( 'submit' , function(e){
        e.preventDefault();
        var currentForm = $('#updateAdminAccountForm')[0];
        var data = new FormData(currentForm);
            $.ajax({
                url: "/updateAdminAccount",
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
                        $("#updateAdminAccountForm").trigger("reset");
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'INFORMATION HAS BEEN UPDATE SUCCESSFULLY',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                },
                error:function(error){
                    console.log(error)
                }
            }) 
    });
// MANAGE EMPLOYEES

// FETCH INFO MANAGE ACCOUNT
    function manageAccount(){
        $.ajax({
            url: "/getPersonalInfo",
            type: 'GET',
            dataType: 'json',
        })
        .done(function(response) {
            $('#uniqueEmployeeId').val(response.employee_id)           
            $('#updateCompanyId').val(response.companyId)           
            $('#updateEmployeeLastname').val(response.lastname)           
            $('#updateEmployeeFirstname').val(response.firstname)           
            $('#updateEmployeeMiddlename').val(response.middlename)           
            $('#employeesStatus').val(response.status)           
            $('#employeesPosition').val(response.position)           
            $('#updateEmployeeAge').val(response.age)           
            $('#updateEmployeeAddress').val(response.address)           
            $('#updateEmployeeStatus').val(response.status)           
            $('#updateEmployeeBirthday').val(response.birthday)           
            $('#updateEmployeeNationality').val(response.nationality)           
            $('#updateEmployeeReligion').val(response.religion)           
            $('#updateEmployeePnumber').val(response.phoneNumber)           
            $('#updateEmployeeEmail').val(response.emailAddress)        
            $('#updateEmployeesSex').val(response.gender)  
            if(response.extention != ''){
                $('#updateEmployeeExt').val(response.extention)           
            }else{
                $('#updateEmployeeExt').val      
            }    
            if(response.photos != ''){
                $('#updateEmployeePhoto').attr("src",response.photos)
            }else{
                $('#updateEmployeePhoto').attr("src","/storage/employees/defaultImage.png")
            }      
        })
    }
// FETCH INFO MANAGE ACCOUNT

// GENERATE AGE 
    function calculateAge() {
        var birthDate = new Date(document.getElementById("updateEmployeeBirthday").value); 
        var birthDateDay = birthDate.getDate();
        var birthDateMonth = birthDate.getMonth();
        var birthDateYear = birthDate.getFullYear();

        var todayDate = new Date();
        var todayDay = todayDate.getDate();
        var todayMonth = todayDate.getMonth();
        var todayYear = todayDate.getFullYear();

        var calculateAge = 0;

        if(todayMonth > birthDateMonth) calculateAge  = todayYear - birthDateYear;
        else calculateAge = todayYear - birthDateYear - 1; 

        var outputValue = calculateAge;
        document.getElementById("updateEmployeeAge").value = calculateAge;
    }
// GENERATE AGE 

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