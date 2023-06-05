$(document).ready(function(){
    onCallWorkersTable();
    applicantsTable();
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
            {"data":"phoneNumber"},
            {"data": "applicant_id",
                mRender: function (data, type, row) {
                return '<button type="button" data-title="View Details?" onclick=viewOnCallWorkers('+data+') class="btn rounded-0 btn-outline-secondary btn-sm py-2 px-3"><i class="bi bi-eye"></i></button> <a href="printProjectWorker/'+data+'" class="btn rounded-0 btn-outline-primary btn-sm py-2 px-3" data-title="Print this Worker?"><i class="bi bi-filetype-pdf"></i></a>'
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
            {"data":"phoneNumber"},
            {"data": "applicant_id",
                mRender: function (data, type, row) {
                return '<button type="button" data-title="View Details?" onclick=viewApplicants('+data+') class="btn rounded-0 btn-outline-secondary btn-sm py-2 px-3"><i class="bi bi-eye"></i></button> <a href="printProjectWorker/'+data+'" class="btn rounded-0 btn-outline-primary btn-sm py-2 px-3" data-title="Print this Applicant?"><i class="bi bi-filetype-pdf"></i></a>'
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