$(document).ready(function(){
    onCallWorkersTable();
    applicantsTable();
    user();
});

// FETCH ACTIVE EMPLOYEES FOR TABLES
    function onCallWorkersTable(){
    var table = $('#onCallWorkers').DataTable({
        "language": {
            "emptyTable": "No Workers Found"
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
            "url":"/getAllOnCallWorkers",
            "dataSrc": "",
        },
        "columns":[
            {"data":"applicant_id"},
            {"data":"firstname"},
            {"data":"middlename"},
            {"data":"lastname"},
            { "mData": function (data, type, row) {
                return data.age+ " years old";
            }},
            { "mData": function (data, type, row) {
                if(data.status == 'Scheduled'){
                    return '<span class="text-danger">Scheduled</span>';
                }else{
                    return '<span class="text-success">Available</span>';
                }
            }},
            {
                "mData": function (data, type, row) {
                  return '<button type="button" data-title="View Their Details?" onclick="viewOnCallWorkers(' + data.applicant_id + ')" class="btn rounded-0 btn-outline-secondary btn-sm py-2 px-3"><i class="bi bi-eye"></i></button> <button type="button" data-title="View Their Schedule?" onclick="viewSchedule(' + data.applicant_id + ')" class="btn rounded-0 btn-outline-primary btn-sm py-2 px-3"><i class="bi bi-calendar-check"></i></button>  <button type="button" data-title="Invite Them?" onclick="setSchedule(' + data.applicant_id + ', \'' + data.firstname + '\', \'' + data.lastname + '\')" class="btn rounded-0 btn-outline-success btn-sm py-2 px-3"><i class="bi bi-envelope-check"></i></button>';
                }
              }

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
// FETCH ACTIVE EMPLOYEES FOR TABLES

// FETCH ACTIVE EMPLOYEES FOR TABLES
    function applicantsTable(){
    var table = $('#applicants').DataTable({
        "language": {
            "emptyTable": "No Workers Found"
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
            "url":"/getAllApplicantsData",
            "dataSrc": "",
        },
        "columns":[
            {"data":"applicant_id"},
            {"data":"firstname"},
            {"data":"middlename"},
            {"data":"lastname"},
            { "mData": function (data, type, row) {
                return data.age+ " years old";
            }},
            { "mData": function (data, type, row) {
                if(data.status == 'Scheduled'){
                    return '<span class="text-danger">Scheduled</span>';
                }else{
                    return '<span class="text-success">Available</span>';
                }
            }},
            {"data": "applicant_id",
                mRender: function (data, type, row) {
                return '<button type="button" data-title="View Details?" onclick=viewApplicants('+data+') class="btn rounded-0 btn-outline-secondary btn-sm py-2 px-3"><i class="bi bi-eye"></i></button> <button type="button" data-title="View Their Schedule?" onclick=viewSchedule('+data+') class="btn rounded-0 btn-outline-primary btn-sm py-2 px-3"><i class="bi bi-calendar-check"></i></button>'
            }
            }
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
// FETCH ACTIVE EMPLOYEES FOR TABLES

// SHOW CERTAIN APPLICANTS DETAILS
    function viewApplicants(id){
        $('#viewApplicantsDetails').modal('show')
        $.ajax({
            url: '/viewApplicants',
            type: 'GET',
            dataType: 'json',
            data: {applicantId: id},
        })
        .done(function(response) {
            if(response.photos != ''){
                $('#applicantsPhoto').attr("src",response.photos)
            }else{
                $('#applicantsPhoto').attr("src","/assets/applicants/defaultImage.png")
            }
            $('#applicantsLastname').val(response.lastname)
            $('#applicantsFirstname').val(response.firstname)
            $('#applicantsMiddlename').val(response.middlename)
            $('#applicantsExt').val(response.extention)
            $('#applicantsPosition').val(response.position)
            $('#applicantsStatus').val(response.status)
            $('#applicantsSex').val(response.Gender)
            $('#applicantsAge').val(response.age)
            $('#applicantsBirthday').val(response.birthday)
            $('#applicantsAddress').val(response.address)
            $('#applicantsPnumber').val(response.phoneNumber)
            $('#applicantsEmail').val(response.emailAddress)
        })
    }
// SHOW CERTAIN APPLICANTS DETAILS

// SHOW CERTAIN APPLICANTS DETAILS
    function viewOnCallWorkers(id){
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
        function totalNotAttend(){
            $.ajax({
                url: "/totalNotAttend",
                method: 'GET',
                data: {applicantId:response.applicant_id},
                success : function(data) {
                    $("#totalNotAttend").html(data);
                }
            })
        }
        totalNotAttend();
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
            $('#personalId2').attr("src", response.personal_id2)
        }else{
            $('#personalId').attr("src","/storage/applicant_Id/noId.jpg")
            $('#personalId2').attr("src","/storage/applicant_Id/noId.jpg")
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

// VIEW SCHEDULE
    function viewSchedule(id){
        $('#viewScheduleDetails').modal('show')
        $.ajax({
            url: '/getSchedPerApplicant',
            method: 'GET',
            data: {applicantId: id},
            success : function(data) {
                $("#workersSched").html(data);
            }
        })
    }
// VIEW SCHEDULE

// SET SCHEDULE
    function setSchedule(applicantId, firstname , lastname){
        localStorage.setItem('applicantId', applicantId);
        localStorage.setItem('firstname', firstname);
        localStorage.setItem('lastname', lastname);
        $('#inviteWorkerModal').modal('show')
        $.ajax({
            url: '/inviteProjectWorker',
            method: 'GET',
            data: {applicantId: applicantId},
            success:function(response){
                var data = "";
                for(i=0;i<response.length;i++){
                    data+="<option value='"+response[i].certainOperation_id+"'>"+response[i].operationId+"</option>"
                }
                $('#operationId').html(data)
                user();
            },
            error:function(error){
                console.log(error)
            }
        })
    }

    function fetchOperation() {
        var operationId = $('#operationId').val();
        $.ajax({
            url: '/fetchOperation',
            method: 'GET',
            data: {operationId: operationId},
            success : function(data) {
                $("#fetchOperationData").html(data);
            }
        })
    }

    function user(){
        $("#workersInvitation").val(localStorage.getItem("firstname") + " " + localStorage.getItem("lastname"));
        $("#workersUniqueId").val(localStorage.getItem("applicantId"));
    }

    function recommendApplicantRecruit(id){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var applicantId = localStorage.getItem('applicantId');
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to INVITE this applicant?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d72323',
            confirmButtonText: 'Yes, Recruit it!'
            }).then((result) => {
            if (result.isConfirmed) {
                    $.ajax({
                    url: "/recruitRecommendedApplicant",
                    type: 'GET',
                    dataType: 'json',
                    data: {applicantId: applicantId, operationId: id},
                    success: function(response) {
                        localStorage.clear();
                        if(response == 2){
                            Swal.fire({
                                icon: 'warning',
                                title: 'RECRUIT FAILED',
                                text: 'The project worker are already apply / invite',
                            })
                        }else if(response == 1){
                            localStorage.clear();
                            Swal.fire({
                                title: 'RECRUIT SUCCESSFULY',
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 1000,
                            }).then((result) => {
                            if (result) {
                                $("#fetchOperationData").html('');
                                $('#inviteWorkerModal').modal('hide');
                            }
                            });
                        }else if(response == 0){
                            Swal.fire({
                                icon: 'error',
                                title: 'RECRUIT FAILED',
                                text: 'Something wrong at the backend',
                            })
                        }else if(response == 4){
                            Swal.fire({
                                icon: 'error',
                                title: 'RECRUIT FAILED',
                                text: 'No available slot on this operation'
                            })
                        }else if(response == 3){
                            Swal.fire({
                                icon: 'error',
                                title: 'RECRUIT FAILED',
                                text: 'The Operation Was Already Done'
                            })
                        }else if(response){
                            Swal.fire({
                                icon: 'error',
                                title: 'RECRUIT FAILED',
                                text: response,
                            })
                        }
                    }
                });
            }
        })
    }
// SET SCHEDULE

