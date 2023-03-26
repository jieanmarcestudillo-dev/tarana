$(document).ready(function () {
    operationInvitationContent();
    totalUpcomingOperation();
    totalScheduledOperation();
    totalInvitationOperation();
});

// SHOW OPERATION INVITATION
    function operationInvitationContent() {
        $.ajax({
            url: "/applicantInvitation",
            method: "GET",
            success: function (data) {
                $("#fetchAllInvitation").html(data);
            },
        });
    }
// SHOW OPERATION INVITATION

// FOR APPLY IN SPECIFIC OPERATION
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
                        totalScheduledOperation();
                        totalInvitationOperation();
                        operationInvitationContent();
                        Swal.fire({
                            title: 'PARTICIPATE SUCCESSFULLY',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1000,
                        }).then((result) => {
                        if (result) {
                            totalInvitationOperation();
                            operationInvitationContent();
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
// FOR APPLY IN SPECIFIC OPERATION

// SHOW DETAILS OF OPERATION
    function operationDetails(id) {
        $("#viewOperationDetails").modal("show");
        $.ajax({
            url: "/php/fetch/applicantsDashboard.php",
            method: "POST",
            data: { showDetailsOperation: id },
            success: function (data) {
                $("#showScheduledDetails").html(data);
            },
        });
    }
// SHOW DETAILS OF OPERATION

// DECLINE INVITATION
    function declineInvitation(id){
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
                data: {reason: reason, operationId: id},
                success: function(response) {
                    if(response == 1){
                        totalInvitationOperation();
                        operationInvitationContent();
                        Swal.fire({
                            title: 'DECLINE SUCCESSFULLY',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1000,
                        }).then((result) => {
                        if (result) {
                            totalInvitationOperation();
                            operationInvitationContent();
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

// FUNCTION FOR SHOW TOTAL UPCOMING OPERATION
    function totalUpcomingOperation() {
        $.ajax({
            url: "/totalUpcomingOperation",
            method: "GET",
            success: function (data) {
                $("#totalUpcomingOperation").html(data);
            },
        });
    }
// FUNCTION FOR SHOW TOTAL UPCOMING OPERATION

// FUNCTION FOR SHOW TOTAL SCHEDULED OPERATION
    function totalScheduledOperation() {
        $.ajax({
            url: "/totalScheduledOperation",
            method: "GET",
            data: { getTotalScheduledOperation: 1 },
            success: function (data) {
                $("#totalScheduledOperation").html(data);
            },
        });
    }
// FUNCTION FOR SHOW TOTAL SCHEDULED OPERATION

// FUNCTION FOR SHOW TOTAL SCHEDULED OPERATION
    function totalInvitationOperation() {
        $.ajax({
            url: "/totalInvitationOperation",
            method: "GET",
            success: function (data) {
                $("#totalInvitation").html(data);
            },
        });
    }
// FUNCTION FOR SHOW TOTAL SCHEDULED OPERATION

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