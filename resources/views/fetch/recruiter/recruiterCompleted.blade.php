@foreach($data as $certainData)
@if($data != '')
    <div class='card mb-3 shadow round'>
        <div class='row g-0'>
        <div class='col-md-3'>
            <img src='{{$certainData->photos}}' class='card-img-top img-fluid img-thumdnail' style='height: 100%; width:100%;'>
        </div>                            
        <div class='col-md-3'>
            <div class='card-body'>
                <ul class='list-group list-group-flush'>
                    <li class='list-group-item fw-bold'>Ship's Name:<a class='fw-normal text-dark' style='text-decoration:none;'> {{$certainData->shipName}}</a></li>
                    <li class='list-group-item fw-bold'>Ship's Carry:<a class='fw-normal text-dark' style='text-decoration:none;'> {{$certainData->shipCarry}}</a></li>
                    <li class='list-group-item fw-bold'>Operation Start: </br>
                        <a class='fw-normal nav-link'>Date: <span>{{date('F d, Y | D',strtotime($certainData->operationStart));}}</span></br></a>
                        <a class='fw-normal nav-link'>Time: <span>{{date('h:i: A ',strtotime($certainData->operationStart));}}</span></a>
                    </li>
                    <li class='list-group-item fw-bold'>Operation End: </br>
                        <a class='fw-normal nav-link'>Date: <span>{{date('F d, Y | D',strtotime($certainData->operationEnd));}}</span></br></a>
                        <a class='fw-normal nav-link'>Time: <span>{{date('h:i: A ',strtotime($certainData->operationEnd));}}</span></a>
                    </li>
                </ul>
            </div>
        </div> 
        <div class='col-md-6'>
            <div class='card-body' style='height:280px; overflow-y:auto;'>
            <h5 class='card-title'>Applicants Participated</h5>
            @if($certainData->applicants != '')
                <table class='table table-bordered table-striped text-center align-middle'>
                    <thead>
                        <tr>
                            <th scope='col'>#</th>
                            <th scope='col'>Applicant</th>
                            <th scope='col'>Role</th>
                            <th scope='col'>Details</th>
                        </tr>
                    </thead>
                    @foreach($certainData->applicants as  $perAplicant)
                    <tbody>
                        <tr>
                            <td>{{$perAplicant->applicant_id}}</td>
                            <td>{{$perAplicant->firstname}} {{$perAplicant->lastname}} {{$perAplicant->extention}}</td>
                            <td>{{$perAplicant->position}}</td>
                            <td><button type='button' onclick="applicantsDetails('{{$perAplicant->applicant_id}}')" class='btn btn-outline-secondary btn-sm'>View</button></td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            @else
            <h5>hello world</h5>
            @endif
            </div>
        </div>
        </div>
    </div>  
    @else 
@endif
@endforeach