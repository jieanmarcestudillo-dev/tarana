$(document).ready(function(){
    totalScbeduledOperation();
    totalPendingInvitation();
    totalBackout();
    totalDecline();
    pendingInvitationContent();
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

// SHOW BACK OUT INFO
    function showBackOutDetails(){
        $.ajax({
            url: "/php/fetch/foremanDashboard.php",
            method: 'POST',
            data: {getTotalBackoutDetails: 1},
            success : function(data) {
                $("#fetchAllBackout").html(data);
            }
        })
    }
// SHOW BACK OUT INFO

// FETCH DATA FOR UPDATE OPERATION
    function showCertainOperation(id){
        $('#updateOperationModal').modal('show')
        $.ajax({
            url: '/showCertainOperation',
            type: 'GET',
            dataType: 'json',
            data: {operationId: id},
        })
        .done(function(response) {
            $('#updateOperationPhoto').attr("src", response.photos)
            $('#certainOperation').val(response.certainOperation_id)           
            $('#updateOperationId').val(response.operationId)           
            $('#updateShipsName').val(response.shipName)           
            $('#updateShipsCarry').val(response.shipCarry)           
            $('#updateOperationStart').val(response.operationStart)           
            $('#updateOperationEnd').val(response.operationEnd)           
            $('#updateApplicantsSlot').val(response.slot)           
            $('#updatefindEmployees').val(response.foreman)           
        })
    }
// FETCH DATA FOR UPDATE OPERATION

// PENDING INVITATION CONTENT
    function pendingInvitationContent(){
        $.ajax({
            url: "/pendingInvitationContent",
            method: 'GET',
            success : function(data) {
                $("#fetchAllPendingInvitation").html(data);
            }
        })
    }
// PENDING INVITATION CONTENT

// CAMCEL RECOMMEND APPLICANTS
    function deleteRecommendApplicants(id){
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to CANCEL this applicant's RECOMMENDATION?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d72323',
            confirmButtonText: 'Yes, Cancel it!'
            }).then((result) => {
            if (result.isConfirmed) {
                    $.ajax({
                    url: "/deleteInvitation",
                    type: 'GET',
                    dataType: 'json',
                    data: {appliedId: id},
                });
                Swal.fire({
                    title: 'CANCEL SUCCESSFULY',
                    icon: 'warning',
                    showConfirmButton: false,
                    timer: 1000,
                }).then((result) => {
                if (result) {
                    totalPendingInvitation();
                    pendingInvitationContent();
                }
                });
            }
        })
    }
// CAMCEL RECOMMEND APPLICANTS