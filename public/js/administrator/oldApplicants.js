$(document).ready(function(){
    oldApplicantsTable();
    inactiveOldApplicantsTable();
    blockOldApplicantsTable();
    currentlyUtilizing();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    }); 
});

// FETCH ACTIVE APPLICANTS FOR TABLES
    function oldApplicantsTable(){
    var table = $('#oldApplicants').DataTable({
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
            "url":"/getAdminAllOldApplicantsData",
            "dataSrc": "",
        },
        "columns":[
            {"data":"applicant_id"},
            {"data":"firstname"},
            {"data":"middlename"},
            {"data":"lastname"},
            {"data":"phoneNumber"},
            {"data": "applicant_id",
                mRender: function (data, type, row) {
                return '<button type="button" data-title="View on-call worker?" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Tooltip on top" onclick=viewApplicants('+data+') class="btn rounded-0 btn-outline-success btn-sm py-2 px-3"><i class="bi bi-pencil-square"></i></button> <button type="button" onclick=deactivateApplicants('+data+') class="btn rounded-0 ROUNDED-0 btn-outline-danger btn-sm py-2 px-3" data-title="Deactivate on-call worker?"><i class="bi bi-trash3"></i></button>  <button type="button" data-title="Blocked on-call worker?" onclick=blockedApplicant('+data+') class="btn rounded-0 ROUNDED-0 btn-outline-dark btn-sm py-2 px-3" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Tooltip on top"><i class="bi bi-x-lg"></i></button> <a href="printProjectWorker/'+data+'" class="btn rounded-0 btn-outline-primary btn-sm py-2 px-3" data-title="Print this Worker?"><i class="bi bi-filetype-pdf"></i></a>'
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
// FETCH ACTIVE APPLICANTS FOR TABLES

// INACTIVE APPLICANTS FOR TABLE
    function inactiveOldApplicantsTable(){
        var table = $('#inactiveOldApplicants').DataTable({
            "language": {
                "emptyTable": "No Inactive Applicants Found"
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
                "url":"/getInactiveOldApplicantsData",
                "dataSrc": "",
            },
            "columns":[
                {"data":"applicant_id"},
                {"data":"firstname"},
                {"data":"middlename"},
                {"data":"lastname"},
                {"data":"phoneNumber"},
                {"data": "applicant_id",
                    mRender: function (data, type, row) {
                    return '<button type="button" data-title="View on-call worker?" onclick=viewApplicants('+data+') class="btn rounded-0 rounded-0 btn-outline-secondary btn-sm px-3 py-2"><i class="bi bi-pencil-square"></i></button> <button type="button" onclick=activateApplicants('+data+') class="btn rounded-0 rounded-0 btn-outline-success btn-sm px-3 py-2" data-title="Activate on-call worker?"><i class="bi bi-check-lg"></i></button> <a href="printProjectWorker/'+data+'" class="btn rounded-0 btn-outline-primary btn-sm py-2 px-3" data-title="Print this Worker?"><i class="bi bi-filetype-pdf"></i></a>'
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
// INACTIVE APPLICANTS FOR TABLE

// BLOCK APPLICANTS FOR TABLE
    function blockOldApplicantsTable(){
        var table = $('#blockOldApplicants').DataTable({
            "language": {
                "emptyTable": "No Blocked Applicants Found"
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
                "url":"/getBlockedOldApplicantsData",
                "dataSrc": "",
            },
            "columns":[
                {"data":"applicant_id"},
                { 
                    data: {firstname : "firstname", lastname : "lastname", extention : "extention"},
                    mRender : function(data, type, full) {
                        if(data.extention == null){
                            return data.firstname+' '+data.lastname+' '; 
                        }else{
                            return data.firstname+' '+data.lastname+' '+data.extention; 
                        }
                    } 
                },
                {"data":"phoneNumber"},
                {"data":"reason"},
                {"data": "applicant_id",
                    mRender: function (data, type, row) {
                    return '<button type="button" data-title="View on-call worker?" onclick=viewApplicants('+data+') class="btn rounded-0 btn-outline-secondary btn-sm py-2 px-3"><i class="bi bi-pencil-square"></i></button> <button type="button" onclick=unblockApplicant('+data+') class="btn rounded-0 btn-outline-success btn-sm py-2 px-3" data-title="Unblock?"><i class="bi bi-check-lg"></i></button> <a href="printProjectWorker/'+data+'" class="btn rounded-0 btn-outline-primary btn-sm py-2 px-3" data-title="Print this Worker?"><i class="bi bi-filetype-pdf"></i></a>'
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
// BLOCK APPLICANTS FOR TABLE

// FETCH ACTIVE APPLICANTS FOR TABLES
    function currentlyUtilizing(){
        var table = $('#utilizing').DataTable({
            "language": {
                "emptyTable": "No Currently Active"
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
                "url":"/getCurrentlyUtilizing",
                "dataSrc": "",
            },
            "columns":[
                {"data":"applicant_id"},
                {"data":"firstname"},
                {"data":"middlename"},
                {"data":"lastname"},
                {"data":"phoneNumber"},
                {"data": "applicant_id",
                    mRender: function (data, type, row) {
                    return '<button type="button" data-title="View on-call worker?" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Tooltip on top" onclick=viewApplicants('+data+') class="btn rounded-0 ROUNDED-0 btn-outline-secondary btn-sm py-2 px-3"><i class="bi bi-pencil-square"></i></button> <button type="button" onclick=unUtilizedAccount('+data+') class="btn rounded-0 ROUNDED-0 btn-outline-primary btn-sm py-2 px-3" data-title="Unutilized on-call worker?"><i class="bi bi-person-bounding-box"></i></button>'
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
// FETCH ACTIVE APPLICANTS FOR TABLES

// FETCH DATA FOR UPDATE OPERATION
    function viewApplicants(id){
        $('#viewApplicantsDetails').modal('show')
        $.ajax({
            url: '/getCertainApplicants',
            type: 'GET',
            dataType: 'json',
            data: {applicantId: id},
        })
        .done(function(response) {
            // function applicantExperienceSoya(){
            //     $.ajax({
            //         url: "/applicantExperienceSoya",
            //         method: 'GET',
            //         data: {applicantId:response.applicant_id},
            //         success : function(data) {
            //             if(data != ''){
            //                 $("#soyaExp").html("<span class='text-success'>"+data+" Total</span>");
            //             }else{
            //                 $("#soyaExp").html("<span class='text-danger'>No Experience</span>");
            //             }
            //         }
            //     })
            // }
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
            // applicantExperienceCable();
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
// FETCH DATA FOR UPDATE OPERATION

// DEACTIVATE APPLICANTS ACCOUNT
    function deactivateApplicants(id){
        Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to DEACTIVATE this on-call worker?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, deactivate it'
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
            url: '/deactivateApplicants',
            type: 'GET',
            dataType: 'json',
            data: {applicantId: id},
        });
        Swal.fire({
            title: 'Change Status',
            text: "Project Worker was DEACTIVATE successfully",
            icon: 'success',
            showConfirmButton: false,
            timer: 1500,
        }).then((result) => {
        if (result) {
            $('#oldApplicants').DataTable().ajax.reload();
        }
        });
        }
        });
    } 
// DEACTIVATE APPLICANTS ACCOUNT

// ACTIVATE APPLICANTS ACCOUNT
    function activateApplicants(id){
        Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to activate this on-call worker?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, activate it'
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
            url: '/activateApplicant',
            type: 'GET',
            dataType: 'json',
            data: {applicantId: id},
        });
        Swal.fire({
            title: 'Change Status',
            text: "Project Worker was deactivate successfully",
            icon: 'success',
            showConfirmButton: false,
            timer: 1500,
        }).then((result) => {
        if (result) {
            $('#inactiveOldApplicants').DataTable().ajax.reload();
        }
        });
        }
        });
    } 
// ACTIVATE APPLICANTS ACCOUNT

// BLOCKED APPLICANTS ACCOUNT
    function blockedApplicant(id){
        Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to BLOCK this on-call worker?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, block it'
        }).then((result) => {
        if (result.isConfirmed) {
            (async () => {
                const { value: reason } = await Swal.fire({
                    input: 'textarea',
                    inputLabel: 'WHY HAS THIS APPLICANT BEEN RESTRICTED?',
                    inputPlaceholder: 'Type your reason here...',
                    inputAttributes: {
                    'aria-label': 'Type your message here'
                    },
                    showCancelButton: true
                })
                
                if (reason) {
                    $.ajax({
                        url: '/blockedApplicant',
                        type: 'GET',
                        dataType: 'text',
                        data: {reason: reason, applicantId: id},
                        success: function(response) {
                            if(response == 1){
                                Swal.fire({
                                    title: 'BLOCKED SUCCESSFULLY',
                                    icon: 'success',
                                    showConfirmButton: false,
                                    timer: 1000,
                                }).then((result) => {
                                if (result) {
                                    $('#oldApplicants').DataTable().ajax.reload();
                                    $('#inactiveOldApplicants').DataTable().ajax.reload();
                                }
                                });
                            }else if(response == 0){
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Blocked Failed',
                                    text: 'Something wrong at the backend',
                                })
                            }
                        }
                    });                }
            })()
        }
        });
    } 
// BLOCKED APPLICANTS ACCOUNT

// UNBLOCKED APPLICANTS
    function unblockApplicant(id){
        Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to UNBLOCK this on-call worker?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Unblock it'
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
            url: '/unblockApplicant',
            type: 'GET',
            dataType: 'json',
            data: {applicantId: id},
        });
        Swal.fire({
            title: 'Change Status',
            text: "Project Worker was UNBLOCKED successfully",
            icon: 'success',
            showConfirmButton: false,
            timer: 1500,
        }).then((result) => {
        if (result) {
            $('#blockOldApplicants').DataTable().ajax.reload();
        }
        });
        }
        });
    } 
// UNBLOCKED APPLICANTS

// UNUTILIZED APPLICANTS
    function unUtilizedAccount(id){
        Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to UNUTILIZED this on-call worker?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Continue'
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
            url: '/unutilizedApplicant',
            type: 'GET',
            dataType: 'json',
            data: {applicantId: id},
        });
        Swal.fire({
            title: 'Change Status',
            text: "Project Worker was UNUTILIZED successfully",
            icon: 'success',
            showConfirmButton: false,
            timer: 1500,
        }).then((result) => {
        if (result) {
            $('#utilizing').DataTable().ajax.reload();
        }
        });
        }
        });
    } 
// UNUTILIZED APPLICANTS