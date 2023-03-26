$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    showOperationDetails();
    totalRecruitedApplicantTable();
    badgeAcceptInvitation();
    badgeApplicantTotal();
    badgeRecommendApplicant();
    badgeForRecruitedApplicants();
    // badgeForAll();
});

// FETCH CERTAIN OPERATION
    function showOperationDetails(){
        operationId = localStorage.getItem('operationId'); 
        $.ajax({
            url: "/showOperationDetails",
            method: 'GET',
            data: {operationId : operationId},
            success : function(data) {
                $("#showOperationDetails").html(data);
            }
        })
    }
// FETCH CERTAIN OPERATION

// FETCH APPLICANT FOR CERTAIN OPERATION IN TABLES
    function totalRecruitedApplicantTable(){
        operationId = localStorage.getItem('operationId'); 
        var table = $('#viewRecruitedApplicantTable').DataTable({
            "language": {
                "emptyTable": "No Applicants Found"
            },
            "lengthChange": true,
            "scrollCollapse": true,
            "paging": true,
            "info": true,
            "responsive": true,
            "ordering": false,
            "aLengthMenu": [[25, 50, 75, -1], [25, 50, 75, "All"]],
            "iDisplayLength": 25,
            "ajax":{
                "url":"/totalRecruitedApplicants",
                "dataSrc": "",
                "data": {
                    "operationId": operationId
                }
            },
            "columns":[
                {"data":"applicant_id"},
                { "mData": function (data, type, row) {
                    if(data.extention != null){
                        return data.firstname+ " " +data.lastname+ " " +data.extention;
                    }else{
                        return data.firstname+ " " +data.lastname;
                    }
                }},
                {"data":"position"},
                {"data":"phoneNumber"},
                { "mData": function (data, type, row) {
                    return "<button data-title='Applicant Information' type='button' onclick=viewApplicants("+data.applicant_id+") class='btn btn-outline-secondary btn-sm py-2 px-3 rounded-0'><i class='bi bi-info-lg'></i></button> <button data-title='Cancel Recruitment?' type='button' onclick=cancelRecruitApplicants("+data.applicant_id+") class='btn btn-outline-danger btn-sm rounded-0 py-2 px-3'><i class='bi bi-x-lg'></i></button>";
                }},
            ],
            order: [[1, 'asc']],
        });
        table.on('order.dt search.dt', function () {
            let i = 1;
            table.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
                this.data(i++);
            });
        }).draw();
    }
// FETCH APPLICANT FOR CERTAIN OPERATION IN TABLES

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

// CAMCEL RECRUIT APPLICANTS
    function cancelRecruitApplicants(id){
        applicantId = id;
        operationId = localStorage.getItem('operationId'); 
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to CANCEL this applicant's RECRUITMENT?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d72323',
            confirmButtonText: 'Yes, Cancel it!'
            }).then((result) => {
            if (result.isConfirmed) {
                    $.ajax({
                    url: "/cancelRecruitment",
                    type: 'GET',
                    dataType: 'json',
                    data: {applicantId: applicantId, operationId: operationId},
                });
                Swal.fire({
                    title: 'CANCEL SUCCESSFULY',
                    icon: 'info',
                    showConfirmButton: false,
                    timer: 1000,
                }).then((result) => {
                if (result) {
                    badgeApplicantTotal();
                    badgeForRecruitedApplicants();
                    showOperationDetails();
                    $('#viewRecruitedApplicantTable').DataTable().ajax.reload();
                }
                });
            }
        })
    }
// CAMCEL RECRUIT APPLICANTS

// BADGE FOR APPLICANT TOTAL
    function badgeApplicantTotal(){
        operationId = localStorage.getItem('operationId'); 
        $.ajax({
            url: "/badgeForTotalApplicants",
            method: 'GET',
            data: {operationId : operationId},
            success : function(data) {
                $("#badgeForTotalApplicants").html(data);
            }
        })
    }
// BADGE FOR APPLICANT TOTAL

// BADGE FOR APPLICANT TOTAL
    function badgeRecommendApplicant(){
        operationId = localStorage.getItem('operationId'); 
        $.ajax({
            url: "/badgeForRecommendApplicants",
            method: 'GET',
            data: {operationId : operationId},
            success : function(data) {
                $("#badgeForRecommendApplicants").html(data);
            }
        })
    }
// BADGE FOR APPLICANT TOTAL

// BADGE FOR APPLICANT TOTAL
    function badgeAcceptInvitation(){
        operationId = localStorage.getItem('operationId'); 
        $.ajax({
            url: "/badgeAcceptInvitation",
            method: 'GET',
            data: {operationId : operationId},
            success : function(data) {
            $("#badgeAcceptInvitation").html(data);
            }
        })
    }
// BADGE FOR APPLICANT TOTAL

// BADGE FOR APPLICANT TOTAL
    function badgeForAll(){
        operationId = localStorage.getItem('operationId'); 
        $.ajax({
            url: "/badgeForAll",
            method: 'GET',
            data: {operationId : operationId},
            success : function(data) {
                $("#badgeForAll").html(data);
            }
        })
    }
// BADGE FOR APPLICANT TOTAL

// BADGE FOR RECRUITED APPLICANT
    function badgeForRecruitedApplicants(){
        operationId = localStorage.getItem('operationId'); 
        $.ajax({
            url: "/badgeForRecruitedApplicants",
            method: 'GET',
            data: {operationId : operationId},
            success : function(data) {
                $("#badgeForRecruitedApplicant").html(data);
            }
        })
    }
// BADGE FOR RECRUITED APPLICANT