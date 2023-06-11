$(document).ready(function(){
    totalUpcomingOperation();
    totalCompletedOperation();
    totalForeman();
    totalApplicants();
    visualization();
    highestRatings();
    common();
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
                        type: 'line',
                        data: {
                        labels: data.months,
                        datasets: [{
                            label: '# of Operation Per Month',
                            data : data.operations,
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
                                    max: 15,
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

// HIGHEST RATINGS
    function highestRatings(){
        var table = $('#highestRating').DataTable({
            "language": {
                "emptyTable": "No Employees Found"
            },
            "lengthChange": false,
            "scrollCollapse": false,
            "paging": false,
            "info": false,
            "responsive": false,
            "ordering": false,
            "aLengthMenu": [[25, 50, 75, -1], [25, 50, 75, "All"]],
            "iDisplayLength": 25,
            "ajax":{
                "url":"/getHighestRating",
                "dataSrc": "",
            },
            "_columns": [
                { "data": "applicant_id" },
                { "mData": function (data, type, row) {
                    if(data.extention != null){
                        return data.firstname+ " " +data.lastname+ " " +data.extention;
                    }else{
                        return data.firstname+ " " +data.lastname;
                    }
                }},
                { "mData": function (data, type, row) {
                    return data.age+ " Years Old";
                }},
                { "mData": function (data, type, row) {
                    return data.averageRating+ "%";
                }},
            ],
            get "columns"() {
                return this["_columns"];
            },
            set "columns"(value) {
                this["_columns"] = value;
            },
            order: [[1, 'asc']],
        });
        table.on('order.dt search.dt', function () {
            let i = 1;
            table.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
                this.data(i++);
            });
        }).draw();
    }
// HIGHEST RATINGS

// COMMON SHIP CARGO
    function common(){
        $.ajax({
            url: '/mostCommonCargo',
            method: 'GET',
            success : function(data) {
                if(data != ""){
                    const ctx = document.getElementById('pie').getContext('2d');
                        let commonCarry  = new Chart(ctx,{
                        type: 'pie',
                        data:{
                            datasets : [{
                                data: data.count,
                                backgroundColor: [
                                'rgb(255, 99, 132)',
                                'rgb(54, 162, 235)',
                                'rgb(255, 205, 86)'],
                            }],
                            labels:data.shipCarry
                        },
                        options:{
                            responsive: true,
                        }
                    })
                }
            }
        })
    }
// COMMON SHIP CARGO
