$(document).ready(function(){
    totalUpcomingOperation();
    totalCompletedOperation();
    totalForeman();
    totalApplicants();
    visualization();
});


// FUNCTION FOR SHOW TOTAL UPCOMING OPERATION
    function totalUpcomingOperation(){
        $.ajax({
            url: '/totalUpcomingOperation',
            method: 'GET',
            success : function(data) {
                $("#totalUpcomingOperation").html(data);
            }
        })
    }
// FUNCTION FOR SHOW TOTAL UPCOMING OPERATION

// FUNCTION FOR SHOW TOTAL COMPLETED OPERATION
    function totalCompletedOperation(){
        $.ajax({
            url: '/totalCompletedOperation',
            method: 'GET',
            success : function(data) {
                $("#totalCompletedOperation").html(data);
            }
        })
    }
// FUNCTION FOR SHOW TOTAL COMPLETED OPERATION

// FUNCTION FOR SHOW TOTAL APPLICANTS
    function totalApplicants(){
        $.ajax({
            url: '/totalApplicants',
            method: 'GET',
            success : function(data) {
                $("#totalApplicants").html(data);
            }
        })
    }
// FUNCTION FOR SHOW TOTAL APPLICANTS

// FUNCTION FOR SHOW TOTAL FOREMAN
    function totalForeman(){
        $.ajax({
            url: '/totalForeman',
            method: 'GET',
            success : function(data) {
                $("#totalForeman").html(data);
            }
        })
    }
// FUNCTION FOR SHOW TOTAL FOREMAM

// VISUALIZATION
    function visualization(){
        $.ajax({
            url: '/visualization',
            method: 'GET',
            success : function(data) {
                if(data != ""){
                    const ctx = document.getElementById('myChart').getContext('2d');
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                        labels: [data[0].monthName],
                        datasets: [{
                            label: '# of Operation Per Month',
                            data : [data[0].totalOperations],
                            borderWidth: 1,
                            backgroundColor: [
                                '#800000',
                            ],
                            borderColor: [
                                '#800000',
                            ],
                        }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                },
                                }
                        }
                    });
                }else{
                    var target = document.getElementById("visualization");
                    target.innerHTML += "<div class='text-danger fs-4 text-center' style='position:absolute; top:19rem; width:100%' role='alert'>NO DATA AVAILABLE</div>";
                }
            }
        })
    } 
// VISUALIZATION