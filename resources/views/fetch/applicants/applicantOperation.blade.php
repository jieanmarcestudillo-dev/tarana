@foreach ($data as $item)
    <div class='col-lg-6 col-sm-12 g-0 gx-lg-5 text-center text-lg-start'>
        <div class='card mb-3 shadow border-2 border rounded' style='width:100%'>
            <div class='row g-0'>
                    <img src='{{$item->photos}}' class='card-img-top img-thumdnail' style='height:230px; width:100%;'>
                <div class='col-md-12'>
                    <ul class='list-group list-group-flush fw-bold'>      
                        <li class='list-group-item'>
                            <div class='row'>
                                <div class='col-12 col-lg-6 ps-0 ps-lg-4'>
                                    Ship's Name: <span class='fw-normal'> {{$item->shipName}}</span>
                                </div>
                                <div class='col-12 col-lg-6 pt-2 pt-lg-0 ps-0 ps-lg-4'>
                                    Ship's Carry:<span class='fw-normal'> {{$item->shipCarry}}</span>
                                </div>
                            </div>
                        </li>
                        <li class='list-group-item'>
                            <div class='row'>
                                <div class='col-12 col-lg-6 ps-0 ps-lg-4'>
                                    Foreman: <span class='fw-normal'>{{$item->employees->firstname}} {{$item->employees->lastname}}  {{$item->employees->extention}}</span>                                                    
                                </div>
                                <div class='col-12 col-lg-6 pt-2 pt-lg-0 ps-0 ps-lg-4'>
                                    Available Slot:<span class='fw-normal'> {{$item->slot}} Applicants</span>
                                </div>
                            </div>
                        </li>
                        <li class='list-group-item fw-bold' style='color:#'>    
                            <div class='row'>
                                <div class='col-12 col-lg-6 pt-2 pt-lg-0 ps-0 ps-lg-4'>
                                    <p class='fw-bold text-success'>Operation Start:</p>
                                    <a class='fw-bold text-dark nav-link' style="margin-top:-13px;">Date: <span class='fw-normal'>{{date('F d, Y',strtotime($item->operationStart))}}</span></a>
                                    <a class='fw-bold text-dark nav-link'>Time: <span class='fw-normal'>{{date('D | h:i: A ',strtotime($item->operationStart))}} </span></a>
                                </div>
                                <div class='col-12 col-lg-6 pt-2 pt-lg-0 ps-0 ps-lg-4'>
                                    <p class='fw-bold text-danger'>Operation End:</p>
                                    <a class='fw-bold text-dark nav-link' style="margin-top:-13px;">Date: <span class='fw-normal'>{{date('F d, Y',strtotime($item->operationEnd))}}</span></a>
                                    <a class='fw-bold text-dark nav-link'>Time: <span class='fw-normal'>{{date('D | h:i: A ',strtotime($item->operationEnd))}}</span></a>
                                </div>
                            </div>
                        </li>
                        <li class='list-group-item text-center text-lg-end'>
                            
                            @foreach($item->applicants as $perAplicant)
                                <a>{{$perAplicant->applicant_id}}</a>
                            @endforeach 
                            {{-- @if($item->applicants == 0)
                            @else
                                <a>none</a>
                            @endif --}}
                            {{-- @foreach($item->applicants as $perAplicant)
                                @if($perAplicant->applicant_id  != '') --}}
                                    {{-- @if($perAplicant->pivot->is_recommend == 1 && $perAplicant->pivot->is_recruited == 0)
                                        <button onclick="acceptInvitation('{{$item->certainOperation_id}}')" class='btn btn-sm btn-success px-4 py-2'>Accept</button>
                                        <button onclick="operationDetails('{{$item->certaincertainOperation_id}}')" class='btn btn-sm btn-secondary px-4 py-2'>Details</button>
                                        <button onclick="declineInvitation('{{$item->certainOperation_id}}')" class='btn btn-sm btn-danger px-4 py-2'>Decline</button>
                                    @elseif($perAplicant->pivot->is_recommend == 1 && $perAplicant->pivot->is_recruited == 1)
                                        <button onclick="operationDetails('{{$item->certainOperation_id}}')" class='btn btn-sm btn-secondary px-4 py-2'>Details</button>
                                        <button onclick="backOutOperation('{{$item->operation_id}}')" class='btn btn-sm btn-danger px-4 py-2'>Back Out</button></li>
                                    @elseif($perAplicant->pivot->is_recommend == 0 && $perAplicant->pivot->is_recruited == 1)
                                        <button onclick="operationDetails('{{$item->certainOperation_id}}')" class='btn btn-sm btn-secondary px-4 py-2'>Details</button>
                                        <button onclick="backOutOperation('{{$item->certainOperation_id}}')" class='btn btn-sm btn-danger px-4 py-2'>Back Out</button></li>
                                    @else
                                        <button type='button' onclick="cancelApplied('{{$item->certainOperation_id}}')" class='btn btn-sm btn-danger px-4 py-2'>Cancel Apply</button>
                                    @endif --}}
                                {{-- @else
                                    <button type='button' id='taraNaBtn' onclick="taraNaBtn('{{$item->certainOperation_id}}')" class='btn btn-sm btn-primary px-4 py-2'>Apply</button>
                                @endif
                            @endforeach --}}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endforeach