@if($data->isNotEmpty())
@foreach ($data as $item)
    <div class='col-6'>
        <div class='card mb-3 shadow border-2 border rounded-top'>
            <div class='row g-0'>
                <div class='col-md-6'>
                    <img src='{{$item->photos}}' class='card-img-top img-thumdnail' style='height: 100%; width:100%;'>
                </div>
                <div class='col-md-6'>
                    <ul class='list-group list-group-flush'>
                        <li class='list-group-item fw-bold' style='color:#'>Ship's Name: <a class='fw-normal text-decoration-none text-dark'>{{$item->shipName}}</a></li>
                        <li class='list-group-item fw-bold' style='color:#'>Ship's Carry: <a class='fw-normal text-decoration-none text-dark'>{{$item->shipCarry}}</a></li>
                        <li class='list-group-item fw-bold' style='color:#'>Operation Start: </br>
                            <a class='fw-normal nav-link'>Date: {{date('F d, Y | D',strtotime($item->operationStart))}} </br></a>
                            <a class='fw-normal nav-link'>Time:  {{date('h:i: A ',strtotime($item->operationStart))}} </a>
                        </li>
                        <li class='list-group-item fw-bold' style='color:#'>Operation End: </br>
                            <a class='fw-normal nav-link'>Date: {{date('F d, Y | D',strtotime($item->operationEnd))}}</br></a>
                            <a class='fw-normal nav-link'>Time: {{date('h:i: A ',strtotime($item->operationEnd))}}</a>
                        </li>
                        <li class='list-group-item fw-bold'>Available: <span class='fw-normal'>{{$item->slot}} Slot out of {{$item->totalWorkers}} Total</span> 
                    
                            <br> <span class='fw-bold'>Applicants: <span class='fw-normal'>{{count($item->applicants)}} Total</span></li>
                        <li class='list-group-item text-end'></span>
                            <a type='button' onclick="recruitApplicantsRoutes('{{$item->certainOperation_id}}')" class='btn btn-sm text-danger btn-link text-end'>View Applicants</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endforeach
@else
<h5 class='fs-5 text-center' style='color:#800000; margin-top:16.5rem;'>NO SCHEDULED FOUND</h5>
@endif