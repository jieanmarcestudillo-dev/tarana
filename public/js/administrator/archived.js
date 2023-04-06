$(document).ready(function(){
    backOutArchived();
    declinedArchived();
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
                "url":"/getBackOutArchived",
                "dataSrc": "",
            },
            "columns":[
                {"data":"backOut_id"},
                { "mData": function (data, type, row) {
                    if(data.extention != null){
                        return data.firstname+ " " +data.lastname+ " " +data.extention;
                    }else{
                        return data.firstname+ " " +data.lastname;
                    }
                }},            
                { "mData": function (data, type, row) {
                    return data.shipName+ " | " +data.shipCarry + "<br> From: " + moment( data.operationStart).format('MMM DD, YYYY | hh:mm A') + "<br> Until: " + moment( data.operationEnd).format('MMM DD, YYYY | hh:mm A')  ;
                }},            
                {"data":"reason"},
                {"data": "backOut_id",
                    mRender: function (data, type, row) {
                    return '<button type="button" onclick=deactivateApplicants('+data+') class="btn rounded-0 btn-outline-danger btn-sm py-2 px-3" data-title="Delete Forever?"><i class="bi bi-trash3"></i></button>'
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
            "url":"/getDeclinedArchived",
            "dataSrc": "",
        },
        "columns":[
            {"data":"declined_id"},
            { "mData": function (data, type, row) {
                if(data.extention != null){
                    return data.firstname+ " " +data.lastname+ " " +data.extention;
                }else{
                    return data.firstname+ " " +data.lastname;
                }
            }},            
            { "mData": function (data, type, row) {
                return data.shipName+ " | " +data.shipCarry + "<br> From: " + moment( data.operationStart).format('MMM DD, YYYY | hh:mm A') + "<br> Until: " + moment( data.operationEnd).format('MMM DD, YYYY | hh:mm A')  ;
            }},            
            {"data":"reason"},
            {"data": "declined_id",
                mRender: function (data, type, row) {
                return '<button type="button" onclick=deactivateApplicants('+data+') class="btn rounded-0 btn-outline-danger btn-sm py-2 px-3" data-title="Delete Forever?"><i class="bi bi-trash3"></i></button>'
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