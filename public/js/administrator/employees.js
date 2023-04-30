$(document).ready(function(){
    employeesTable();
    inactiveEmployeesTable();
    currentlyUtilizing();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

// FETCH ACTIVE EMPLOYEES FOR TABLES
    function employeesTable(){
        var table = $('#activeEmployees').DataTable({
            "language": {
                "emptyTable": "No Employees Found"
            },
            "lengthChange": true,
            "scrollCollapse": true,
            "paging": true,
            "info": true,
            "responsive": true,
            "ordering": false,
            "aLengthMenu": [[25, 50, 75, -1], [25, 50, 75, "All"]],
            "iDisplayLength": 25,
            "ajax":{
                "url":"/getAllEmployeesData",
                "dataSrc": "",
            },
            "columns":[
                {"data":"employee_id"},
                {"data":"firstname"},
                {"data":"middlename"},
                {"data":"lastname"},
                {"data":"position"},
                {"data": "employee_id",
                    mRender: function (data, type, row) {
                    return '<button type="button" data-title="Edit Employee?" onclick=updateEmployees('+data+') class="btn rounded-0 btn-outline-secondary btn-sm py-2 px-3"><i class="bi bi-pencil-square"></i></button> <button type="button" data-title="Deactivate This?" onclick=deactivateEmployees('+data+') class="btn rounded-0 btn-outline-danger btn-sm py-2 px-3"><i class="bi bi-archive-fill"></i></button> <a href="printCompanyEmployee/'+data+'" class="btn rounded-0 btn-outline-primary btn-sm py-2 px-3" data-title="Print Recruiter?"><i class="bi bi-filetype-pdf"></i></a>'
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
// FETCH ACTIVE EMPLOYEES FOR TABLES

// FETCH INACTIVE EMPLOYEES FOR 
    function inactiveEmployeesTable(){
        var table = $('#inactiveEmployees').DataTable({
            "language": {
                "emptyTable": "No Inactive Recruiter"
            },
            "lengthChange": true,
            "scrollCollapse": true,
            "paging": true,
            "info": true,
            "responsive": true,
            "ordering": false,
            "aLengthMenu": [[25, 50, 75, -1], [25, 50, 75, "All"]],
            "iDisplayLength": 25,
            "ajax":{
                "url":"/getInactiveEmployees",
                "dataSrc": "",
            },
            "columns":[
                {"data":"employee_id"},
                {"data":"firstname"},
                {"data":"middlename"},
                {"data":"lastname"},
                {"data":"position"},
                {"data": "employee_id",
                    mRender: function (data, type, row) {
                    return '<button type="button" data-title="Edit Recruiter?" onclick=updateEmployees('+data+') class="btn rounded-0 btn-outline-secondary btn-sm px-3 py-2"><i class="bi bi-pencil-square"></i></button> <button data-title="Activate This?" type="button" onclick=activateEmployees('+data+') class="btn rounded-0 btn-outline-success btn-sm px-3 py-2"><i class="bi bi-person-check-fill"></i></button> <a href="printCompanyEmployees/'+data+'" class="btn rounded-0 btn-outline-primary btn-sm py-2 px-3" data-title="Print Recruiter?"><i class="bi bi-filetype-pdf"></i></a>'
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
// FETCH INACTIVE EMPLOYEES FOR TABLES

// FETCH DATA FOR UPDATE EMPLOYEES
    function updateEmployees(id){
        $('#updateEmployeesModal').modal('show')
        $.ajax({
            url: "/getCertainEmployee",
            type: 'GET',
            dataType: 'json',
            data: {employeesId: id},
        })
        .done(function(response) {
            $('#employeePhoto').attr("src", response.photos)
            $('#uniqueEmployeeId').val(response.employee_id)           
            $('#employeeId').val(response.companyId)           
            $('#employeeLastname').val(response.lastname)           
            $('#employeeFirstname').val(response.firstname)           
            $('#employeeMiddlename').val(response.middlename)          
            $('#employeePosition').val(response.position)           
            $('#employeeAge').val(response.age)           
            $('#employeeStatus').val(response.status)  
            $('#employeesSex').val(response.gender)           
            $('#employeeBirthday').val(response.birthday)           
            $('#employeeNationality').val(response.nationality)           
            $('#employeeReligion').val(response.religion)           
            $('#employeePnumber').val(response.phoneNumber)           
            $('#employeeAddress').val(response.address)           
            $('#employeeEmail').val(response.emailAddress)           
            $('#employeeUsername').val(response.username)           
            $('#employeePassword').val(response.password)   
            if(response.extention != ''){
                $('#employeeExt').val(response.extention)              
            }else{
                $('#employeeExt').val('none')              
            }        
        })
    }
// FETCH DATA FOR UPDATE EMPLOYEES

// DEACTIVATE ACCOUNT
    function deactivateEmployees(id){
        Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to DEACTIVATE this employee?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, DEACTIVATE it'
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
            url: '/deactivateEmployee',
            type: 'GET',
            dataType: 'json',
            data: {employee_id: id},
        });
        Swal.fire({
            title: 'Change Status',
            text: "employee was deactivate successfully",
            icon: 'success',
            showConfirmButton: false,
            timer: 1500,
        }).then((result) => {
        if (result) {
            $('#activeEmployees').DataTable().ajax.reload();
        }
        });
        }
        });
    } 
// DEACTIVATE ACCOUNT
    
// ACTIVATE ACCOUNT
    function activateEmployees(id){
        Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to ACTIVATE this employee?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, ACTIVATE it'
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
            url: '/activateEmployee',
            type: 'GET',
            dataType: 'json',
            data: {employee_id: id},
        });
        Swal.fire({
            title: 'Change Status',
            text: "employee was activate successfully",
            icon: 'success',
            showConfirmButton: false,
            timer: 1500,
        }).then((result) => {
        if (result) {
            $('#inactiveEmployees').DataTable().ajax.reload();
        }
        });
        }
        });
    } 
// ACTIVATE ACCOUNT

// UPDATE EMPLOYEES ACCOUNT
    $(document).ready(function () {
        $('#editEmployeeForm').on( 'submit' , function(e){
            e.preventDefault();
            var currentForm = $('#editEmployeeForm')[0];
            var data = new FormData(currentForm);
            $.ajax({
                url: "/updateEmployees",
                type:"POST",
                method:"POST",
                dataType: "text",
                data:data,
                cache: false,
                contentType: false,
                processData: false,
                success:function(response){
                    if(response == 1){
                        // OPERATION SUBMIT SUCCESSFULY
                        const input = document.getElementById("clearPhoto");
                        input.value = ""; 
                        $('#activeEmployees').DataTable().ajax.reload();
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'EMPLOYEE HAS BEEN UPDATED',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }else{
                        // SOMETHING WRONG IN BACKEND
                        Swal.fire(
                        'Added Failed',
                        'Sorry operation has not stored',
                        'error'
                        )
                    }
                },
                error:function(error){
                    console.log(error)
                }
            }) 
        });
    });
// UPDATE EMPLOYEES ACCOUNT

// ADD EMPLOYEES ACCOUNT
    $(document).ready(function () {
        $('#addEmployeeForm').on( 'submit' , function(e){
            e.preventDefault();
            var currentForm = $('#addEmployeeForm')[0];
            var data = new FormData(currentForm);
            $.ajax({
                url: "/addEmployee",
                type:"POST",
                method:"POST",
                dataType: "text",
                data:data,
                cache: false,
                contentType: false,
                processData: false,
                success:function(response){
                    if(response == 1){
                        // OPERATION SUBMIT SUCCESSFULY
                        $("#addEmployeeForm").trigger("reset");
                        $("#fileImport").trigger("reset");
                        $('#activeEmployees').DataTable().ajax.reload();
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'EMPLOYEE HAS BEEN UPDATED',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }else if(response == 2){
                        Swal.fire(
                        'Added Failed',
                        'Sorry, The employee ID is already exist',
                        'error'
                        )
                    }else if(response == 3){
                        Swal.fire(
                        'Added Failed',
                        'Sorry, The employee EMAIL is already exist',
                        'error'
                        )
                    }else{
                        // SOMETHING WRONG IN BACKEND
                        Swal.fire(
                        'Added Failed',
                        'Sorry employee has not stored',
                        'error'
                        )
                    }
                },
                error:function(error){
                    console.log(error)
                }
            }) 
        });
    });
// ADD EMPLOYEES ACCOUNT

// GENERATE AGE 
    function calculateAge() {
        var birthDate = new Date(document.getElementById("addEmployeeBirthday").value); 
        var birthDateDay = birthDate.getDate();
        var birthDateMonth = birthDate.getMonth();
        var birthDateYear = birthDate.getFullYear();

        var todayDate = new Date();
        var todayDay = todayDate.getDate();
        var todayMonth = todayDate.getMonth();
        var todayYear = todayDate.getFullYear();

        var calculateAge = 0;

        if(todayMonth > birthDateMonth) calculateAge  = todayYear - birthDateYear;
        else calculateAge = todayYear - birthDateYear - 1; 

        var outputValue = calculateAge;
        document.getElementById("addEmployeeAge").value = calculateAge;
    }
// GENERATE AGE 

// IMPORT EMPLOYEE
    $(document).ready(function () {
        $('#importEmployeeForm').on( 'submit' , function(e){
            e.preventDefault();
            var currentForm = $('#importEmployeeForm')[0];
            var data = new FormData(currentForm);
            $.ajax({
                url: "/employeesImport",
                type:"POST",
                method:"POST",
                dataType: "text",
                data:data,
                cache: false,
                contentType: false,
                processData: false,
                success:function(response){
                    if(response == 1){
                        // OPERATION SUBMIT SUCCESSFULY
                        $("#addEmployeeForm").trigger("reset");
                        $('#activeEmployees').DataTable().ajax.reload();
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'EMPLOYEE HAS BEEN STORED SUCCESSFULLY',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }else{
                        Swal.fire(
                        'Added Failed',
                        'Sorry, Something Happened',
                        'error'
                        )
                    }
                }
            });
        });
    });
// IMPORT EMPLOYEE

// FETCH ACTIVE EmployeeS FOR TABLES
    function currentlyUtilizing(){
        var table = $('#utilizing').DataTable({
            "language": {
                "emptyTable": "No Currently Active"
            },
            "lengthChange": true,
            "scrollCollapse": true,
            "paging": true,
            "info": true,
            "responsive": true,
            "ordering": false,
            "aLengthMenu": [[25, 50, 75, -1], [25, 50, 75, "All"]],
            "iDisplayLength": 25,
            "ajax":{
                "url":"/getEmpCurrentlyUtilizing",
                "dataSrc": "",
            },
            "columns":[
                {"data":"employee_id"},
                {"data":"companyId"},
                { 
                    data: {firstname : "firstname", lastname : "lastname", extention : "extention"},
                    mRender : function(data, type, full) {
                        if(data.extention == null){
                            return data.firstname+' '+data.lastname+' '; 
                        }else{
                            return data.firstname+' '+data.lastname+' '+data.extention; 
                        }
                    } 
                },
                {"data": "employee_id",
                    mRender: function (data, type, row) {
                    return '<button type="button" onclick=unUtilizedAccount('+data+') class="btn rounded-0 ROUNDED-0 btn-outline-primary btn-sm py-2 px-3" data-title="Unutilized Employees?"><i class="bi bi-person-bounding-box"></i></button>'
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
// FETCH ACTIVE EmployeeS FOR TABLES

// UNBLOCKED EmployeeS
    function unUtilizedAccount(id){
        Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to UNUTILIZED this Employee?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Continue'
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
            url: '/unutilizedEmployee',
            type: 'GET',
            dataType: 'json',
            data: {EmployeeId: id},
        });
        Swal.fire({
            title: 'Change Status',
            text: "Employee was UNUTILIZED successfully",
            icon: 'success',
            showConfirmButton: false,
            timer: 1500,
        }).then((result) => {
        if (result) {
            $('#utilizing').DataTable().ajax.reload();
        }
        });
        }
        });
    } 
// UNBLOCKED EmployeeS