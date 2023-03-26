$(document).ready(function(){
    totalScbeduledOperation();
    totalPendingInvitation();
    totalBackout();
    totalDecline();
    applicantBackoutContent();
});

// FUNCTION FOR SHOW TOTAL UPCOMING OPERATION
    function totalScbeduledOperation(){
        $.ajax({
            url: '/recruiterScheduleOperation',
            method: 'GET',
            success : function(data) {
                $("#totalScbeduledOperation").html(data);
            }
        })
    }
// FUNCTION FOR SHOW TOTAL UPCOMING OPERATION

// FUNCTION FOR SHOW TOTAL PENDIDIN INVITATION OPERATION
    function totalPendingInvitation(){
        $.ajax({
            url: 'recruiterPendingOperation',
            method: 'GET',
            success : function(data) {
                $("#totalPendingInvitation").html(data);
                $("#badgePendingInvitation").html(data);
            }
        })
    }
// FUNCTION FOR SHOW TOTAL PENDIDIN INVITATION OPERATION

// FUNCTION FOR SHOW TOTAL BACKOUT OPERATION
    function totalBackout(){
        $.ajax({
            url: '/recruiterBackOutInvitation',
            method: 'GET',
            success : function(data) {
                $("#totalBackout").html(data);
                $("#badgeApplicantBackout").html(data);
            }
        })
    }
// FUNCTION FOR SHOW TOTAL BACKOUT OPERATION

// FUNCTION FOR SHOW TOTAL BACKOUT OPERATION
    function totalDecline(){
        $.ajax({
            url: '/recruiterDeclinedInvitaion',
            method: 'GET',
            success : function(data) {
                $("#totalDecline").html(data);
                $("#badgeApplicantDeclined").html(data);
            }
        })
    }
// FUNCTION FOR SHOW TOTAL BACKOUT OPERATION

// APPLICANT BACKOUT CONTENT
    function applicantBackoutContent(){
        $.ajax({
            url: "/applicantBackoutContent",
            method: 'GET',
            success : function(data) {
                $("#fetchAllApplicantsBackout").html(data);
            }
        })
    }
// APPLICANT BACKOUT CONTENT

// DELETE BACK OUT DETAILS
    function deleteBackOutDetails(id){
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to NOTED this?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d72323',
            confirmButtonText: 'Yes, Noted!'
            }).then((result) => {
            if (result.isConfirmed) {
                    $.ajax({
                    url: "/deleteBackOut",
                    type: 'GET',
                    dataType: 'json',
                    data: {backOutId: id},
                });
                Swal.fire({
                    title: 'NOTED SUCCESSFULY',
                    icon: 'info',
                    showConfirmButton: false,
                    timer: 1000,
                }).then((result) => {
                if (result) {
                    totalBackout();
                    applicantBackoutContent();
                }
                });
            }
        })
    }
// DELETE BACK OUT DETAILS