$(document).ready(function(){
    showTotalOperations();
});

// SHOW TOTAL OPERATIONS
    function showTotalOperations(){
        $.ajax({
            url: "/applicantOperation",
            method: 'GET',
            success : function(data) {
                $("#fetchAllOperation").html(data);
            }
        })
    }
// SHOW TOTAL OPERATIONS

// FOR APPLY IN SPECIFIC OPERATION
    function taraNaBtn(id){
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to APPLY to this operation?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d72323',
            confirmButtonText: 'Yes, i apply'
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                url: '/applicantApply',
                type: 'GET',
                dataType: 'json',
                data: {operationId: id},
                success: function(response) {
                    if(response == 2){
                        Swal.fire({
                            icon: 'error',
                            title: 'APPLY FAILED',
                            text: 'Please complete all of your information.',
                            footer: '<a href="/applicantAccountRoutes">DIRECT ME TO MANAGE ACCOUNT</a>'
                        })
                    }else if(response == 1){
                        Swal.fire({
                            title: 'APPLY SUCCESSFULLY',
                            text: "Please wait to accept you",
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1500,
                        }).then((result) => {
                        if (result) {
                            showTotalOperations();            
                        }
                        });
                    }else if(response == 0){
                        Swal.fire({
                            icon: 'error',
                            title: 'Apply Failed',
                            text: 'Something wrong at the backend',
                        })
                    }else if(response == 3){
                        Swal.fire({
                            icon: 'error',
                            title: 'Apply Failed',
                            text: 'You are not available on that day because you are already scheduled for the same date and time. Please select another operation.',
                        })
                    }
                }
            });
            }
        });
    }
// FOR APPLY IN SPECIFIC OPERATION

// CANCEL THE APPLY FOR SPECIFIC OPERATION
    function cancelApplied(id){
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to CANCEL this application?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d72323',
            confirmButtonText: 'Yes, cancel it'
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                url: '/cancelApply',
                type: 'GET',
                dataType: 'json',
                data: {appliedId: id},
            });
            Swal.fire({
                title: 'CANCEL SUCCESSFULLY',
                icon: 'success',
                showConfirmButton: false,
                timer: 1000,
            }).then((result) => {
            if (result) {
                showTotalOperations();            
            }
            });
            }
            });
    }
// CANCEL THE APPLY FOR SPECIFIC OPERATION

// DECLINE INVITATION
    function declineInvitation(operationId, recruiterId){
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to DECLINE this invitation?",
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
                    title: 'Reason of Decline?',
                    text: "once you submit, youre not allowed to participate to this operation",
                    inputPlaceholder: 'Type your reason here...',
                    inputAttributes: {
                    'aria-label': 'Type your message here'
                    },
                    showCancelButton: true
                })
                if(reason){
                    $.ajax({
                        url: '/declinedInvitation',
                        type: 'GET',
                        dataType: 'text',
                        data: {reason: reason, operationId: operationId, recruiterId:recruiterId},
                        success: function(response) {
                            if(response == 1){
                                showTotalOperations();
                                Swal.fire({
                                    title: 'DECLINE SUCCESSFULLY',
                                    icon: 'success',
                                    showConfirmButton: false,
                                    timer: 1000,
                                }).then((result) => {
                                if (result) {
                                    showTotalOperations();
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
// DECLINE INVITATION

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
                                    showTotalOperations();
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

// SHOW DETAILS OF OPERATION
    function coWorkersDetails(id){     
        $.ajax({
            url: "/coWorkers",
            method: 'GET',
            data:{operationId:id},
            success : function(data) {
                $("#showScheduledDetails").html(data);
                $('#viewOperationDetails').modal('show')
            }
        })
    }
// SHOW DETAILS OF OPERATION

// FOR ACCEPT INVITATION IN SPECIFIC OPERATION
    function acceptInvitation(id){
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to PARTICIPATE to this operation?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d72323',
            confirmButtonText: 'Yes, Continue'
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                url: '/acceptInvitation',
                type: 'GET',
                dataType: 'json',
                data: {operationId: id},
                success: function(response) {
                    if(response == 1){
                        showTotalOperations();
                        Swal.fire({
                            title: 'PARTICIPATE SUCCESSFULLY',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1000,
                        }).then((result) => {
                        if (result) {
                            showTotalOperations();
                        }
                        });
                    }else if(response == 0){
                        Swal.fire({
                            icon: 'error',
                            title: 'Apply Failed',
                            text: 'Something wrong at the backend',
                        })
                    }
                }
            });
            }
        });
    }
// FOR ACCEPT INVITATION IN SPECIFIC OPERATION

