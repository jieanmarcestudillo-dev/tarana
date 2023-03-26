$(document).ready(function(){
    showCompletedOperation();
});

// FOR COMPLETED OPERATION
    function showCompletedOperation(){
        var table = $('#applicantCompletedOperation').DataTable({
            "lengthChange": true,
            "scrollCollapse": true,
            "paging": true,
            "info": true,
            "responsive": true,
            "ordering": false,
            "aLengthMenu": [[25, 50, 75, -1], [25, 50, 75, "All"]],
            "iDisplayLength": 25,
            "language": {
                "emptyTable": "No operation has been completed yet."
            },
            "ajax":{
                "url":"/applicantCompletedOperation",
                "dataSrc": "",
            },
            "columns":[
                {"data":"certainOperation_id"},
                { "mData": function (data, type, row) {
                    if(data.extention != null){
                        return data.firstname+ " " +data.lastname+ " " +data.extention;
                    }else{
                        return data.firstname+ " " +data.lastname;
                    }
                }},
                { "mData": function (data, type, row) {
                    return data.shipName+ " | " +data.shipCarry;
                }},
                {"data": "operationStart",
                "render": function(data) {
                    return moment(data).format('MMM DD, YYYY | hh:mm A');},
                "targets": 1
                },
                {"data": "operationEnd",
                "render": function(data) {
                    return moment(data).format('MMM DD, YYYY | hh:mm A');},
                "targets": 1
                },
                {"data": "certainOperation_id",
                    mRender: function (data, type, row) {
                    return '<button type="button" onclick=viewOperation('+data+') class="btn rounded-0 btn-outline-secondary btn-sm py-2 px-3">Image</button>'
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
// FOR COMPLETED OPERATION

// FETCH DATA FOR UPDATE OPERATION
    function viewOperation(id){
        $('#viewOperationModal').modal('show')
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