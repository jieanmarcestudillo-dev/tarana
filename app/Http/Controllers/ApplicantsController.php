<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Redirect;
use App\Models\applicants;
use App\Models\operations;
use App\Models\applied;
use App\Models\declined;
use App\Models\backout;
use App\Models\completed;
use App\Models\blockedApplicants;
use Auth;
use Session;
use Hash;

class ApplicantsController extends Controller
{
            public function applicantsAuthentication(){
                return view('applicantAuth');
            }
            public function applicantSignUp(){
                return view('applicantSignUp');
            }
            public function forgotPasswordRoutes(){
                return view('forgotPassword');
            }

            protected function applicantCredentials(Request $request){
                return [
                    'emailAddress' => request()->{$this->applicantEmail()},
                    'password' => request()->applicantPassword,
                ];
            }
            protected function applicantEmail(){
                return 'applicantEmail';
            }

                public function applicantLoginFunction(Request $request){
                    if(auth()->guard('applicantsModel')->attempt($this->applicantCredentials($request))){
                        if(auth()->guard('applicantsModel')->user()->is_blocked != 1){
                            if(auth()->guard('applicantsModel')->user()->is_active != 0 ){
                                if(auth()->guard('applicantsModel')->user()->is_utilized == 0){
                                    $updateUtilized = applicants::where('applicant_id', '=', auth()->guard('applicantsModel')->user()->applicant_id)
                                    ->update(['is_utilized' => '1']);
                                    if($updateUtilized){
                                        $request->session()->regenerate();
                                        return response()->json(1);
                                    }
                                }else{
                                    return response()->json(3);
                                }
                            }else{
                                return response()->json(2);
                            }
                        }else{
                            $data = blockedApplicants::where([['applicantId', '=', auth()->guard('applicantsModel')->user()->applicant_id],
                            ['is_archived', '!=', '1']])->first('reason');
                            return response()->json($data);
                        }
                    }else{
                        return response()->json(0);
                    }
                }

                public function applicantSignUpFunction(Request $request){
                    $existingEmail = applicants::select('emailAddress')->where('emailAddress','=',$request->email)->get();
                    if($existingEmail->isNotEmpty()){
                    }else{
                        $applicantData = [
                            'photos' => '/storage/applicants/defaultImage.png',
                            'emailAddress' => $request->email,
                            'password' => Hash::make($request->password),
                            'is_pro' => $request->isPro,
                            'is_active' => 1,
                            'is_blocked' => 0,
                            'is_utilized' => 0,
                            'personal_id' => '/storage/applicant_Id/noId.jpg',
                            'personal_id2' => '/storage/applicant_Id/noId.jpg'
                        ];

                        $applicant = Applicants::create($applicantData);

                        if (auth()->guard('applicantsModel')->  loginUsingId($applicant->applicant_id, TRUE)) {
                            $request->session()->regenerate();
                            return response()->json(1);
                        } else {
                            return response()->json(0);
                        }
                    }
                }


            public function applicantLogout(){
                $update = applicants::where('applicant_id', auth()->guard('applicantsModel')->user()->applicant_id)
                ->update(array('is_utilized' => 0));
                if($update){
                    Session::flush();
                    Auth::logout();
                    return response()->json(1);
                }
            }

            public function forgotPassword(Request $request){
                $data = applicants::where('emailAddress', '=', $request->applicantEmail)->first();
                if($data != '' ){
                    return response()->json(1);
                }else{
                    return response()->json(0);
                }
            }

            public function applicantDashboardRoutes(){
                return view('applicants/dashboard');
            }

                public function totalUpcomingOperationForApp(Request $request){
                    $date = date('Y-m-d H:i:s', strtotime("+1 hours", strtotime(now())));
                    $data = operations::where([['is_completed', '=', 0],[ 'is_archived' , '=' ,0],['operationEnd','>',$date]])->get();
                    $countData = $data->count();
                    return response()->json($countData != '' ? $countData : '0');
                }

                public function totalInvitationOperationForApp(Request $request){
                    $data = applied::where([
                    ['applicants_id', '=', auth()->guard('applicantsModel')->user()->applicant_id],
                    ['is_recommend', '=' ,1],['is_recruited', '!=', 1]])->get();
                    $countData = $data->count();
                    return response()->json($countData != '' ? $countData : '0');
                }

               public function totalScheduledOperationForApp(Request $request){
                    $data = applied::where([
                    ['applicants_id', '=', auth()->guard('applicantsModel')->user()->applicant_id],
                    ['is_recruited', '=', 1]])->get();
                    $countData = $data->count();
                    return response()->json($countData != '' ? $countData : '0');
                }

                public function applicantInvitationForApp(Request $request){
                    $data = applied::join('operations', 'applied.operation_id', '=', 'operations.certainOperation_id')
                    ->join('employees', 'applied.recruiter', '=', 'employees.employee_id')
                    ->where([['applied.applicants_id', '=', auth()->guard('applicantsModel')->user()->applicant_id],
                    ['applied.is_recommend', '=', 1],['applied.is_recruited', '!=' ,1],['applied.is_recommend', '=', 1],
                    ['applied.is_recruited', '!=', 1]])->get();
                    if($data->isNotEmpty()){
                        foreach($data as $certainData){
                            $applicant = auth()->guard('applicantsModel')->user()->firstname.' '.
                            auth()->guard('applicantsModel')->user()->lastname.' '.auth()->guard('applicantsModel')->user()->extention;
                            $newOperationStartDate = date('F d, Y | h:i: A',strtotime($certainData->operationStart));
                            $newOperationEndDate = date('F d, Y | h:i: A',strtotime($certainData->operationEnd));
                            echo "
                            <div class='col-12'>
                                <div class='card mb-2 shadow'>
                                    <div class='card-body'>
                                        <h5 class='card-title'>Dear $applicant,</h5>
                                        <p class='card-text mb-3'>$certainData->firstname $certainData->lastname (one of the manpower pooling) invites you to join the operation
                                        <span class='fw-bold'>from $newOperationStartDate to $newOperationEndDate</span> to handle the $certainData->shipCarry
                                        of the $certainData->shipName Cargo Ship. If you are insterested in working at
                                        Subic Consolidated Project Inc., please respond to our invitation to notify the manpower pooling.
                                        Thank you, and God bless the Project Workers.</p>
                                            <button onclick=acceptInvitation('$certainData->operation_id') class='btn btn-success btn-sm'>Accept</button>
                                            <button onclick='declineInvitation($certainData->certainOperation_id, $certainData->recruiter)' class='btn btn-danger btn-sm'>Decline</button>
                                    </div>
                                </div>
                            </div>
                            ";
                        }
                    }else{
                        echo "
                            <H5 class='mx-auto my-5 py-5' style='color:#800000;'>NO INVITATION FOUND</H5>
                        ";
                    }
                }

            public function upcomingOperationRoutes(){
                return view('applicants/operations');
            }

                public function applicantOperation(Request $request){
                    $date = date('Y-m-d H:i:s', strtotime("+1 hours", strtotime(now())));
                    $data = operations::where([['is_completed', '=', 0],[ 'is_archived' , '=' ,0],['operationEnd','>=',$date]
                    ])->orderBy('operationStart')->with('applicants')->get();
                    if($data->isNotEmpty()){
                        foreach($data as $item){
                            $operationStartDate = date('F d, Y',strtotime($item->operationStart));
                            $operationStartTime = date('D | h:i: A ',strtotime($item->operationStart));
                            $operationEndDate = date('F d, Y',strtotime($item->operationEnd));
                            $operationEndTime = date('D | h:i: A ',strtotime($item->operationEnd));
                            echo"
                            <div class='col-lg-6 col-sm-12 g-0 gx-lg-5 text-center text-lg-start'>
                            <div class='card mb-3 shadow border-2 border rounded' style='width:100%'>
                                <div class='row g-0'>
                                    <img loading='lazy' src='$item->photos' class='card-img-top img-thumdnail' style='height:230px; width:100%;' alt='ship'>
                                    <div class='col-md-12'>
                                        <ul class='list-group list-group-flush fw-bold'>
                                            <li class='list-group-item'>
                                                <div class='row'>
                                                    <div class='col-12 col-lg-6 ps-0 ps-lg-4'>
                                                        Ship's Name: <span class='fw-normal'> $item->shipName</span>
                                                    </div>
                                                    <div class='col-12 col-lg-6 pt-2 pt-lg-0 ps-0 ps-lg-4'>
                                                        Ship's Carry:<span class='fw-normal'> $item->shipCarry</span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class='list-group-item'>
                                                <div class='row'>
                                                    <div class='col-12 col-lg-6 ps-0 ps-lg-4'>
                                                        Total Workers: <span class='fw-normal'>$item->totalWorkers Total</span>
                                                    </div>
                                                    <div class='col-12 col-lg-6 pt-2 pt-lg-0 ps-0 ps-lg-4'>
                                                        Available Slot:<span class='fw-normal'> $item->slot Total</span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class='list-group-item fw-bold' style='color:#'>
                                                <div class='row'>
                                                    <div class='col-12 col-lg-6 pt-2 pt-lg-0 ps-0 ps-lg-4'>
                                                        <p class='fw-bold text-success'>Operation Start:</p>
                                                        <a class='fw-bold text-dark nav-link' style='margin-top:-13px;'>Date: <span class='fw-normal'>$operationStartDate</span></a>
                                                        <a class='fw-bold text-dark nav-link'>Time: <span class='fw-normal'>$operationStartTime</span></a>
                                                    </div>
                                                    <div class='col-12 col-lg-6 pt-2 pt-lg-0 ps-0 ps-lg-4'>
                                                        <p class='fw-bold text-danger'>Operation End:</p>
                                                        <a class='fw-bold text-dark nav-link' style='margin-top:-13px;'>Date: <span class='fw-normal'>$operationEndDate</span></a>
                                                        <a class='fw-bold text-dark nav-link'>Time: <span class='fw-normal'>$operationEndTime</span></a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class='list-group-item text-center text-lg-end'>";
                                        $checkStatus = applied::where([['applicants_id', '=', auth()->guard('applicantsModel')->user()->applicant_id],
                                        ['operation_id' ,'=', $item->certainOperation_id]])->get();
                                        if(!$checkStatus->isEmpty()){
                                            foreach($checkStatus as $appliedData){
                                                if($appliedData != ''){
                                                        if($appliedData->is_recommend == 1 && $appliedData->is_recruited == 0){
                                                            echo"
                                                                <button onclick=acceptInvitation('$appliedData->operation_id') class='btn btn-sm btn-success px-4 py-2'>Accept</button>
                                                                <button onclick='declineInvitation($item->certainOperation_id, $appliedData->recruiter)' class='btn btn-sm btn-danger px-4 py-2'>Decline</button>
                                                            ";
                                                        }else if($appliedData->is_recommend == 1 && $appliedData->is_recruited == 1){
                                                            echo"
                                                                <button onclick='backOutOperation($item->certainOperation_id, $appliedData->recruiter)' class='btn btn-sm btn-danger px-4 py-2'>Back Out</button>
                                                            ";
                                                        }else if($appliedData->is_recommend == 0 && $appliedData->is_recruited == 1){
                                                            echo"
                                                                <button onclick='backOutOperation($item->certainOperation_id, $appliedData->recruiter)' class='btn btn-sm btn-danger px-4 py-2'>Back Out</button>
                                                            ";
                                                        }else{
                                                            echo"
                                                                <button type='button' onclick=cancelApplied('$appliedData->applied_id') class='btn btn-sm btn-danger px-4 py-2'>Cancel Apply</button>
                                                            ";
                                                        }
                                                }else{
                                                    echo"
                                                        <button type='button' id='taraNaBtn' onclick=taraNaBtn('$item->certainOperation_id') class='btn btn-sm btn-primary px-4 py-2'>APPLY</button>
                                                    ";
                                                }
                                            }
                                        }else{
                                            echo"
                                                <button type='button' id='taraNaBtn' onclick=taraNaBtn('$item->certainOperation_id') class='btn btn-sm btn-primary px-4 py-2'>APPLY</button>
                                            ";
                                        }
                                        echo"</li></ul>
                                    </div>
                                </div>
                            </div>
                            </div>";
                        }
                    }else{
                        echo "
                        <div class='row applicantNoSched' style='margin-top:15rem; color: #800000;'>
                            <div class='alert alert-light text-center fs-4' role='alert' style='color: #800000;'>
                                NO OPERATION YET
                            </div>
                        </div>
                        ";
                    }
                }

                public function applicantApply(Request $request){
                    $applicantId =  auth()->guard('applicantsModel')->user()->applicant_id;
                    $operationId = $request->operationId;
                    $applicantsData = applicants::where([['applicant_id', '=', $applicantId]])->first();
                    if($applicantsData->lastname == "" || $applicantsData->personal_id == ""){
                        exit();
                    }else{
                        $operationsData = operations::where([['certainOperation_id', '=', $operationId]])->select('operationStart')->first();
                        $applyingData = applied::join('operations', 'applied.operation_id', '=', 'operations.certainOperation_id')
                        ->where([['applied.applicants_id', '=' ,$applicantId],['applied.is_recruited','=',1],
                        ['operations.operationStart','=', $operationsData->operationStart]])->orderBy('applied.applied_id', 'asc')->get();
                        if($applyingData->isNotEmpty()){
                            exit();
                        }else{
                            $applicationApply = applied::create([
                                'operation_id' => $operationId,
                                'applicants_id' => $applicantId,
                                'is_recruited' => 0,
                                'is_recommend' => 0,
                                'recruiter' => 0,
                                'date_time_applied' => now(),
                            ]);
                            if($applicationApply){
                                return response()->json(1);
                                exit();
                            }else{
                                return response()->json(0);
                                exit();
                            }
                        }
                    }
                }

                public function cancelApply(Request $request){
                    $cancelApplied = applied::where([['applied_id', '=', $request->appliedId]])->delete();
                    return response()->json($cancelApplied  ? 1 : 0);
                }

                public function declinedInvitation(Request $request){
                    $addDeclined = declined::create([
                        'operation_id' => $request->operationId,
                        'applicant_id' => auth()->guard('applicantsModel')->user()->applicant_id,
                        'recruiter_id' => $request->recruiterId,
                        'reason' => $request->reason,
                        'date_time_declined' => now(),
                        'is_archived' => 0,
                    ]);
                    if($addDeclined){
                        $cancelApplied = applied::where([['operation_id', '=', $request->operationId],['applicants_id', '=', auth()->guard('applicantsModel')->user()->applicant_id],
                        ['is_recommend', '=', 1]])->delete();
                        if($cancelApplied){
                            $updateSlot = operations::find($request->operationId)->increment('slot');
                            return response()->json($updateSlot ? 1 : 0);
                        }
                    }
                }

                public function backOutOperation(Request $request){
                    $addBackout = backout::create([
                        'operation_id' => $request->operationId,
                        'applicant_id' => auth()->guard('applicantsModel')->user()->applicant_id,
                        'recruiter_id' => $request->recruiterId,
                        'reason' => $request->reason,
                        'date_time_backOut' => now(),
                        'is_archived' => 0,
                    ]);
                    if($addBackout){
                        $cancelApplied = applied::where([['operation_id', '=', $request->operationId],['applicants_id', '=', auth()->guard('applicantsModel')->user()->applicant_id]])->delete();
                        if($cancelApplied){
                            $updateSlot = operations::find($request->operationId)->increment('slot');
                            return response()->json($updateSlot ? 1 : 0);
                        }
                    }
                }

                public function acceptInvitation(Request $request){
                    $operationId = $request->operationId;
                    $applicantId = auth()->guard('applicantsModel')->user()->applicant_id;
                    $acceptInvitation = applied::where([['operation_id','=',$operationId],
                    ['applicants_id','=',$applicantId]])->update(['is_recruited'=> 1]);
                    if($acceptInvitation){
                        $updateSlot = operations::find($operationId)->decrement('slot');
                        return response()->json($updateSlot ? 1 : 0);
                    }
                }

                public function coWorkers(Request $request){
                    $applicantId = auth()->guard('applicantsModel')->user()->applicant_id;
                    $coWorkersDetails = applied::
                    join('operations', 'applied.operation_id', '=', 'operations.certainOperation_id')
                   ->join('applicants', 'applied.applicants_id', '=', 'applicants.applicant_id')
                   ->where([['applied.operation_id', '=' ,$request->operationId],['operations.certainOperation_id','=',
                   $request->operationId],['applied.applicants_id', '!=' ,$applicantId],
                   ['applicants.applicant_id', '!=', $applicantId],['applied.is_recruited', '=', 1]])
                   ->get(['applicants.lastname','applicants.firstname','applicants.extention','applicants.phoneNumber',
                   'applicants.age']);
                   if($coWorkersDetails->isNotEmpty()){
                            echo"<table class='table text-center align-middle table-bordered'>
                            <thead>
                              <tr>
                                <th class='col-1'>#</th>
                                <th class='col-5'>Applicant</th>
                                <th class='col-2'>Age</th>
                                <th class='col-4'>Phone Number</th>
                              </tr>
                            </thead><tbody>";
                       foreach($coWorkersDetails as $count => $applicantInfo){
                        $perWorkers = $count + 1;
                        echo "
                        <tr>
                        <td>$perWorkers</td>
                            <td>$applicantInfo->firstname $applicantInfo->lastname $applicantInfo->extention</td>
                            <td>$applicantInfo->age</td>
                            <td>$applicantInfo->phoneNumber</td>
                        </tr>
                        ";}
                            echo"
                            </tbody>
                          </table>
                            ";
                   }else{
                        echo"
                            <p class='text-uppercase text-center' style='color: #800008;'>No Co-Workers Found</p>
                        ";
                   }
                }

            public function applicationScheduleRoutes(){
                return view('applicants/scheduled');
            }

            public function applicantScheduled(Request $request){
                $applicantScheduled = applied::
                 join('operations', 'applied.operation_id', '=', 'operations.certainOperation_id')
                ->join('employees', 'applied.recruiter', '=', 'employees.employee_id')
                ->where([['applied.applicants_id', '=', auth()->guard('applicantsModel')->user()->applicant_id],
                ['applied.is_recruited', '=', 1],['operations.is_completed', '!=', 1]
                ])->get(['applied.*','employees.employee_id','employees.lastname','employees.firstname','employees.extention',
                'operations.*']);
                if($applicantScheduled->isNotEmpty()){
                    foreach($applicantScheduled as $certainData){
                        $operationStartDate = date('F d, Y',strtotime($certainData->operationStart));
                        $operationStartTime = date('D | h:i: A ',strtotime($certainData->operationStart));
                        $operationEndDate = date('F d, Y',strtotime($certainData->operationEnd));
                        $operationEndTime = date('D | h:i: A ',strtotime($certainData->operationEnd));
                        $recruiter = $certainData->firstname.' '.$certainData->lastname.' '.$certainData->extention;
                        $coWorkers = $certainData->totalWorkers - 1;
                        echo"
                            <div class='col-lg-6 col-sm-12 text-center text-lg-start gy-3'>
                                <div class='card shadow-lg'>
                                    <img loading='lazy' src='$certainData->photos' class='card-img-top img-fluid' style='height:230px; width:100%;'>
                                    <ul class='list-group list-group-flush fw-bold'>
                                        <li class='list-group-item'>
                                            <div class='row'>
                                                <div class='col-12 col-lg-6 ps-0 ps-lg-4'>
                                                    Ship's Name: <span class='fw-normal'> $certainData->shipName</span>
                                                </div>
                                                <div class='col-12 col-lg-6 pt-2 pt-lg-0 ps-0 ps-lg-4'>
                                                    Ship's Carry:<span class='fw-normal'> $certainData->shipCarry</span>
                                                </div>
                                            </div>
                                        </li>
                                        <li class='list-group-item'>
                                            <div class='row'>
                                                <div class='col-12 col-lg-6 ps-0 ps-lg-4'>
                                                    Accepted By: <span class='fw-normal'>$recruiter</span>
                                                </div>
                                                <div class='col-12 col-lg-6 pt-2 pt-lg-0 ps-0 ps-lg-4'>
                                                    Co-Workers:<span class='fw-normal'> $coWorkers Total</span>
                                                </div>
                                            </div>
                                        </li>
                                        <li class='list-group-item fw-bold' style='color:#'>
                                            <div class='row'>
                                                <div class='col-12 col-lg-6 pt-2 pt-lg-0 ps-0 ps-lg-4'>
                                                    <p class='fw-bold text-success'>Operation Start:</p>
                                                    <a class='fw-bold text-dark nav-link' style='margin-top:-13px;'>Date: <span class='fw-normal'>$operationStartDate</span></a>
                                                    <a class='fw-bold text-dark nav-link'>Time: <span class='fw-normal'>$operationStartTime</span></a>
                                                </div>
                                                <div class='col-12 col-lg-6 pt-2 pt-lg-0 ps-0 ps-lg-4'>
                                                    <p class='fw-bold text-danger'>Operation End:</p>
                                                    <a class='fw-bold text-dark nav-link' style='margin-top:-13px;'>Date: <span class='fw-normal'>$operationEndDate</span></a>
                                                    <a class='fw-bold text-dark nav-link'>Time: <span class='fw-normal'>$operationEndTime</span></a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class='list-group-item text-center text-lg-end'>
                                            <button onclick='backOutOperation($certainData->certainOperation_id, $certainData->recruiter)' class='btn btn-sm btn-danger px-4 py-2'>Back Out</button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        ";
                    }
                }else{
                    echo "
                    <div class='row applicantNoSched' style='margin-top:15rem; color: #800000;'>
                        <div class='alert alert-light text-center fs-4' role='alert' style='color: #800000;'>
                            NO SCHEDULED YET
                        </div>
                    </div>
                    ";
                }
            }

            public function applicantCompletedRoutes(){
                return view('applicants/completed');
            }

            public function applicantCompletedOperation(Request $request){
                $data = completed::join('operations', 'completed.operation_id', '=', 'operations.certainOperation_id')
                ->join('employees', 'employees.employee_id', '=', 'completed.recruiter_id')
                ->where('completed.applicant_id', '=', auth()->guard('applicantsModel')->user()->applicant_id)
                ->get(['operations.*', 'employees.lastname', 'employees.firstname', 'employees.extention']);
                return response()->json($data);
            }

            public function applicantAccountRoutes(){
                return view('applicants/account');
            }

            public function applicantCredentialsRoutes(){
                return view('applicants/applicantCredentials');
            }

                public function getApplicantData(Request $request){
                    $data = applicants::where([['applicant_id', '=', auth()->guard('applicantsModel')->user()->applicant_id]])->get();
                    return response()->json($data);
                }

                public function editApplicantInfo(Request $request){
                    $data = applicants::select('emailAddress')->where('applicant_id', $request->appId)->get();
                    foreach($data as $certainData){
                        $certainData->emailAddress;
                    }
                    if($certainData->emailAddress = $request->emailAddress){
                    }else{
                        if ($request->hasFile('appPhotos')) {
                                $filename = $request->file('appPhotos');
                                $imageName =   time().rand() . '.' .  $filename->getClientOriginalExtension();
                                $path = $request->file('appPhotos')->storeAs('applicants', $imageName, 'public');
                                $imageData['appPhotos'] = '/storage/'.$path;
                                    $update = applicants::find($request->appId);
                                    $update->photos=$imageData['appPhotos'];
                                    $update->lastname=$request->input('appLastName');
                                    $update->firstname=$request->input('appFirstName');
                                    $update->middlename=$request->input('appMiddleName');
                                    $update->extention = $request->input('appExtention');
                                    $update->Gender=$request->input('appGender');
                                    $update->status=$request->input('appStatus');
                                    $update->age=$request->input('appAge');
                                    $update->birthday=$request->input('appBirthday');
                                    $update->address=$request->input('appAddress');
                                    $update->phoneNumber=$request->input('appPhoneNumber');
                                    $update->emailAddress=$request->input('appEmail');
                                    $update->phoneNumber=$request->input('appPhoneNumber');
                                    $update->save();
                                    if($update){
                                        return response()->json(1);
                                    }
                        }else{
                                    $update = applicants::find($request->appId);
                                    $update->lastname=$request->input('appLastName');
                                    $update->firstname=$request->input('appFirstName');
                                    $update->middlename=$request->input('appMiddleName');
                                    $update->extention = $request->input('appExtention');
                                    $update->Gender=$request->input('appGender');
                                    $update->status=$request->input('appStatus');
                                    $update->age=$request->input('appAge');
                                    $update->birthday=$request->input('appBirthday');
                                    $update->address=$request->input('appAddress');
                                    $update->phoneNumber=$request->input('appPhoneNumber');
                                    $update->emailAddress=$request->input('appEmail');
                                    $update->phoneNumber=$request->input('appPhoneNumber');
                                    $update->save();
                                    if($update){
                                        return response()->json(1);
                                    }
                        }
                    }
                }

                public function submitApplicantId(Request $request){
                    $applicantId = auth()->guard('applicantsModel')->user()->applicant_id;
                    if(!$request->hasFile('updatePersonalId2') && $request->hasFile('updatePersonalId')){
                                $filename = $request->file('updatePersonalId');
                                $imageName =   time().rand() . '.' .  $filename->getClientOriginalExtension();
                                $path = $request->file('updatePersonalId')->storeAs('applicant_Id', $imageName, 'public');
                                $imageData1['updatePersonalId'] = '/storage/'.$path;

                                $update = applicants::find($applicantId);
                                $update->personal_id=$imageData1['updatePersonalId'];
                                $update->save();
                                return response()->json(1);
                    }elseif(!$request->hasFile('updatePersonalId') && $request->hasFile('updatePersonalId2')){
                                $filename2 = $request->file('updatePersonalId2');
                                $imageName2 =   time().rand() . '.' .  $filename2->getClientOriginalExtension();
                                $path2 = $request->file('updatePersonalId2')->storeAs('applicant_Id', $imageName2, 'public');
                                $imageData2['updatePersonalId2'] = '/storage/'.$path2;
                                $update = applicants::find($applicantId);
                                $update->personal_id2=$imageData2['updatePersonalId2'];
                                $update->save();
                                    return response()->json(1);
                    }else{
                                $filename = $request->file('updatePersonalId');
                                $imageName =   time().rand() . '.' .  $filename->getClientOriginalExtension();
                                $path = $request->file('updatePersonalId')->storeAs('applicant_Id', $imageName, 'public');
                                $imageData1['updatePersonalId'] = '/storage/'.$path;

                                $filename2 = $request->file('updatePersonalId2');
                                $imageName2 =   time().rand() . '.' .  $filename2->getClientOriginalExtension();
                                $path2 = $request->file('updatePersonalId2')->storeAs('applicant_Id', $imageName2, 'public');
                                $imageData2['updatePersonalId2'] = '/storage/'.$path2;
                            $update = applicants::find($applicantId);
                            $update->personal_id=$imageData1['updatePersonalId'];
                            $update->personal_id2=$imageData2['updatePersonalId2'];
                            $update->save();
                            if($update){
                                return response()->json(1);
                            }
                    }
                }

                        public function updateUsersPassword(Request $request){
                            $passwordVerify = applicants::select('password')->where('applicant_id', '=',  auth()->guard('applicantsModel')->user()->applicant_id)->first();
                            if(!Hash::check($request->currentPassword, $passwordVerify->password)){
                                return response()->json(0);
                            }else{
                                $update = applicants::find(auth()->guard('applicantsModel')->user()->applicant_id);
                                $update->password = Hash::make($request->input('confirmPassword'));
                                $update->save();
                                return response()->json(1);
                            }
                        }
}
