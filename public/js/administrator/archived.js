$(document).ready(function(){
    backOutArchived();
    declinedArchived();
    cancelledOperation();
    blockApplicants();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    }); 
});

// FETCH BACKOUT ARCHIVED DATA
    function backOutArchived(){
        var table = $('#backOutTable').DataTable({
            "language": {
                "emptyTable": "No Data Found"
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
                "url":"/getBackOutArchivedForAdmin",
                "dataSrc": "",
            },
            "columns":[
                {"data":"backOut_id"},
                { "mData": function (data, type, row) {
                    if(data.applicantExtention != null){
                        return data.applicantFirstname+ " " +data.applicantLastName+ " " +data.applicantExtention;
                    }else{
                        return data.applicantFirstname+ " " +data.applicantLastName;
                    }
                }},             
                { "mData": function (data, type, row) {
                    return data.shipName+ " | " +data.shipCarry;
                }},            
                { "mData": function (data, type, row) {
                    return moment( data.operationStart).format('MMM DD, YYYY | hh:mm A');
                }},            
                { "mData": function (data, type, row) {
                    return moment( data.operationEnd).format('MMM DD, YYYY | hh:mm A')  ;
                }},         
                { "mData": function (data, type, row) {
                    if(data.extention != null){
                        return data.employeeFirstName+ " " +data.employeeLastName+ " " +data.employeeExtension;
                    }else{
                        return data.employeeFirstName+ " " +data.employeeLastName;
                    }
                }}, 
                {"data": "backOut_id",
                    mRender: function (data, type, row) {
                    return '<button type="button" onclick=backOutReason('+data+') class="btn rounded-0 btn-outline-secondary btn-sm py-2 px-3" data-title="View Reason?"><i class="bi bi-eye"></i></button>'
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
// FETCH BACKOUT ARCHIVED DATA

// FETCH BACKOUT ARCHIVED DATA
    function declinedArchived(){
    var table = $('#declinedTable').DataTable({
        "language": {
            "emptyTable": "No Data Found"
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
            "url":"/getDeclinedArchivedForAdmin",
            "dataSrc": "",
        },
        "columns":[
            {"data":"declined_id"},
            { "mData": function (data, type, row) {
                if(data.applicantExtention != null){
                    return data.applicantFirstname+ " " +data.applicantLastName+ " " +data.applicantExtention;
                }else{
                    return data.applicantFirstname+ " " +data.applicantLastName;
                }
            }},            
            { "mData": function (data, type, row) {
                return data.shipName+ " | " +data.shipCarry;
            }},            
            { "mData": function (data, type, row) {
                return moment( data.operationStart).format('MMM DD, YYYY | hh:mm A');
            }},            
            { "mData": function (data, type, row) {
                return moment( data.operationEnd).format('MMM DD, YYYY | hh:mm A')  ;
            }},            
            { "mData": function (data, type, row) {
                if(data.extention != null){
                    return data.employeeFirstName+ " " +data.employeeLastName+ " " +data.employeeExtension;
                }else{
                    return data.employeeFirstName+ " " +data.employeeLastName;
                }
            }}, 
            {"data": "declined_id",
                mRender: function (data, type, row) {
                return '<button type="button" onclick=declinedReason('+data+') class="btn rounded-0 btn-outline-secondary btn-sm py-2 px-3" data-title="View Reason?"><i class="bi bi-eye"></i></button>'
            }
            },
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
// FETCH BACKOUT ARCHIVED DATA

// FETCH CANCELLED OPERATION ARCHIVED DATA
    function cancelledOperation(){
    var table = $('#cancelOperationTable').DataTable({
        "language": {
            "emptyTable": "No Data Found"
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
            "url":"/getCancelOperationData",
            "dataSrc": "",
        },
        "columns":[
            {"data":"cancelOperation_id"},
            {"data":"operationId"},
            {"data":"shipName"},
            {"data":"shipCarry"},
            { "mData": function (data, type, row) {
                return moment( data.operationStart).format('MMM DD, YYYY | hh:mm A');
            }},            
            { "mData": function (data, type, row) {
                return moment( data.operationEnd).format('MMM DD, YYYY | hh:mm A')  ;
            }},         
            {"data": "cancelOperation_id",
                mRender: function (data, type, row) {
                return '<button type="button" onclick=cancelReason('+data+') class="btn rounded-0 btn-outline-secondary btn-sm py-2 px-3" data-title="View Reason?"><i class="bi bi-eye"></i></button>'
            }
        },   
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
// FETCH CANCELLED OPERATION ARCHIVED DATA

// FETCH BLOCKED APPLICANT ARCHIVED DATA
    function blockApplicants(){
        var table = $('#blockApplicantsArchived').DataTable({
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
                "url":"/getArchivedBlockedApplicantsForAdmin",
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
                { "mData": function (data, type, row) {
                    return data.age+ " years old";
                }},                
                {"data": "date_time_block",
                "render": function(data) {
                return moment(data).format('MMM DD, YYYY | hh:mm A');
                },
                "targets": 1
                },
                {"data": "blockId",
                    mRender: function (data, type, row) {
                        return '<button type="button" onclick=blockedReason('+data+') class="btn rounded-0 btn-outline-secondary btn-sm py-2 px-3" data-title="View Reason?"><i class="bi bi-eye"></i></button>'
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
// FETCH BLOCKED APPLICANT ARCHIVED DATA

// SHOW REASON OF BACKOUT
    function declinedReason(id){
        $('#declinedReasonModal').modal('show')
        $.ajax({
            url: '/declinedReason',
            type: 'GET',
            dataType: 'json',
            data: {declinedId: id},
        })
        .done(function(response) {
            $('#declinedReason').text(response.reason); 
        })
    }
// SHOW REASON OF BACKOUT

// SHOW REASON OF BACKOUT
    function backOutReason(id){
        $('#backOutReasonModal').modal('show')
        $.ajax({
            url: '/backOutReason',
            type: 'GET',
            dataType: 'json',
            data: {backOutId: id},
        })
        .done(function(response) {
            $('#backOutReason').text( response.reason); 
        })
    }
// SHOW REASON OF BACKOUT

// SHOW REASON OF CANCELLED OPERATION
    function cancelReason(id){
        $('#cancelReasonModal').modal('show')
        $.ajax({
            url: '/cancelOperationReason',
            type: 'GET',
            dataType: 'json',
            data: {cancelOperationId: id},
        })
        .done(function(response) {
            $('#cancelReason').text( response.reason); 
        })
    }
// SHOW REASON OF CANCELLED OPERATION

// SHOW REASON OF BLOCKED WORKERS
    function blockedReason(id){
        $('#blockedReasonModal').modal('show')
        $.ajax({
            url: '/blockedReason',
            type: 'GET',
            dataType: 'json',
            data: {blockedReasonId: id},
        })
        .done(function(response) {
            $('#blockedReason').text( response.reason); 
        })
    }
// SHOW REASON OF BLOCKED WORKERS