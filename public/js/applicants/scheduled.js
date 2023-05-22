$(document).ready(function(){
    certainSchedule();
});

// FETCH ALL SCHEDULED OPERATION
    function certainSchedule(){
        $.ajax({
            url: "/applicantScheduled",
            method: 'GET',
            success : function(data) {
                $("#fetchAllSchedule").html(data);
            }
        })
    }
// FETCH ALL SCHEDULED OPERATION

// BACKOUT OPERATION
    function backOutOperation(operationId, recruiterId){
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to BACKOUT on this operation?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d72323',
            confirmButtonText: 'Yes, Continue'
            }).then((result) => {
            if (result.isConfirmed) {
            (async () => {
                const { value: reason } = await Swal.fire({
                    input: 'textarea',
                    title: 'Reason of Back Out?',
                    text: "once you submit, You won't be able to revert this",
                    inputPlaceholder: 'Type your reason here...',
                    inputAttributes: {
                    'aria-label': 'Type your message here'
                    },
                    showCancelButton: true
                })
                if(reason){
                    $.ajax({
                        url: '/backOutOperation',
                        type: 'GET',
                        dataType: 'text',
                        data: {reason: reason, operationId: operationId, recruiterId:recruiterId},
                        success: function(response) {
                            if(response == 1){
                                Swal.fire({
                                    title: 'BACKOUT SUCCESSFULLY',
                                    icon: 'success',
                                    showConfirmButton: false,
                                    timer: 1000,
                                }).then((result) => {
                                if (result) {
                                    certainSchedule();
                                }
                                });
                            }else if(response == 0){
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Decline Failed',
                                    text: 'Something wrong at the backend',
                                })
                            }
                        }
                    });
                }
            })()
            }
        });
    }
// BACKOUT OPERATION