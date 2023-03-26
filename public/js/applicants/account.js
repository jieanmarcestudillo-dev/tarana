$(document).ready(function(){
    manageAccount();
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

// MANAGE APPLICANTS
    $('#manageAccountForm').on( 'submit' , function(e){
        e.preventDefault();
        var currentForm = $('#manageAccountForm')[0];
        var data = new FormData(currentForm);
            $.ajax({
                url: "/editApplicantInfo",
                method:"POST",
                dataType: "text",
                data:data,
                cache: false,
                contentType: false,
                processData: false,
                success:function(response){
                    if(response == 1){
                        manageAccount();
                        $("#manageAccountForm").trigger("reset");
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'INFORMATION HAS BEEN UPDATE SUCCESSFULLY',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }else if(response == 2){
                        Swal.fire(
                        'SUBMIT FAILED',
                        'Sorry, The email is already exist',
                        'error'
                        )
                    }else if(response == 3){
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
            }) 
    });
// MANAGE APPLICANTS

// FETCH INFO MANAGE ACCOUNT
    function manageAccount(){
        $.ajax({
            url: "/getApplicantData",
            type: 'GET',
            dataType: 'json',
        })
        .done(function(response) {
            $('#appId').val(response[0].applicant_id)           
            $('#appLastName').val(response[0].lastname)           
            $('#appFirstName').val(response[0].firstname)           
            $('#appMiddleName').val(response[0].middlename)           
            $('#appStatus').val(response[0].status)           
            $('#appPosition').val(response[0].position)           
            $('#appAge').val(response[0].age)           
            $('#appAddress').val(response[0].address)           
            $('#appBirthday').val(response[0].birthday)           
            $('#appPhoneNumber').val(response[0].phoneNumber)           
            $('#appEmail').val(response[0].emailAddress)        
            $('#appGender').val(response[0].Gender)  
            $('#appUsername').val(response[0].username)  
            $('#appNationality').val(response[0].nationality)  
            $('#appReligion').val(response[0].religion)  
            if(response[0].extention != null){
                $('#appExtention').val(response[0].extention)           
            }else{
                $('#appExtention').val = "None";         
            }    
            if(response[0].photos != null){
                $('#appPhotos').attr("src",response[0].photos)

            }else{
                $('#appPhotos').attr("src","/storage/applicants/defaultImage.png")
            }      
            if(response[0].personal_id != null){
                $('#updatePersonalId').attr("src",response[0].personal_id)
            }else{
                $('#updatePersonalId').attr("src","/storage/applicant_Id/noId.jpg")
            }
            if(response[0].personal_id2 != null){
                $('#updatePersonalId2').attr("src",response[0].personal_id2)
            }else{
                $('#updatePersonalId2').attr("src","/storage/applicant_Id/noId.jpg")
            }      
        })
    }
// FETCH INFO MANAGE ACCOUNT

// UPDATE PERSONAL ID
    $('#updatePersonalIdBtn').on( 'click' , function(e){
        e.preventDefault();
        var currentForm = $('#updatePersonalIdForm')[0];
        var data = new FormData(currentForm);
            $.ajax({
                url: "/submitApplicantId",
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
                        $("#updatePersonalIdForm").trigger("reset");
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'ID HAS BEEN SUBMIT SUCCESSFULLY',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }else if(response == 'Sorry, the file is too large.'){
                        Swal.fire(
                        'SUBMIT FAILED',
                        'Sorry, the file is too large.',
                        'error'
                        )
                    }else if(response == 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.'){
                        Swal.fire(
                        'SUBMIT FAILED',
                        'Sorry, only JPG, JPEG, PNG & GIF files are allowed.',
                        'warning'
                        )
                    }else if(response == 'Sorry, your file was not uploaded.'){
                        Swal.fire(
                        'SUBMIT FAILED',
                        'Sorry, your file was not uploaded.',
                        'warning'
                        )
                    }else if(response == 'File is not an image.'){
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
        }) 
    });
// UPDATE PERSONAL ID

// GENERATE AGE 
    function calculateAge() {
        var birthDate = new Date(document.getElementById("appBirthday").value); 
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
        document.getElementById("appAge").value = calculateAge;
    }
// GENERATE AGE 

// MANAGE CREDENTIALS
    $('#manageCredentials').on( 'submit' , function(e){
        e.preventDefault();
        var currentForm = $('#manageCredentials')[0];
        var data = new FormData(currentForm);
            $.ajax({
                url: "/php/applicantsCredentials.php",
                type:"post",
                method:"post",
                dataType: "text",
                data:data,
                cache: false,
                contentType: false,
                processData: false,
                success:function(response){
                    if(response == 1){
                        identity();
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
        var x = document.getElementById("appOldPassword");
        var a = document.getElementById("appNewPassword");
        if (x.type === 'password' && a.type === 'password'){
            x.type ="text";
            a.type ="text";
        }else{
            x.type="password";
            a.type="password";
        }
        
    }
// FUNCTION FOR PASSWORD ENABLE