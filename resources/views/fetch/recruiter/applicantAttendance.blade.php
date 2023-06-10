<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Attendance</title>
    <style>
        body {
         font-family: Arial, sans-serif;
       }

       .header {
         text-align: center;
         margin-bottom: 20px;
       }

       .name {
         font-size: 24px;
         font-weight: bold;
       }

       .contact-info {
         font-size: 14px;
         margin-bottom: 10px;
       }

       .section {
         margin-bottom: 20px;
       }

       .section-title {
         font-size: 18px;
         font-weight: bold;
         margin-bottom: 10px;
       }

       .subsection-title {
         font-size: 16px;
         font-weight: bold;
         margin-bottom: 10px;
       }

       .item {
         margin-bottom: 5px;
       }

       .item-title {
         font-weight: bold;
         display: inline-block;
         width: 160px;
       }

       .item-content {
         display: inline-block;
       }
   </style>
</head>
<body>
    <div class="header">
        <div class="name">Operation Details</div>
      <div class="contact-info">Subic Consolidated Projects, Inc.</div>
    </div>
    </div>
    <div class="section">
      <div class="section-title">Operation Summary</div>
        <div class="item">
            <span class="item-title">Operation Id:</span>
            <span class="item-content">{{$operationId}}</span>
        </div>
        <div class="item">
            <span class="item-title">Ship Name:</span>
            <span class="item-content">{{$shipName}}</span>
        </div>
        <div class="item">
            <span class="item-title">Ship Carry:</span>
            <span class="item-content">{{$shipCarry}}</span>
        </div>
        <div class="item">
            <span class="item-title">Workers Needed:</span>
            <span class="item-content">{{$totalWorkers}} Total</span>
        </div>
        <div class="item">
            <span class="item-title">Workers Participate:</span>
            <span class="item-content">{{$totalWorkers - $slot}} Total</span>
        </div>
    </div>
    <div class="section">
      <div class="section-title">Date of Operation</div>
      <div class="item">
        <span class="item-title">Operation Start:</span>
        <span class="item-content">{{date('F j, Y | g:i a',strtotime($operationStart))}}</span>
      </div>
      <div class="item">
          <span class="item-title">Operation End:</span>
          <span class="item-content">{{date('F j, Y | g:i a',strtotime($operationEnd))}}</span>
        </div>
    </div>
    <div class="section">
        <div class="section-title">Project Workers Attendance</div>
    </div>
    <table class='table table-bordered text-center align-middle'>
        <thead>
            <tr>
                <th scope='col'>No.</th>
                <th scope='col'>Project Workers</th>
                <th scope='col'>Age</th>
                <th scope='col'>Signature</th>
            </tr>
        </thead>
        <tbody>
          @foreach($data as $count => $certainData)
          {{$count = $count + 1}}
            <tr>
                <td>{{$count}}.</td>
                <td>{{$certainData->firstname}} {{$certainData->lastname}} {{$certainData->extention}}</td>
                <td>{{$certainData->age}} years old </td>
                <td></td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
