$(document).ready(function(){
    operationData();
    completedOperationData();
    showRecruiter();
    generateOperationId();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

// FETCH UPCOMING OPERATION FOR TABLES
    function operationData(){
            var table = $('#operationTable').DataTable({
                "language": {
                    "emptyTable": "No operation has been scheduled."
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
                "url":"/getOperationData",
                "dataSrc": "",
                "targets": "0",
            },
            "columns":[
                {"data":"certainOperation_id"},
                {"data":"operationId"},
                {"data":"shipName"},
                {"data":"shipCarry"},
                {"data": "operationStart",
                    "render": function(data) {
                    return moment(data).format('MMM DD, YYYY | hh:mm A');
                },
                "targets": 1
                },
                {"data": "operationEnd",
                    "render": function(data) {
                    return moment(data).format('MMM DD, YYYY | hh:mm A');
                },
                "targets": 1
                },
                {"data": "certainOperation_id",
                    mRender: function (data, type, row) {
                    return '<button type="button" onclick=editOperations('+data+') class="btn btn-outline-secondary btn-sm rounded-0 py-2 px-3" data-title="Edit Operation?"><i class="bi bi-pen-fill"></i></button>  <button type="button" data-title="Cancel Operation?" onclick=cancelOperations('+data+') class="btn btn-outline-danger btn-sm rounded-0 py-2 px-3"><i class="bi bi-trash3-fill"></i></button> <a data-title="Print Operation?" href="printOperation/'+data+'" class="btn rounded-0 btn-outline-primary btn-sm py-2 px-3"><i class="bi bi-filetype-pdf"></i></a>' 
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
// FETCH UPCOMING OPERATION FOR TABLES

// FETCH COMPLETED OPERATION FOR TABLES
    function completedOperationData(){
        var table = $('#completedOperationTable').DataTable({
        "language": {
            "emptyTable": "No operation has been completed yet."
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
            "url":"/getCompletedOperationData",
            "dataSrc": "",
            "targets": "0",
        },
        "columns":[
            {"data":"certainOperation_id"},
            {"data":"operationId"},
            {"data":"shipName"},
            {"data":"shipCarry"},
            {"data": "operationStart",
                "render": function(data) {
                return moment(data).format('MMM DD, YYYY | hh:mm A');
            },
            "targets": 1
            },
            {"data": "operationEnd",
                "render": function(data) {
                return moment(data).format('MMM DD, YYYY | hh:mm A');
            },
            "targets": 1
            },
            {"data": "certainOperation_id",
                mRender: function (data, type, row) {
                return '<button type="button" onclick=applicantsParticipated('+data+') class="btn rounded-0  btn-outline-secondary btn-sm">Project Workers</button> <a href="printCompletedOperation/'+data+'" class="btn rounded-0 btn-outline-secondary btn-sm">PDF</a>' 
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
// FETCH COMPLETED OPERATION FOR TABLES

// FETCH DATA FOR UPDATE OPERATION
    function editOperations(id){
        $('#updateOperationModal').modal('show')
        $.ajax({
            url: '/showCertainOperation',
            type: 'GET',
            dataType: 'json',
            data: {operationId: id},
        })
        .done(function(response) {
            $('#operationPhoto').attr("src",response.photos)
            $('#certainOperation_id').val(response.certainOperation_id)           
            $('#operationId').val(response.operationId)           
            $('#shipName').val(response.shipName)           
            $('#shipCarry').val(response.shipCarry)           
            $('#operationStart').val(response.operationStart)           
            $('#operationEnd').val(response.operationEnd)           
            $('#slot').val(response.slot)           
            $('#foreman').val(response.foreman)           
        })
    }
// FETCH DATA FOR UPDATE OPERATION

// FUNCTION FOR FETCH ALL FOREMAN
    function showRecruiter(){
        $.ajax({
        url: '/getAllEmployeesData',
        dataType:"json",
        method:"GET",
        success:function(response){
            if(response == 0){
                data+="<option value='No Foreman Found'>No Foreman Found</option>"
            }else{
                var data = "";
                for(i=0;i<response.length;i++){
                    data+="<option value='"+response[i].employee_id+"'>"+response[i].firstname+" "+response[i].lastname+"</option>"
                }
            }
                $('#foreman').html(data)
                $('#allForemanAdd').html(data)
        },
        error:function(error){
            console.log(error)
        }
        })
    }
// FUNCTION FOR FETCH ALL FOREMAN

// ADD OPERATION 
    $(document).ready(function () {
        $('#addOperationForm').on( 'submit' , function(e){
            e.preventDefault();
            var currentForm = $('#addOperationForm')[0];
            var data = new FormData(currentForm);
                $.ajax({
                    url: "/addOperation",
                    type:"POST",
                    method:"POST",
                    dataType: "text",
                    data:data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success:function(response){
                        if(response == 1){
                            generateOperationId();
                            $("#addOperationForm").trigger("reset");
                            $('#operationTable').DataTable().ajax.reload();
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'NEW OPERATION HAS BEEN STORED',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }else if(response == 0){
                            Swal.fire(
                            'Added Failed',
                            'Sorry operation has not stored',
                            'error'
                            )
                        }else if(response == "Sorry, The operation is already exist"){
                            Swal.fire(
                            'Added Failed',
                            'Sorry the operation is already exist',
                            'error'
                            )
                        }else if(response == 4){
                            Swal.fire(
                            'Invalid Operation Start',
                            'Please check the date and time of operation start',
                            'error'
                            )
                        }else if(response == 3){
                            Swal.fire(
                            'Invalid Operation End Date/Time',
                            'Please check the date and time of the operation end',
                            'error'
                            )
                        }else if(response == 2){
                            Swal.fire(
                            'Invalid Date and Time',
                            'The date of both operation start/end must not be the same',
                            'error'
                            )
                        }
                    },
                    error:function(error){
                        console.log(error)
                    }
                }) 
        });
    });
// ADD OPERATION

// UPDATE OPERATION
    $(document).ready(function () {
        $('#updateOperationForm').on( 'submit' , function(e){
            e.preventDefault();
            var currentForm = $('#updateOperationForm')[0];
            var data = new FormData(currentForm);
            $.ajax({
                url: "/updateOperation",
                type:"POST",
                method:"POST",
                dataType: "text",
                data:data,
                cache: false,
                contentType: false,
                processData: false,
                success:function(response){
                    if(response == 1){
                        // OPERATION SUBMIT SUCCESSFULY
                        const input = document.getElementById("clearPhoto");
                        input.value = ""; 
                        $('#operationTable').DataTable().ajax.reload();
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'OPERATION HAS BEEN UPDATED',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }else if(response == 0){
                        // SOMETHING WRONG IN BACKEND
                        Swal.fire(
                        'Added Failed',
                        'Sorry operation has not stored',
                        'error'
                        )
                    }else if(response == "Sorry, The operation is already exist"){
                        // OPERATION ID IS ALREADY SET
                        Swal.fire(
                        'Added Failed',
                        'Sorry the operation is already exist',
                        'error'
                        )
                    }else if(response == 4){
                        // OPERATION START DATE AND TIME IS INVALID
                        Swal.fire(
                        'Invalid Operation Start',
                        'Please check the date and time of operation start',
                        'error'
                        )
                    }else if(response == 3){
                        // OPERATION END DATE AND TIME IS INVALID
                        Swal.fire(
                        'Invalid Operation End Date/Time',
                        'Please check the date and time of the operation end',
                        'error'
                        )
                    }else if(response == 2){
                        // BOTH OPERATION DATE AND TIME IS INVALID
                        Swal.fire(
                        'Invalid Date and Time',
                        'The DATE and TIME of both operation start and end must not be the same',
                        'error'
                        )
                    }else if(response == 5){
                        // INAVALID EXTENTION IMAGE
                        Swal.fire(
                        'Invalid File Extention',
                        'Sorry, Only JPG, JPEG, PNG, GIF, SVG files are allowed.',
                        'error'
                        )
                    }
                },
                error:function(error){
                    console.log(error)
                }
            }) 
        });
    });
// UPDATE OPERATION

// GENERATE OPERATION ID
    function generateOperationId(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "/generateOperationId",
            method: 'POST',
            success : function(data) {
                $("#addOperationId").val(data);
            }
        })
    }
// GENERATE OPERATION ID

// IMPORT OPERATION
    $(document).ready(function () {
        $('#importOperationForm').on( 'submit' , function(e){
            e.preventDefault();
            var currentForm = $('#importOperationForm')[0];
            var data = new FormData(currentForm);
            $.ajax({
                url: "/operationImport",
                type:"POST",
                method:"POST",
                dataType: "text",
                data:data,
                cache: false,
                contentType: false,
                processData: false,
                success:function(response){
                    if(response == 1){
                        // OPERATION SUBMIT SUCCESSFULY
                        $("#importOperationForm").trigger("reset");
                        $('#operationTable').DataTable().ajax.reload();
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'OPERATION HAS BEEN STORED SUCCESSFULLY',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }else{
                        Swal.fire(
                        'Added Failed',
                        'Sorry, Something Happened',
                        'error'
                        )
                    }
                }
            });
        });
    });
// IMPORT OPERATION

// CANCEL OPERATION
    function cancelOperations(id){
        Swal.fire({
            icon: 'question',
            title: 'Are you sure?',
            text: "Do you want to CANCEL this operation?",
            input: 'text',
            inputPlaceholder: 'Enter your password to confirm',
            inputAttributes: {autocapitalize: 'off'},
            showCancelButton: true,
            confirmButtonText: 'Submit',
            }).then((response) => {
                if(response.value === ""){
                    Swal.fire(
                        'Cancel Failed',
                        'Please Enter Your Password',
                        'error'
                    )
                }else{
                    $.ajax({
                        url: '/confirmationPassword',
                        type: 'GET',
                        dataType: 'text',
                        data: {employeePassword: response.value},
                        success:function(response2){
                            if(response2 == 1){
                                (async () => {
                                    const { value: reason } = await Swal.fire({
                                        input: 'textarea',
                                        title: 'Reason of Cancelled Operation',
                                        inputPlaceholder: 'Type your reason here...',
                                        inputAttributes: {
                                        'aria-label': 'Type your reason here'
                                        },
                                        showCancelButton: true
                                    })
                                    if (reason) {
                                        $.ajax({
                                            url: '/cancelOperation',
                                            type: 'GET',
                                            dataType: 'json',
                                            data: {operationId: id, reason:reason},
                                        });
                                        Swal.fire({
                                            title: 'OPERATION WAS CANCEL SUCCESSFULLY',
                                            icon: 'success',
                                            showConfirmButton: false,
                                            timer: 1500,
                                        }).then((result) => {
                                        if (result) {
                                            $('#operationTable').DataTable().ajax.reload();
                                        }
                                        });
                                    }
                                })()
                         
                            }else if(response2 == 0){
                                    Swal.fire(
                                    'Wrong Password',
                                    'Please re-type your password',
                                    'error'
                                    )
                            }
                        }
                    });
                }
            });
    }
// CANCEL OPERATION

// VIEW COMPLETED OPERATION
    function applicantsParticipated(id){
        $('#operationDetailsModal').modal('show')
        operationWorkers();
        function operationWorkers(){
            $.ajax({
                url: "/showApplicantOnCertainOperation",
                method: 'GET',
                data: {operationId:id},
                success : function(data) {
                    $("#showCompletedDetails").html(data);
                }
            })
        }
    }
// VIEW COMPLETED OPERATION

// VIEW APPLICANTS DATA
    function viewApplicants(id){
        $('#operationDetailsModal').modal('hide')
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
// VIEW APPLICANTS DATA