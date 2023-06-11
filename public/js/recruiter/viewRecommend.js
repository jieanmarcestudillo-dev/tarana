$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    showOperationDetails();
    totalRecommendedApplicantsTable();
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

// SEARCH LAST NAME
    $(document).ready(function(){
        $('#searchLastname').keyup(function(){
            var lastname = $(this).val();
            if(lastname != ''){
                $.ajax({
                    url: '/fetchApplicantLastname',
                    method: 'GET',
                    data: {searchApplicant: lastname},
                    dataType: 'text',
                    success:function(data){
                        $('#resultsOfApplicants').html(data);
                    }
                })
            }else{
                $('#resultsOfApplicants').html('');
            }
        });
    });
// SEARCH LAST NAME

// FETCH RECOMMENDED APPLICANTS ON CERTAIN OPERATION
    function totalRecommendedApplicantsTable(){
        operationId = localStorage.getItem('operationId');
        var table = $('#viewRecommendedTable').DataTable({
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
                "url":"/totalRecommendedApplicantsOfCertainOperation",
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
                    return "<button data-title='Project Workers Information' type='button' onclick=viewOnCallWorkers("+data.applicant_id+") class='btn btn-outline-secondary btn-sm py-2 px-3 rounded-0'><i class='bi bi-info-lg'></i></button> <button data-title='Cancel Invitation?' type='button' onclick=deleteRecommendApplicants("+data.applicant_id+") class='btn btn-outline-danger btn-sm rounded-0 py-2 px-3'><i class='bi bi-x-lg'></i></button>";
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
// FETCH RECOMMENDED APPLICANTS ON CERTAIN OPERATION

// RECRUIT RECOMMEND APPLICANTS
    function recommendApplicantRecruit(id){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var operationId = localStorage.getItem('operationId');
        var applicantId = id;
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
                    data: {applicantId: applicantId, operationId: operationId},
                    success: function(response) {
                        if(response == 2){
                            Swal.fire({
                                icon: 'warning',
                                title: 'RECRUIT FAILED',
                                text: 'The project worker are already apply / invite',
                            })
                        }else if(response == 1){
                            Swal.fire({
                                title: 'RECRUIT SUCCESSFULY',
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 1000,
                            }).then((result) => {
                            if (result) {
                                badgeRecommendApplicant();
                                showOperationDetails();
                                $('#viewRecommendedTable').DataTable().ajax.reload();
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
// RECRUIT RECOMMEND APPLICANTS

// CAMCEL RECOMMEND APPLICANTS
    function deleteRecommendApplicants(id){
        var operationId = localStorage.getItem('operationId');
        var applicantId = id;
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to cancel this applicant's RECOMMENDATION?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d72323',
            confirmButtonText: 'Yes, Cancel it!'
            }).then((result) => {
            if (result.isConfirmed) {
                    $.ajax({
                    url: "/cancelRecommendation",
                    type: 'GET',
                    dataType: 'json',
                    data: {applicantId: applicantId, operationId:  operationId},
                });
                Swal.fire({
                    title: 'CANCEL SUCCESSFULY',
                    icon: 'info',
                    showConfirmButton: false,
                    timer: 1000,
                }).then((result) => {
                if (result) {
                    badgeRecommendApplicant();
                    showOperationDetails();
                    $('#viewRecommendedTable').DataTable().ajax.reload();
                }
                });
            }
        })
    }
// CAMCEL RECOMMEND APPLICANTS

// RECOMMEND APPLICANTS MODAL
    function recommendApplicantsModal(id){
        $('#recommendApplicantModal').modal('show');
        certainOperationId = id;
        return certainOperationId;
    }
// RECOMMEND APPLICANTS MODAL

// SHOW CERTAIN APPLICANTS DETAILS
    function viewApplicants(id){
    $('#recommendApplicantModal').modal('hide');
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
                    $("#showExperience1").html(data);
                }
            })
        }
        function overallRatingPerWorker(){
            $.ajax({
                url: "/overallRatingPerWorker",
                method: 'GET',
                data: {applicantId:response.applicant_id},
                success : function(data) {
                    $("#overallRatingPerWorker1").html(data);
                }
            })
        }
        function totalBackOutPerWorker(){
            $.ajax({
                url: "/totalBackOutPerWorker",
                method: 'GET',
                data: {applicantId:response.applicant_id},
                success : function(data) {
                    $("#totalBackOutPerWorker1").html(data);
                }
            })
        }
        function totalDeclinedPerWorker(){
            $.ajax({
                url: "/totalDeclinedPerWorker",
                method: 'GET',
                data: {applicantId:response.applicant_id},
                success : function(data) {
                    $("#totalDeclinedPerWorker1").html(data);
                }
            })
        }
        applicantExperience();
        overallRatingPerWorker();
        totalBackOutPerWorker();
        totalDeclinedPerWorker();
        $('#applicantsPhoto1').attr("src", response.photos)
        $('#applicantsLastname1').html(response.lastname)
        $('#applicantsFirstname1').html(response.firstname)
        $('#applicantsMiddlename1').html(response.middlename)
        $('#applicantsExt1').html(response.extention)
        $('#applicantsStatus1').html(response.status)
        $('#applicantsPosition1').html(response.position)
        $('#applicantsGender1').html(response.Gender)
        $('#applicantsAge1').html(response.age)
        $('#applicantsAddress1').html(response.address)
        $('#applicantsPnumber1').html(response.phoneNumber)
        $('#applicantsEmail1').html(response.emailAddress)
        if(response.personal_id != '' && response.personal_id2 != ''){
            $('#personalId1').attr("src", response.personal_id)
        }else{
            $('#personalId1').attr("src","/storage/applicant_id/noId.jpg")
        }
        let dtFormat = new Intl.DateTimeFormat('en-Us',{
            day: '2-digit',
            month: 'long',
            year: 'numeric'
        });
        var newDate = new Date(response[0].birthday);
        $('#applicantsBirthday1').html(dtFormat.format(newDate));
    })
    }
// SHOW CERTAIN APPLICANTS DETAILS

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
