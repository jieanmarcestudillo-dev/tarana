$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    schedule();
    $('#applicantsAttendance').DataTable();
});

// SHOW TOTAL OPERATIONS
    function schedule(){
        $.ajax({
            url: "/adminFormedGroup",
            method: 'GET',
            success : function(data) {
                $("#showFormedGroup").html(data);
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
        function applicantExperience(){
            $.ajax({
                url: "/applicantExperience",
                method: 'GET',
                data: {applicantId:response.applicant_id},
                success : function(data) {
                    $("#showExperience").html(data);
                }
            })
        }
        function overallRatingPerWorker(){
            $.ajax({
                url: "/overallRatingPerWorker",
                method: 'GET',
                data: {applicantId:response.applicant_id},
                success : function(data) {
                    $("#overallRatingPerWorker").html(data);
                }
            })
        }
        function totalBackOutPerWorker(){
            $.ajax({
                url: "/totalBackOutPerWorker",
                method: 'GET',
                data: {applicantId:response.applicant_id},
                success : function(data) {
                    $("#totalBackOutPerWorker").html(data);
                }
            })
        }
        function totalDeclinedPerWorker(){
            $.ajax({
                url: "/totalDeclinedPerWorker",
                method: 'GET',
                data: {applicantId:response.applicant_id},
                success : function(data) {
                    $("#totalDeclinedPerWorker").html(data);
                }
            })
        }
        overallRatingPerWorker();
        totalBackOutPerWorker();
        totalDeclinedPerWorker();
        applicantExperience();
        // function applicantExperienceCable(){
        //     $.ajax({
        //         url: "/applicantExperienceCable",
        //         method: 'GET',
        //         data: {applicantId:response.applicant_id},
        //         success : function(data) {
        //             if(data != ''){
        //                 $("#cableExp").html("<span class='text-success'>"+data+" Total</span>");
        //             }else{
        //                 $("#cableExp").html("<span class='text-danger'>No Experience</span>");
        //             }
        //         }
        //     })
        // }
        // function applicantExperienceRice(){
        //     $.ajax({
        //         url: "/applicantExperienceRice",
        //         method: 'GET',
        //         data: {applicantId:response.applicant_id},
        //         success : function(data) {
        //             if(data != ''){
        //                 $("#riceExp").html("<span class='text-success'>"+data+" Total</span>");
        //             }else{
        //                 $("#riceExp").html("<span class='text-danger'>No Experience</span>");
        //             }
        //         }
        //     })
        // }
        // function applicantExperienceWood(){
        //     $.ajax({
        //         url: "/applicantExperienceWood",
        //         method: 'GET',
        //         data: {applicantId:response.applicant_id},
        //         success : function(data) {
        //             if(data != ''){
        //                 $("#woodExp").html("<span class='text-success'>"+data+" Total</span>");
        //             }else{
        //                 $("#woodExp").html("<span class='text-danger'>No Experience</span>");
        //             }
        //         }
        //     })
        // }
        // function applicantExperiencePlyWood(){
        //     $.ajax({
        //         url: "/applicantExperiencePlyWood",
        //         method: 'GET',
        //         data: {applicantId:response.applicant_id},
        //         success : function(data) {
        //             if(data != ''){
        //                 $("#plyWoodExp").html("<span class='text-success'>"+data+" Total</span>");
        //             }else{
        //                 $("#plyWoodExp").html("<span class='text-danger'>No Experience</span>");
        //             }
        //         }
        //     })
        // }
        // applicantExperiencePlyWood();
        // applicantExperienceWood();
        // applicantExperienceRice();
        // applicantExperienceSoya();
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
        var newDate = new Date(response.birthday);
        $('#applicantsBirthday').html(dtFormat.format(newDate));
    })
    }
// SHOW CERTAIN APPLICANTS DETAILS

// FUNCTION
    // ENABLE BUTTON
        $(function() {
            const isAttendCheckBox = document.getElementsByClassName('isAttend');
            const ratePerformanceRange = document.getElementsByClassName('ratePerformance');
            const rateValueDisplay = document.getElementsByClassName("rateValueDisplay")
            const rateValueSubmit = document.getElementsByClassName("rateValueSubmit")
            for (let i = 0; i < isAttendCheckBox.length; i++) {
                isAttendCheckBox[i].addEventListener('change', function() {
                    ratePerformanceRange[i].disabled = !isAttendCheckBox[i].checked;
                    rateValueDisplay[i].textContent = ''
                    rateValueSubmit[i].value = ''
                    ratePerformanceRange[i].value = 0;
                });
                ratePerformanceRange[i].addEventListener('input', function() {
                  rateValueDisplay[i].textContent = 'Rating: ' + ratePerformanceRange[i].value + '%' ;
                  rateValueSubmit[i].value = ratePerformanceRange[i].value;
                });
            }
        });
    // ENABLE BUTTON
// FUNCTION
