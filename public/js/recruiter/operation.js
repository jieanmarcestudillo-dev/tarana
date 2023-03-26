$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    showTotalOperations();
});

// FETCH 
    // SHOW TOTAL OPERATIONS
        function showTotalOperations(){
            $.ajax({
                url: "/recruiterOperation",
                method: 'GET',
                success : function(data) {
                    $("#showTotalOperation").html(data);
                }
            })
        }
    // SHOW TOTAL OPERATIONS
  
    // REDIRECT TO SPECIFIC OPERATION
        function recruitApplicantsRoutes(id){
            localStorage.setItem('operationId', id);
            window.location.href = '/recruitApplicantsRoutes';
        }
    // REDIRECT TO SPECIFIC OPERATION

// FETCH