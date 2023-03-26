$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    recruiterCompletedOperation();
});


// SHOW TOTAL OPERATIONS
    function recruiterCompletedOperation(){
        $.ajax({
            url: "/recruiterCompleted",
            method: 'GET',
            success : function(data) {
                $("#showCompletedDetails").html(data);
            }
        })
    }
// SHOW TOTAL OPERATIONS


// SHOW CERTAIN APPLICANTS DETAILS
    function viewApplicants(id){
        $('#viewApplicantsDetails').modal('show')
        $.ajax({
            url: '/getCertainApplicants',
            type: 'GET',
            dataType: 'json',
            data: {applicantId: id},
        })
        .done(function(response) {
            function applicantExperienceSoya(){
                $.ajax({
                    url: "/applicantExperienceSoya",
                    method: 'GET',
                    data: {applicantId:response.applicant_id},
                    success : function(data) {
                        if(data != ''){
                            $("#soyaExp").html("<span class='text-success'>"+data+" Total</span>");
                        }else{
                            $("#soyaExp").html("<span class='text-danger'>No Experience</span>");
                        }
                    }
                })
            }
            function applicantExperienceCable(){
                $.ajax({
                    url: "/applicantExperienceCable",
                    method: 'GET',
                    data: {applicantId:response.applicant_id},
                    success : function(data) {
                        if(data != ''){
                            $("#cableExp").html("<span class='text-success'>"+data+" Total</span>");
                        }else{
                            $("#cableExp").html("<span class='text-danger'>No Experience</span>");
                        }
                    }
                })
            }
            function applicantExperienceRice(){
                $.ajax({
                    url: "/applicantExperienceRice",
                    method: 'GET',
                    data: {applicantId:response.applicant_id},
                    success : function(data) {
                        if(data != ''){
                            $("#riceExp").html("<span class='text-success'>"+data+" Total</span>");
                        }else{
                            $("#riceExp").html("<span class='text-danger'>No Experience</span>");
                        }
                    }
                })
            }
            function applicantExperienceWood(){
                $.ajax({
                    url: "/applicantExperienceWood",
                    method: 'GET',
                    data: {applicantId:response.applicant_id},
                    success : function(data) {
                        if(data != ''){
                            $("#woodExp").html("<span class='text-success'>"+data+" Total</span>");
                        }else{
                            $("#woodExp").html("<span class='text-danger'>No Experience</span>");
                        }
                    }
                })
            }
            function applicantExperiencePlyWood(){
                $.ajax({
                    url: "/applicantExperiencePlyWood",
                    method: 'GET',
                    data: {applicantId:response.applicant_id},
                    success : function(data) {
                        if(data != ''){
                            $("#plyWoodExp").html("<span class='text-success'>"+data+" Total</span>");
                        }else{
                            $("#plyWoodExp").html("<span class='text-danger'>No Experience</span>");
                        }
                    }
                })
            }
            applicantExperiencePlyWood();
            applicantExperienceWood();
            applicantExperienceRice();
            applicantExperienceSoya();
            applicantExperienceCable();
            $('#applicantsPhoto').attr("src", response.photos)
            $('#applicantsLastname').html(response.lastname)           
            $('#applicantsFirstname').html(response.firstname)           
            $('#applicantsMiddlename').html(response.middlename)           
            $('#applicantsExt').html(response.extention)           
            $('#applicantsStatus').html(response.status)           
            $('#applicantsPosition').html(response.position)
            $('#applicantsGender').html(response.Gender)
            $('#applicantsAge').html(response.age)           
            $('#applicantsAddress').html(response.address)           
            $('#applicantsPnumber').html(response.phoneNumber)           
            $('#applicantsEmail').html(response.emailAddress)   
            if(response.personal_id != '' && response.personal_id2 != ''){
                $('#personalId').attr("src", response.personal_id)
                $('#personalId2').attr("src", response.personal_id2)
            }else{
                $('#personalId').attr("src","/storage/applicant_id/noId.jpg")
                $('#personalId2').attr("src","/storage/applicant_id/noId.jpg")
            }        
            let dtFormat = new Intl.DateTimeFormat('en-Us',{
                day: '2-digit',
                month: 'long',
                year: 'numeric'
            });
            var newDate = new Date(response[0].birthday);
            $('#applicantsBirthday').html(dtFormat.format(newDate));    
        })    
    }
// SHOW CERTAIN APPLICANTS DETAILS


$(document).ready(function(){
    $('#searchRecruiterCompleted').bind('keyup', function() {
        var shipsName = $(this).val();
        if(shipsName != ''){
            $.ajax({
                url: '/searchCompleted',
                method: 'GET',
                data: {searchShips: shipsName},
                dataType: 'text',
                success:function(data){
                    $('#showCompletedDetails').html(data);
                }
            })
        }else{
            recruiterCompletedOperation();
        }
    });
});