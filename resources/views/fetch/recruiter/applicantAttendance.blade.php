<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>TARA NA</title>
</head>
<body>
    <div class="row">
        <div class="col-6 text-start">
            <h3 class="text-uppercase">{{$shipName}} | {{$shipCarry}}</h3>
            <p>From: {{date('F d, Y | h:i: A',strtotime($operationStart))}} <br>Until: {{date('F d, Y | h:i: A',strtotime($operationEnd))}}</p>
        </div>
        <div class="col-6 text-end">
            <p>Recruiter: {{$foreman}} <br> Slot: {{$slot}} Applicants</p>
        </div>
    </div>
    <table class='table table-bordered text-center align-middle'>
        <thead>
            <tr>
                <th scope='col'>#</th>
                <th scope='col'>Applicant</th>
                <th scope='col'>Role</th>
                <th scope='col'>Signature</th>
            </tr>
        </thead>
        <tbody>
        @foreach($data as $count => $certainData)
            {{$count = $count + 1;}}
            <tr>
                <td>{{$count}}</td>
                <td>{{$certainData->firstname}} {{$certainData->lastname}} {{$certainData->extention}}</td>
                <td>{{$certainData->position}}</td>
                <td></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>