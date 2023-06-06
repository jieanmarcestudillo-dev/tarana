$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    showOperationDetails();
    totalApplicantsWhoRecruited();
    badgeApplicantTotal();
    badgeRecommendApplicant();
    badgeForRecruitedApplicants();
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

// FETCH APPLICANTS WHO ACCEPT INVITATION
    function totalApplicantsWhoRecruited(){
        operationId = localStorage.getItem('operationId'); 
        var table = $('#tableRecruitedWorkers').DataTable({
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
                "url":"/totalApplicantsWhoAcceptInvitation",
                "dataSrc": "",
                "data": {
                    "operationId": operationId
                }
            },
            "columns":[
                {"data":"applicant_id"},
                { "mData": function (data, type, row) {
                    if(data.extention != null){
                        return data.applicantFirstname+ " " +data.applicantLastName+ " " +data.applicantExtention;
                    }else{
                        return data.applicantFirstname+ " " +data.applicantLastName;
                    }
                }},
                { "mData": function (data, type, row) {
                    return data.age+ " years old";
                }},  
                { "mData": function (data, type, row) {
                    if(data.extention != null){
                        return data.employeeFirstName+ " " +data.employeeLastName+ " " +data.employeeExtension;
                    }else{
                        return data.employeeFirstName+ " " +data.employeeLastName;
                    }
                }},
                { "mData": function (data, type, row) {
                    return "<button data-title='Project Workers Information' type='button' onclick=viewOnCallWorkers("+data.applicant_id+") class='btn btn-outline-secondary btn-sm py-2 px-3 rounded-0'><i class='bi bi-info-lg'></i></button>";
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
// FETCH APPLICANTS WHO ACCEPT INVITATION

// CAMCEL RECRUIT APPLICANTS
    function cancelRecruitRecommendedApplicants(id){
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
                    url: "/cancelRecruitmentAndRecommendation",
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
                    $('#tableRecruitedWorkers').DataTable().ajax.reload();
                    showOperationDetails();
                    badgeRecommendApplicant();
                    badgeApplicantTotal();
                    badgeForRecruitedApplicants();
                }
                });
            }
        })
    }
// CAMCEL RECRUIT APPLICANTS

// SHOW CERTAIN APPLICANTS DETAILS
    function viewOnCallWorkers(id){
    $('#viewWorkerDetails').modal('show')
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
        applicantExperience();
        overallRatingPerWorker();
        totalBackOutPerWorker();
        totalDeclinedPerWorker();
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
        }else{
            $('#personalId').attr("src","/storage/applicant_Id/noId.jpg")
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
    function badgeForRecruitedApplicants(){
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