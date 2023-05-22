$(document).ready(function(){
    totalDecline();
    totalScbeduledOperation();
    totalPendingInvitation();
    totalBackout();
    applicantDeclinedContent();
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

// APPLICANT DECLINED CONTENT
    function applicantDeclinedContent(){
        $.ajax({
            url: "/applicantDeclinedContent",
            method: 'GET',
            success : function(data) {
                $("#fetchAllApplicantsDeclined").html(data);
            }
        })
    }
// APPLICANT DECLINED CONTENT

// DELETE DECLINED DETAILS
    function deletedeclineDetails(id){
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
                    url: "/archiveDeclined",
                    type: 'GET',
                    dataType: 'json',
                    data: {declinedId: id},
                });
                Swal.fire({
                    title: 'NOTED SUCCESSFULY',
                    icon: 'info',
                    showConfirmButton: false,
                    timer: 1000,
                }).then((result) => {
                if (result) {
                    totalDecline();
                    applicantDeclinedContent();
                }
                });
            }
        })
    }
// DELETE DECLINED DETAILS

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