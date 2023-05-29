<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\employees;
use App\Models\applicants;
use App\Models\operations;
use App\Models\applied;
use App\Models\backout;
use App\Models\declined;
use App\Models\completed;
use App\Models\history;
use Session;
use Hash;
use Auth;
use PDF;

class RecruiterController extends Controller
{
    // RECRUITER PORTAL     
        // RECRUITER DASHBOARD
            // ROUTES
                public function recruiterDashboardRoutes(){
                    return view('recruiter/dashboard');
                }

                public function recruiterApplicantsBackoutRoutes(){
                    return view('recruiter/backout');
                }

                public function recruiterApplicantDeclinedRoutes(){
                    return view('recruiter/declined');
                }
            // ROUTES

            // FETCH
                // RECRUITER OPERATION SCHEDULE
                    public function recruiterScheduleOperation(Request $request){
                        $data = operations::where([['is_completed', '=', 0]])->get();
                        $countData = $data->count();
                        return response()->json($countData != '' ? $countData : '0');
                    }
                // RECRUITER OPERATION SCHEDULE

                // PENDING INVITATION
                    public function recruiterPendingOperation(Request $request){
                        $data = applied::join('operations', 'operation_id', '=', 'operations.certainOperation_id')
                        ->where([
                        ['applied.is_recruited' ,'!=', 1],['applied.is_recommend', '=', 1]])->get();
                        $countData = $data->count();
                        return response()->json($countData != '' ? $countData : '0');
                    } 
                // PENDING INVITATION

                // BACK OUT
                    public function recruiterBackOutInvitation(Request $request){
                        $data = backout::join('operations', 'backout.operation_id', '=', 'operations.certainOperation_id')
                        ->where([['backout.is_archived','!=', 1]])->get();
                        $countData = $data->count();
                        return response()->json($countData != '' ? $countData : '0');
                    } 
                // BACK OUT

                // DECLINED INVITATION
                    public function recruiterDeclinedInvitaion(Request $request){
                        $data = declined ::join('operations', 'declined.operation_id', '=', 'operations.certainOperation_id')
                        ->where([['declined.is_archived','!=', 1]])->get();
                        $countData = $data->count();
                        return response()->json($countData != '' ? $countData : '0');
                    } 
                // DECLINED INVITATION
                
                // PENDING INVITATION CONTENT
                    public function pendingInvitationContent(Request $request){
                        $data = applied::join('operations', 'applied.operation_id', '=', 'operations.certainOperation_id')
                        ->join('applicants', 'applied.applicants_id', '=', 'applicants.applicant_id')
                        ->join('employees AS recruiter', 'applied.recruiter', '=', 'recruiter.employee_id')
                        ->where([
                        ['applied.is_recommend', '=', 1],['applied.is_recruited', '!=' ,1]])->orderBy('applied.applied_id', 'ASC')->
                        select(
                            'operations.*',
                            'applied.applied_id',
                            'applicants.firstname as applicantFname',
                            'applicants.lastname as applicantLname',
                            'applicants.extention as applicantExtention',
                            'applicants.position as applicantPosition',
                            'recruiter.firstname as recruiterFname',
                            'recruiter.lastname as recruiterLname',
                            'recruiter.extention as recruiterExtention',
                        )
                        ->get();
                        if($data->isNotEmpty()){
                            echo"
                            <div class='row gap-0'>
                            <table class='table text-center align-middle table-striped' id='pendingInvitationTable'>
                            <thead>
                            <tr>
                                <th scope='col'>#</th>
                                <th scope='col'>Project Workers</th>
                                <th scope='col'>Role</th>
                                <th scope='col'>Operation</th>
                                <th scope='col'>Operation Start</th>
                                <th scope='col'>Operation End</th>
                                <th scope='col'>Recommend By</th>
                                <th scope='col'>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                        ";
                        foreach($data as $count => $certainData){
                            $count = $count +1;
                            $newOperationStartDate = date('F d, Y',strtotime($certainData->operationStart));
                            $newOperationStartTime = date('g:i: A',strtotime($certainData->operationStart));
                            $newOperationEndDate = date('F d, Y',strtotime($certainData->operationEnd));
                            $newOperationEndTime = date('g:i: A',strtotime($certainData->operationEnd));
                            echo"                       
                                    <tr>
                                        <td>$count</td>
                                        <td>$certainData->applicantFname $certainData->applicantLname $certainData->applicantExtention</td>
                                        <td>$certainData->applicantPosition</td>
                                        <td>Name: $certainData->shipName <br> Carry: $certainData->shipCarry</td>
                                        <td>Date: $newOperationStartDate <br> Time: $newOperationStartTime</td>
                                        <td>Date: $newOperationEndDate <br> Time: $newOperationEndTime</td>
                                        <td>$certainData->recruiterFname $certainData->recruiterLname $certainData->recruiterExtention</td>
                                        <td><button type='button' onclick=deleteRecommendApplicants($certainData->applied_id) class='btn btn-danger btn-sm'>Cancel</button></td>
                                    </tr>                    
                            ";
                        }
                        echo "
                            </tbody>
                            </table>
                        ";
                        }else{
                            echo "<p class='text-center pt-3 text-danger fw-bold'>NO PENDING INVITATION</p>";
                        }
                    }
                // PENDING INVITATION CONTENT

                // APPLICANT BACKOUT CONTENT
                    public function applicantBackoutContent(Request $request){
                        $data = backout::join('operations', 'backout.operation_id', '=', 'operations.certainOperation_id')
                        ->join('applicants', 'backout.applicant_id', '=', 'applicants.applicant_id')
                        ->join('employees AS recruiter', 'backout.recruiter_id', '=', 'recruiter.employee_id')
                        ->where([['backout.is_archived','!+', 1]])->
                        orderBy('backout.backOut_id', 'ASC')->
                        select(
                            'operations.shipName',
                            'operations.shipCarry',
                            'operations.operationStart',
                            'operations.operationEnd',
                            'backout.backOut_id',
                            'backout.reason',
                            'applicants.firstname as applicantFname',
                            'applicants.lastname as applicantLname',
                            'applicants.extention as applicantExtention',
                            'applicants.position as applicantPosition',
                            'recruiter.firstname as recruiterFname',
                            'recruiter.lastname as recruiterLname',
                            'recruiter.extention as recruiterExtention',
                        )
                        ->get();
                        if($data->isNotEmpty()){
                            echo"
                            <div class='row gap-0'>
                            <table class='table text-center align-middle table-striped' id='backoutTableContent'>
                            <thead>
                            <tr>
                                <th scope='col'>#</th>
                                <th scope='col'>Project Workers</th>
                                <th scope='col'>Role</th>
                                <th scope='col'>Operation</th>
                                <th scope='col'>Operation Start</th>
                                <th scope='col'>Operation End</th>
                                <th scope='col'>Recommend By</th>
                                <th scope='col'>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                        ";
                        foreach($data as $count => $certainData){
                            $count = $count +1;
                            $newOperationStartDate = date('F d, Y',strtotime($certainData->operationStart));
                            $newOperationStartTime = date('h:i A',strtotime($certainData->operationStart));
                            $newOperationEndDate = date('F d, Y',strtotime($certainData->operationEnd));
                            $newOperationEndTime = date('h:i A',strtotime($certainData->operationEnd));
                            echo"                       
                                    <tr>
                                        <td>$count</td>
                                        <td>$certainData->applicantFname $certainData->applicantLname $certainData->applicantExtention</td>
                                        <td>$certainData->applicantPosition</td>
                                        <td>Name: $certainData->shipName <br> Carry: $certainData->shipCarry</td>
                                        <td>Date: $newOperationStartDate <br> Time: $newOperationStartTime</td>
                                        <td>Date: $newOperationEndDate <br> Time: $newOperationEndTime</td>
                                        <td>$certainData->recruiterFname $certainData->recruiterLname $certainData->recruiterExtention</td>
                                        <td>
                                            <button type='button' onclick=backOutReason($certainData->backOut_id) class='btn btn-secondary btn-sm rounded-0'>Reason</button>
                                            <button type='button' onclick=deleteBackOutDetails($certainData->backOut_id) class='btn btn-success btn-sm rounded-0'>Noted</button>
                                        </td>
                                    </tr>                    
                            ";
                        }
                        echo "
                            </tbody>
                            </table>
                        ";
                        }else{
                            echo "<p class='text-center pt-3 text-danger fw-bold'>NO BACKOUT FOUND</p>";
                        }
                    }
                // APPLICANT BACKOUT CONTENT

                // VIEW REASON BACKOUT
                    public function backOutReason(Request $request){
                        $reason = backout::select('reason')->where('backOut_id', '=', $request->backOutId)->first();
                        return response()->json($reason);
                    }
                // VIEW REASON BACKOUT
                    
                // DELETE BACKOUT
                    public function deleteBackOut(Request $request){
                        $deleteBackOut = backout::where([['backOut_id', '=', $request->backOutId]])->delete();
                        return response()->json(1);
                    }
                // DELETE BACKOUT

                // ARCHIVE BACK OUT
                    public function archiveBackOut(Request $request){
                        $archiveBackOut = backout::where([['backOut_id', '=', $request->backOutId]])
                        ->update(['is_archived' => '1']);
                        return response()->json(1);
                    }
                // ARCHIVE BACK OUT

                // DELETE DECLINED
                    public function deleteDeclined(Request $request){
                        $deleteDeclined = declined::where([['declined_id', '=', $request->declinedId]])->delete();
                        return response()->json(1);
                    }
                // DELETE DECLINED

                // ARCHIVE BACK OUT
                    public function archiveDeclined(Request $request){
                        $archiveBackOut = declined::where([['declined_id', '=', $request->declinedId]])
                        ->update(['is_archived' => '1']);
                        return response()->json(1);
                    }
                // ARCHIVE BACK OUT

                // DELETE INVITATION
                    public function deleteInvitation(Request $request){
                        $deleteInvitation = applied::where([['applied_id', '=', $request->appliedId]])->delete();
                        return response()->json(1);
                    }
                // DELETE INVITATION

                // APPLICANT DECLINED CONTENT
                    public function applicantDeclinedContent(Request $request){
                        $data = declined::join('operations', 'declined.operation_id', '=', 'operations.certainOperation_id')
                        ->join('applicants', 'declined.applicant_id', '=', 'applicants.applicant_id')
                        ->join('employees AS recruiter', 'declined.recruiter_id', '=', 'recruiter.employee_id')
                        ->where([['declined.is_archived','!=', 1]])->
                        orderBy('declined.declined_id', 'ASC')->
                        select(
                            'operations.*',
                            'declined.declined_id',
                            'declined.reason',
                            'applicants.firstname as applicantFname',
                            'applicants.lastname as applicantLname',
                            'applicants.extention as applicantExtention',
                            'applicants.position as applicantPosition',
                            'recruiter.firstname as recruiterFname',
                            'recruiter.lastname as recruiterLname',
                            'recruiter.extention as recruiterExtention',
                        )->get();
                        if($data->isNotEmpty()){
                            echo"
                            <div class='row gap-0'>
                            <table class='table text-center align-middle table-striped' id='backoutTableContent'>
                            <thead>
                                <tr>
                                    <th scope='col'>#</th>
                                    <th scope='col'>Project Workers</th>
                                    <th scope='col'>Role</th>
                                    <th scope='col'>Operation</th>
                                    <th scope='col'>Operation Start</th>
                                    <th scope='col'>Operation End</th>
                                    <th scope='col'>Recommend By</th>
                                    <th scope='col'>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                        ";
                        foreach($data as $count => $certainData){
                            $count = $count +1;
                            $newOperationStartDate = date('F d, Y',strtotime($certainData->operationStart));
                            $newOperationStartTime = date('h:i A',strtotime($certainData->operationStart));
                            $newOperationEndDate = date('F d, Y',strtotime($certainData->operationEnd));
                            $newOperationEndTime = date('h:i A',strtotime($certainData->operationEnd)); 
                            echo"                       
                                <tr>
                                    <td>$count</td>
                                    <td>$certainData->applicantFname $certainData->applicantLname $certainData->applicantExtention</td>
                                    <td>$certainData->applicantPosition</td>
                                    <td>Name: $certainData->shipName <br> Carry: $certainData->shipCarry</td>
                                    <td>Date: $newOperationStartDate <br> Time: $newOperationStartTime</td>
                                    <td>Date: $newOperationEndDate <br> Time: $newOperationEndTime</td>
                                    <td>$certainData->recruiterFname $certainData->recruiterLname $certainData->recruiterExtention</td>
                                    <td>
                                        <button type='button' onclick=declinedReason($certainData->declined_id) class='btn btn-secondary btn-sm rounded-0'>Reason</button>
                                        <button type='button' onclick=deletedeclineDetails($certainData->declined_id) class='btn btn-success btn-sm rounded-0'>Noted</button>
                                    </td>
                                </tr>                   
                            ";
                        }
                        echo "
                            </tbody>
                            </table>
                        ";
                        }else{
                            echo "<p class='text-center pt-3 text-danger fw-bold'>NO DECLINED FOUND</p>";
                        }
                    }
                // APPLICANT DECLINED CONTENT

                // VIEW REASON DECLINED
                    public function declinedReason(Request $request){
                        $reason = declined::select('reason')->where('declined_id', '=', $request->declinedId)->first();
                        return response()->json($reason);
                    }
                // VIEW REASON DECLINED
            // FETCH
        // RECRUITER DASHBOARD

        // RECRUITER UPCOMING OPERATION
            // ROUTES
                // UPCOMING OPERATION
                    public function recruiterOperationRoutes(){
                        return view('recruiter/operation');
                    }

                    public function recruitApplicantsRoutes(){
                        return view('recruiter/viewTotalApplicants');
                    }

                    public function recruitedApplicants(){
                        return view('recruiter/viewTotalRecruitedApplicants');
                    }

                    public function recruitRecommendedRoutes(){
                        return view('recruiter/viewTotalRecommended');
                    }

                    public function recruiterAcceptInvitationRoutes(){
                        return view('recruiter/viewTotalAcceptInvitation');
                    }
                // UPCOMING OPERATION

                // FORMED GROUP ROUTES
                    public function recruiterFormedGroupRoutes(){
                        return view('recruiter/group');
                    }
                // FORMED GROUP ROUTES
            // ROUTES

            // FETCH
                // UPCOMING OPERATION   
                    public function recruiterOperation(Request $request){
                        $data = operations::where([['is_completed', '!=', 1]])->orderBy('operationStart')->with('applicants')->get();
                        return view('fetch.recruiter.recruiterOperation', compact('data'));
                    } 
                // UPCOMING OPERATION 

                // GET APPLICANTS OF CERTAIN OPERATION
                    public function applied(Request $request){
                        $data = operations::where('operation_id', '=', 0)->get();
                        $countData = $data->count();
                        return response()->json($countData != '' ? $countData : '0');
                    } 
                // GET APPLICANTS OF CERTAIN OPERATION

                // CERTAIN OPERATION
                    public function showCertainOperation(Request $request){
                        $data = operations::where('certainOperation_id', '=', $request->operationId)->first();
                        return response()->json($data);
                    } 
                // CERTAIN OPERATION
                
                // VIEW OPERATION APPLICANT DETAILS
                    public function showOperationDetails(Request $request){ 
                        $data = operations::where([['certainOperation_id', '=', $request->operationId]])->with('applicants')->get();
                            $startData = date('F d, Y | D',strtotime($data[0]->operationStart));
                            $startTime = date('h:i: A ',strtotime($data[0]->operationStart));
                            $endDate = date('F d, Y | D',strtotime($data[0]->operationEnd));
                            $endTime = date('h:i: A ',strtotime($data[0]->operationEnd));
                            $totalApplicants = count($data[0]->applicants);
                            $totalWorkers = $data[0]->totalWorkers;
                            $photos = $data[0]->photos;
                            $shipName = $data[0]->shipName;
                            $shipCarry = $data[0]->shipCarry;
                            $slot = $data[0]->slot;
                            echo "
                            <div class='col-12'>
                                <div class='card shadow border-2 border rounded-top'>
                                    <div class='row g-0'>
                                        <div class='col-md-5'>
                                            <img loading='lazy' src='$photos' class='card-img-top img-thumdnail rounded-0' style='height: 15.5rem; width:100%;'>
                                        </div>
                                        <div class='col-md-4'>
                                            <ul class='list-group list-group-flush'>
                                                <li class='list-group-item fw-bold'>Ship's Name:<a class='fw-normal text-dark' style='text-decoration:none;'>$shipName</a></li>
                                                <li class='list-group-item fw-bold'>Ship's Carry:<a class='fw-normal text-dark' style='text-decoration:none;'> $shipCarry</a></li>
                                                <li class='list-group-item fw-bold'>Operation Start: </br>
                                                    <a class='fw-normal nav-link'>Date: <span>$startData</span></br></a>
                                                    <a class='fw-normal nav-link'>Time: <span>$startTime</span></a>
                                                </li>
                                                <li class='list-group-item fw-bold'>Operation End: </br>
                                                    <a class='fw-normal nav-link'>Date: <span>$endDate</span></br></a>
                                                    <a class='fw-normal nav-link'>Time: <span>$endTime</span></a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class='col-md-3'>
                                            <h4 class='text-center' style='margin-top:7.3rem; color:#000;'>$slot Slots out of $totalWorkers</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>    
                                ";
                    }
                // VIEW OPERATION APPLICANT DETAILS

                // TOTAL APPLICANTS OF CERTAIN APPLICATION
                    public function totalApplicantOfCertainOperation(Request $request){
                        $request->operationId;
                        $data = applied::join('operations', 'applied.operation_id', '=', 'operations.certainOperation_id')
                        ->join('applicants', 'applied.applicants_id', '=', 'applicants.applicant_id')
                        ->where([['applied.is_recommend', '!=', 1],['applied.is_recruited', '!=', 1],
                        ['applied.operation_id', '=', $request->operationId],['operations.certainOperation_id', '=' , $request->operationId]])
                        ->orderBy('applied.is_recruited', 'DESC')->get(['applicants.applicant_id', 'applicants.lastname', 
                        'applicants.firstname','applicants.extention','applicants.position','applicants.phoneNumber']);
                        return response()->json($data);
                    }
                // TOTAL APPLICANTS OF CERTAIN APPLICATION

                // TOTAL RECRUITED APPLICANTS OF CERTAIN OPERATION
                    // public function totalRecruitedApplicants(Request $request){
                    //     $request->operationId;
                    //     $data = applied::join('operations', 'applied.operation_id', '=', 'operations.certainOperation_id')
                    //     ->join('applicants', 'applied.applicants_id', '=', 'applicants.applicant_id')
                    //     ->join('employees', 'applied.recruiter', '=', 'employees.employee_id')
                    //     ->select('applicants.applicant_id', 'applicants.lastname AS applicantLastName', 'applicants.firstname AS applicantFirstname',
                    //     'applicants.extention AS applicantExtention', 'applicants.position','applicants.phoneNumber',
                    //     'employees.lastname AS employeeLastName', 'employees.firstname AS employeeFirstName','employees.extention AS employeeExtension' )
                    //     ->where([['applied.is_recommend', '!=', 1],['applied.is_recruited', '=', 0],
                    //     ['applied.operation_id', '=', $request->operationId],['operations.certainOperation_id', '=' , $request->operationId]])
                    //     ->orderBy('applied.is_recruited', 'DESC')->get();
                    //     return response()->json($data);
                    // }
                // TOTAL RECRUITED APPLICANTS OF CERTAIN OPERATION

                // TOTAL RECOMMEND APPLICANTS ON CERTAIN OPERATION  
                    public function totalRecommendedApplicantsOfCertainOperation(Request $request){
                        $data = applied::join('operations', 'applied.operation_id', '=', 'operations.certainOperation_id')
                        ->join('applicants', 'applied.applicants_id', '=', 'applicants.applicant_id')
                        ->join('employees', 'applied.recruiter', '=', 'employees.employee_id')
                        ->select('applicants.applicant_id', 'applicants.lastname AS applicantLastName', 'applicants.firstname AS applicantFirstname',
                        'applicants.extention AS applicantExtention', 'applicants.position','applicants.phoneNumber',
                        'employees.lastname AS employeeLastName', 'employees.firstname AS employeeFirstName','employees.extention AS employeeExtension' )
                        ->where([['applied.operation_id', '=', $request->operationId],
                        ['operations.certainOperation_id', '=' , $request->operationId],
                        ['applied.is_recommend', '=', 1],['applied.is_recruited', '!=', 1]])->orderBy('applied.applied_id', 'ASC')
                        ->get();
                        return response()->json($data);
                    }
                // TOTAL RECOMMEND APPLICANTS ON CERTAIN OPERATION

                // TOTAL APPLICANTS WHO ACCEPT INVITATION
                    public function totalApplicantsWhoAcceptInvitation(Request $request){
                        $data = applied::join('operations', 'applied.operation_id', '=', 'operations.certainOperation_id')
                        ->join('applicants', 'applied.applicants_id', '=', 'applicants.applicant_id')
                        ->join('employees', 'applied.recruiter', '=', 'employees.employee_id')
                        ->select('applicants.applicant_id', 'applicants.lastname AS applicantLastName', 'applicants.firstname AS applicantFirstname',
                        'applicants.extention AS applicantExtention', 'applicants.position','applicants.phoneNumber',
                        'employees.lastname AS employeeLastName', 'employees.firstname AS employeeFirstName','employees.extention AS employeeExtension' )
                        ->where([['applied.is_recruited', '=', 1],
                        ['applied.operation_id', '=', $request->operationId],
                        ['operations.certainOperation_id', '=' , $request->operationId]])
                        ->orderBy('applied.is_recruited', 'DESC')
                        ->get(['applicants.applicant_id', 'applicants.lastname', 
                        'applicants.firstname','applicants.extention','applicants.position','applicants.phoneNumber']);
                        return response()->json($data);
                    }
                // TOTAL APPLICANTS WHO ACCEPT INVITATION

                // COMPLETED OPERATION
                    public function recruiterCompleted(Request $request){ 
                        $data = operations::where([['is_completed', '=', 1]])->orderBy('operationStart')->get();
                        if($data->isNotEmpty()){
                            foreach($data as $certainData){
                                $startDate = date('F d, Y | D',strtotime($certainData->operationStart));
                                $startTime = date('h:i: A ',strtotime($certainData->operationStart));
                                $endDate = date('F d, Y | D',strtotime($certainData->operationEnd));
                                $endTime = date('h:i: A ',strtotime($certainData->operationEnd));
                                echo "
                                <div class='card mb-3 shadow round'>
                                    <div class='row g-0'>
                                    <div class='col-md-3'>
                                        <img loading='lazy' src='$certainData->photos' class='card-img-top img-fluid img-thumdnail' style='height: 100%; width:100%;'>
                                    </div>                            
                                    <div class='col-md-3'>
                                        <div class='card-body'>
                                            <ul class='list-group list-group-flush'>
                                                <li class='list-group-item fw-bold'>Ship's Name:<a class='fw-normal text-dark' style='text-decoration:none;'> $certainData->shipName</a></li>
                                                <li class='list-group-item fw-bold'>Ship's Carry:<a class='fw-normal text-dark' style='text-decoration:none;'> $certainData->shipCarry</a></li>
                                                <li class='list-group-item fw-bold text-success'>Operation Start: </br>
                                                    <a class='nav-link text-dark'>Date: <span class='fw-normal'> $startDate</br></a>
                                                    <a class='nav-link text-dark'>Time: <span class='fw-normal'>$startTime</a>
                                                </li>
                                                <li class='list-group-item fw-bold text-danger'>Operation End: </br>
                                                    <a class='nav-link text-dark'>Date: <span class='fw-normal'>$endDate</span></br></a>
                                                    <a class='nav-link text-dark'>Time: <span class='fw-normal'>$endTime</span></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div> 
                                    <div class='col-md-6'>                                 
                                ";
                                $applicantData = completed::join('operations', 'completed.operation_id', '=', 'operations.certainOperation_id')
                                ->join('applicants', 'completed.applicant_id', '=', 'applicants.applicant_id')
                                ->where([['completed.operation_id', '=', $certainData->certainOperation_id],
                                ['operations.certainOperation_id', '=', $certainData->certainOperation_id]])->orderBy('applicants.position')->get();
                                if($applicantData->isNotEmpty()){
                                    echo"
                                    <div class='card-body' style='height:280px; overflow-y:auto;'>
                                    <div class='row'>
                                        <div class='col-9'>
                                            <h5 class='card-title'>Project Workers Participated</h5>
                                        </div>
                                        <div class='col-3 text-end'>
                                            <a href='printCompletedOperation/$certainData->certainOperation_id' class='btn rounded-0 btn-outline-secondary btn-sm'>Export to PDF</a>
                                        </div>
                                    </div>
                                        <table class='table table-bordered text-center align-middle'>
                                            <thead> 
                                                <tr>
                                                    <th scope='col'>#</th>
                                                    <th scope='col'>Applicant</th>
                                                    <th scope='col'>Role</th>
                                                    <th scope='col'>Performance</th>
                                                    <th scope='col'>Details</th>
                                                </tr>
                                            </thead>
                                            <tbody>";
                                    foreach($applicantData as $count => $certainApplicantData){
                                        $count = $count +1;
                                        echo"
                                            <tr>
                                                <td>$count</td>
                                                <td>$certainApplicantData->firstname $certainApplicantData->lastname $certainApplicantData->extention</td>
                                                <td>$certainApplicantData->position</td>
                                                <td>Rating: $certainApplicantData->performanceRating%</td>
                                                <td><button type='button' onclick='viewApplicants($certainApplicantData->applicant_id)' class='btn btn-outline-secondary btn-sm'>View</button></td>
                                            </tr>
                                            ";
                                    }         
                                }else{
                                    echo "<h5 class='text-center' style='color:#800; margin-top:8rem;'>NO APPLICANT RECRUITED YET</h5>";        
                                }
                                echo"
                                </tbody>
                                </table>
                                ";
                                $recruiter = employees::select('lastname','firstname','extention')->where('employee_id', '=' , $certainApplicantData->recruiter_id)->first();                                 
                                $dateOfSubmission = completed::select('updated_at')->where('certainCode', '=' , $certainApplicantData->certainCode)->first();                                 
                                $newDate = date_format($dateOfSubmission->updated_at,'F d, Y | g:i A');
                                echo "<p class='text-start fw-bold'>Submitted and Rated by: $recruiter->firstname $recruiter->lastname $recruiter->extention <br> On: $newDate</p>";
                                echo"
                                </div>
                                </div>
                                </div>
                                </div>  
                                ";
                            }
                        }else{
                            echo"<h5 class='text-center' style='margin-top:14rem; color:#800000;'>NO COMPLETED YET</h5>";
                        }
                    }
                // COMPLETED OPERATION

                // SEARCH COMPLETED
                    public function searchCompleted(Request $request){ 
                        $operations = completed::join('operations', 'completed.operation_id', '=', 'operations.certainOperation_id')
                        ->where('operationId', 'like', $request->searchShips)->first();
                        if($operations){
                                $startDate = date('F d, Y | D',strtotime($operations->operationStart));
                                $startTime = date('h:i: A ',strtotime($operations->operationStart));
                                $endDate = date('F d, Y | D',strtotime($operations->operationEnd));
                                $endTime = date('h:i: A ',strtotime($operations->operationEnd));
                                echo "
                                <div class='card mb-3 shadow round'>
                                    <div class='row g-0'>
                                    <div class='col-md-3'>
                                        <img loading='lazy' src='$operations->photos' class='card-img-top img-fluid img-thumdnail' style='height: 100%; width:100%;'>
                                    </div>                            
                                    <div class='col-md-3'>
                                        <div class='card-body'>
                                            <ul class='list-group list-group-flush'>
                                                <li class='list-group-item fw-bold'>Ship's Name:<a class='fw-normal text-dark' style='text-decoration:none;'> $operations->shipName</a></li>
                                                <li class='list-group-item fw-bold'>Ship's Carry:<a class='fw-normal text-dark' style='text-decoration:none;'> $operations->shipCarry</a></li>
                                                <li class='list-group-item fw-bold text-success'>Operation Start: </br>
                                                    <a class='nav-link text-dark'>Date: <span class='fw-normal'> $startDate</br></a>
                                                    <a class='nav-link text-dark'>Time: <span class='fw-normal'>$startTime</a>
                                                </li>
                                                <li class='list-group-item fw-bold text-danger'>Operation End: </br>
                                                    <a class='nav-link text-dark'>Date: <span class='fw-normal'>$endDate</span></br></a>
                                                    <a class='nav-link text-dark'>Time: <span class='fw-normal'>$endTime</span></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div> 
                                    <div class='col-md-6'>                                 
                                ";
                                $applicantData = completed::join('operations', 'completed.operation_id', '=', 'operations.certainOperation_id')
                                ->join('applicants', 'completed.applicant_id', '=', 'applicants.applicant_id')
                                ->where([['completed.operation_id', '=', $operations->certainOperation_id],
                                ['operations.certainOperation_id', '=', $operations->certainOperation_id]])->orderBy('applicants.position')->get();
                                if($applicantData->isNotEmpty()){
                                    echo"
                                    <div class='card-body' style='height:280px; overflow-y:auto;'>
                                    <div class='row'>
                                        <div class='col-9'>
                                            <h5 class='card-title'>Applicants Participated</h5>
                                        </div>
                                        <div class='col-3 text-end'>
                                            <a href='printCompletedOperation/$operations->certainOperation_id' class='btn rounded-0 btn-outline-secondary btn-sm'>Export to PDF</a>
                                        </div>
                                    </div>
                                        <table class='table table-bordered text-center align-middle'>
                                            <thead> 
                                                <tr>
                                                    <th scope='col'>#</th>
                                                    <th scope='col'>Applicant</th>
                                                    <th scope='col'>Role</th>
                                                    <th scope='col'>Details</th>
                                                </tr>
                                            </thead>
                                            <tbody>";
                                    foreach($applicantData as $count => $certainApplicantData){
                                        $count = $count +1;
                                        echo"
                                            <tr>
                                                <td>$count</td>
                                                <td>$certainApplicantData->firstname $certainApplicantData->lastname $certainApplicantData->extention</td>
                                                <td>$certainApplicantData->position</td>
                                                <td><button type='button' onclick='viewApplicants($certainApplicantData->applicant_id)' class='btn btn-outline-secondary btn-sm'>View</button></td>
                                            </tr>
                                            ";
                                    }                             
                                }
                                echo"
                                </tbody>
                                </table>
                                </div>
                                </div>
                                </div>
                                </div>  
                                ";
                        }else{
                            echo"<h5 class='text-center' style='margin-top:16rem; color:#800000;'>NO OPERATION FOUND</h5>";
                        }
                    }
                // SEARCH COMPLETED

                // SEARCH APPLICANT LAST NAME
                    public function fetchApplicantLastname(Request $request){ 
                        $applicant = applicants::where('lastname', 'like', $request->searchApplicant)->get();
                        if($applicant->isNotEmpty()){
                                echo "
                                <thead>
                                <tr>
                                  <th class='fw-bold'>#</th>
                                  <th class='fw-bold'>Applicant</th>
                                  <th class='fw-bold'>Action</th>
                                </tr>
                                </thead>
                                <tbody></tbody>
                                ";
                            foreach($applicant as $count => $certainData){
                                $count = $count +1;
                                echo"
                                <tr>
                                    <td class='col-1'>$count</td>
                                    <td class='col'>$certainData->firstname  $certainData->lastname  $certainData->extention</td>
                                    <td class='col-4'><button type='button' onclick=viewApplicants('$certainData->applicant_id') class='btn btn-secondary btn-sm rounded-0'>Details</button>
                                    <button type='button' onclick=recommendApplicantRecruit('$certainData->applicant_id') class='btn btn-success btn-sm rounded-0'>Recruit</button></td>
                                </tr>
                                ";
                            }
                            echo "</tbody>";
                        }else{
                            echo "
                            <tr>
                            <td class='col-1'></td>
                            <td class='fw-bold text-danger'>NO DATA FOUND</td>
                            <td class='col-1'></td>
                            </tr>
                            ";
                        }
                    }
                // SEARCH APPLICANT LAST NAME

                // RECOMMENDED APPLICANT
                    public function recruitRecommendedApplicant(Request $request){
                        $applicantId = $request->applicantId;
                        $operationId = $request->operationId;
                        $operations = operations::select('slot')->where('certainOperation_id','=', $operationId)->first();
                        if($operations->slot == 0){
                            return response()->json(4);
                        }else{
                            $data = applied::where([['operation_id','=', $operationId],['applicants_id', '=', $applicantId]])->get();
                            if($data->isNotEmpty()){
                                // ALREADY APPLIED
                                return response()->json('2');
                            }else{
                                $data2 = operations::where([['certainOperation_id','=', $operationId]])->get();
                                foreach($data2 as $certainOperationInfo){
                                    $applyingOperationStart = date('F d, Y | h:i:a',strtotime($certainOperationInfo->operationStart));
                                    $applyingOperationEnd = date('F d, Y | h:i:a',strtotime($certainOperationInfo->operationEnd));
                                }
                                $data3 = applied::join('operations', 'applied.operation_id', '=', 'operations.certainOperation_id')
                                ->where([['applied.applicants_id' , '=' , $applicantId],['applied.is_recruited' ,'=', 1]])->get();
                                if($data3->isNotEmpty()){
                                    foreach($data3 as $certainAppliedInfo){
                                        $scheduledOperationStart = date('F d, Y | h:i:a',strtotime($certainAppliedInfo->operationStart));
                                        $scheduledOperationEnd = date('F d, Y | h:i:a',strtotime($certainAppliedInfo->operationEnd));
                                    }
                                    if($applyingOperationStart == $scheduledOperationStart){
                                        return response()->json('3'); // NOT AVAILABLE ON THAT DAY
                                        exit();
                                    }else{
                                        $recommendApplicant = applied::create([
                                            'operation_id' => $operationId,
                                            'applicants_id' => $applicantId,
                                            'is_recruited' => 0,
                                            'is_recommend' => 1,
                                            'recruiter' => auth()->guard('employeesModel')->user()->employee_id,
                                            'date_time_applied' => now(),
                                        ]);
                                        if($recommendApplicant){
                                            $updateSlot = operations::find($operationId)->decrement('slot');
                                            if($updateSlot){
                                                return response()->json('1'); // RECOMMEND APPLICANT
                                            }else{
                                                return response()->json('0');
                                            }
                                        }
                                    }
                                }else{
                                    $recommendApplicant = applied::create([
                                        'operation_id' => $operationId,
                                        'applicants_id' => $applicantId,
                                        'is_recruited' => 0,
                                        'is_recommend' => 1,
                                        'recruiter' => auth()->guard('employeesModel')->user()->employee_id,
                                        'date_time_applied' => now(),
                                    ]);
                                    if($recommendApplicant){
                                        $updateSlot = operations::find($operationId)->decrement('slot');
                                        if($updateSlot){
                                            return response()->json('1'); // RECOMMEND APPLICANT
                                        }else{
                                            return response()->json('0');
                                        }
                                    }
                                }
                            }
                        }
                    }
                // RECOMMENDED APPLICANT

                // CANCEL RECOMMENDATION
                    public function cancelRecommendation(Request $request){
                        $cancelRecommendation = applied::where([['operation_id', '=',  $request->operationId],
                        ['applicants_id', '=', $request->applicantId]])->delete();
                        if($cancelRecommendation){
                            $updateSlot = operations::find($request->operationId)->increment('slot');
                            return response()->json($updateSlot ? 1 : 0);
                        }
                    }
                // CANCEL RECOMMENDATION

                // RECRUIT APPLICANT
                    public function recruitApplicants(Request $request){
                        $applying = operations::where([['certainOperation_id','=', $request->operationId]])->get();
                        foreach($applying as $applyingOperationInfo){
                            $applyingOperationStart = date('F d, Y | g:i:A',strtotime($applyingOperationInfo->operationStart));
                            $applyingOperationEnd = date('F d, Y | g:i:A',strtotime($applyingOperationInfo->operationEnd));
                        }
                        $scheduled = applied::join('operations', 'applied.operation_id', '=', 'operations.certainOperation_id')
                        ->where([['applied.applicants_id' , '=' , $request->applicantId],['applied.is_recruited' ,'=', 1]])->get();
                        if($scheduled->isNotEmpty()){
                            foreach($scheduled as $scheduledAppliedInfo){
                                $scheduledOperationStart = date('F d, Y | g:i:A',strtotime($scheduledAppliedInfo->operationStart));
                                $scheduledOperationEnd = date('F d, Y | g:i:A',strtotime($scheduledAppliedInfo->operationEnd));
                            }
                            if($applyingOperationStart == $scheduledOperationStart){
                                // NOT AVAILABLE IN THAT DAY
                                $applying = employees::where([['employee_id','=', $scheduledAppliedInfo->recruiter]])
                                ->select('lastname','firstname','extention')->first();
                                $notAvailable = 'The project worker was already scheduled for the operation of '.$scheduledOperationStart.' until '.$scheduledOperationEnd.' because he/she already recruit by Mr '.$applying->firstname.' '.$applying->lastname.' '.$applying->extention;
                                return response()->json($notAvailable);
                                exit();
                            }else{
                                // VALID TO RECRUIT
                                $recruitApplicant = applied::where([['applicants_id', '=' , $request->applicantId],
                                ['operation_id', '=' , $request->operationId]])->update(['is_recruited' => '1',
                                'recruiter' => auth()->guard('employeesModel')->user()->employee_id]);
                                if($recruitApplicant){
                                    $updateSlot = operations::find($request->operationId)->decrement('slot');
                                    return response()->json($updateSlot ? 1 : 0);
                                }
                            }
                        }else{
                            // VALID TO RECRUIT
                            $recruitApplicant = applied::where([['applicants_id', '=' , $request->applicantId],
                            ['operation_id', '=' , $request->operationId]])->update(['is_recruited' => '1',
                            'recruiter' => auth()->guard('employeesModel')->user()->employee_id]);
                            if($recruitApplicant){
                                $updateSlot = operations::find($request->operationId)->decrement('slot');
                                return response()->json($updateSlot ? 1 : 0);
                            }
                        }
                    }
                // RECRUIT APPLICANT

                // CANCEL RECRUITMENT
                    public function cancelRecruitment(Request $request){
                        $recruitApplicant = applied::where([['applicants_id', '=' , $request->applicantId],
                        ['operation_id', '=' , $request->operationId]])->update(['is_recruited' => '0']);
                        if($recruitApplicant){
                            $updateSlot = operations::find($request->operationId)->increment('slot');
                            return response()->json($updateSlot ? 1 : 0);
                        }
                    }
                // CANCEL RECRUITMENT

                // CANCEL RECRUITMENT OF RECOMMENDED APPLICANT
                    public function cancelRecruitmentAndRecommendation(Request $request){
                        $recommended = applied::select('is_recommend')->where([['operation_id', '=', $request->operationId],
                        ['applicants_id', '=', $request->applicantId]])->first();
                        if($recommended->is_recommend == 1){
                            $cancelRecruitmentAndRecommendation = applied::where([['operation_id', '=', $request->operationId],
                            ['applicants_id', '=', $request->applicantId]])->delete();
                        }else{
                            $recruitApplicant = applied::where([['operation_id', '=', $request->operationId],
                            ['applicants_id', '=', $request->applicantId]])->update(['is_recruited' => '0']);
                        }
                            $updateSlot = operations::find($request->operationId)->increment('slot');
                            return response()->json($updateSlot ? 1 : 0);
                    }
                // CANCEL RECRUITMENT OF RECOMMENDED APPLICANT

                // SHOW FORMED GROUP    
                    public function recruiterFormedGroup(Request $request){
                        $data = operations::where([
                        ['is_completed', '!=', 1]])->orderBy('operationStart')->get();
                        if($data->isNotEmpty()){
                            foreach($data as $certainData){
                                $startDate = date('F d, Y | D',strtotime($certainData->operationStart));
                                $startTime = date('h:i: A ',strtotime($certainData->operationStart));
                                $endDate = date('F d, Y | D',strtotime($certainData->operationEnd));
                                $endTime = date('h:i: A ',strtotime($certainData->operationEnd));
                                echo "
                                <div class='card mb-3 shadow round'>
                                    <div class='row g-0'>
                                    <div class='col-md-3'>
                                        <img loading='lazy' src='$certainData->photos' class='card-img-top img-fluid img-thumdnail' style='height: 100%; width:100%;'>
                                    </div>                            
                                    <div class='col-md-3'>
                                        <div class='card-body'>
                                            <ul class='list-group list-group-flush'>
                                                <li class='list-group-item fw-bold'>Ship's Name:<a class='fw-normal text-dark' style='text-decoration:none;'> $certainData->shipName</a></li>
                                                <li class='list-group-item fw-bold'>Ship's Carry:<a class='fw-normal text-dark' style='text-decoration:none;'> $certainData->shipCarry</a></li>
                                                <li class='list-group-item fw-bold'>Slot:<a class='fw-normal text-dark' style='text-decoration:none;'> $certainData->slot out of $certainData->totalWorkers Workers</a></li>
                                                <li class='list-group-item fw-bold text-success'>Operation Start: </br>
                                                    <a class='nav-link text-dark'>Date: <span class='fw-normal'> $startDate</br></a>
                                                    <a class='nav-link text-dark'>Time: <span class='fw-normal'>$startTime</a>
                                                </li>
                                                <li class='list-group-item fw-bold text-danger'>Operation End: </br>
                                                    <a class='nav-link text-dark'>Date: <span class='fw-normal'>$endDate</span></br></a>
                                                    <a class='nav-link text-dark'>Time: <span class='fw-normal'>$endTime</span></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div> 
                                    <div class='col-md-6'>                                 
                                ";
                                $applicantData = applied::join('operations', 'applied.operation_id', '=', 'operations.certainOperation_id')
                                ->join('applicants', 'applied.applicants_id', '=', 'applicants.applicant_id')
                                ->join('employees', 'applied.recruiter', '=', 'employees.employee_id')
                                ->where([['applied.operation_id', '=', $certainData->certainOperation_id],['operations.certainOperation_id', '=', $certainData->certainOperation_id],
                                ['applied.is_recruited', '!=' , 0]])
                                ->select('applicants.applicant_id', 'applicants.lastname AS applicantLastName', 'applicants.firstname AS applicantFirstname',
                                'applicants.extention AS applicantExtention', 'applicants.position','employees.lastname AS employeeLastName', 
                                'employees.firstname AS employeeFirstName','employees.extention AS employeeExtension' )
                                ->orderBy('applicants.position')->get();
                                if($applicantData->isNotEmpty()){
                                    echo"
                                    <div class='card-body' style='height:300px; overflow-y:auto;'>
                                    <div class='row'>
                                        <div class='col-6'>
                                            <h5 class='card-title text-start'>Workers Recruited</h5>
                                        </div>
                                        <div class='col-6 text-end align-middle'>
                                            <a onclick='recruitRecommendedRoutes($certainData->certainOperation_id)' type='button' class='btn btn-outline-secondary text-center rounded-0 px-4 btn-sm'>Recruit</a>
                                            <a href='printAttendance/$certainData->certainOperation_id' class='btn rounded-0 btn-outline-secondary btn-sm'>Export to PDF</a>
                                        </div>
                                    </div>
                                        <table class='table table-bordered text-center align-middle'>
                                            <thead>
                                                <tr>
                                                    <th scope='col'>#</th>
                                                    <th scope='col'>Project Workers</th>
                                                    <th scope='col'>Role</th>
                                                    <th scope='col'>Recruit By</th>
                                                    <th scope='col'>Details</th>
                                                </tr>
                                            </thead>
                                            <tbody>";
                                    foreach($applicantData as $count => $certainApplicantData){
                                        $count = $count +1;
                                        echo"
                                            <tr>
                                                <td>$count
                                                    <input type='hidden' readonly value='$certainData->certainOperation_id' id='operationId' name='operationId'>
                                                </td>
                                                <td>$certainApplicantData->applicantFirstname $certainApplicantData->applicantLastName $certainApplicantData->applicantExtention</td>
                                                <td>$certainApplicantData->position</td>
                                                <td>$certainApplicantData->employeeFirstName $certainApplicantData->employeeLastName $certainApplicantData->employeeExtension</td>
                                                <td><button type='button' onclick='viewApplicants($certainApplicantData->applicant_id)' class='btn rounded-0 btn-outline-secondary btn-sm'>View</button></td>
                                                </tr>
                                                ";
                                            }                   
                                            echo "
                                            </tbody>
                                            </table>
                                            ";
                                            date_default_timezone_set('Asia/Manila'); 
                                            $currentDate = date('Y-m-d H:i:s', strtotime("+4 hours", strtotime(now())));
                                            $operationDate = operations::where('certainOperation_id', '=' , $certainData->certainOperation_id)->value('operationEnd');
                                            if($currentDate > $operationDate){
                                                echo"
                                                <div class='row'>
                                                    <div class='col-5 ms-auto text-end'>
                                                        <a type='button' class='btn btn-outline-secondary rounded-0' href='/submitAttendance/$certainData->certainOperation_id'>Submit Attendance</a>
                                                    </div>
                                                </div>
                                                ";
                                            }else{
                                                echo"
                                                <div class='row'>
                                                    <div class='col-5 ms-auto text-end'>
                                                        <button disabled type='button' class='btn btn-outline-secondary rounded-0'>Submit Attendance</button>
                                                    </div>
                                                </div>
                                                "; 
                                            }
                                }else{
                                    echo "<h5 class='text-center text-dark' style='margin-top:9rem;'>NO PROJECT WORKERS FOUND<br>
                                        <a onclick='recruitRecommendedRoutes($certainData->certainOperation_id)' style='background-color:#800000;' type='button' class='btn text-white text-center rounded-0 mt-2 px-4 btn-sm'>RECRUIT</a>
                                    </h5>
                                    ";        
                                }echo "</div></div></div></div> ";
                            }
                        }else{
                            echo "<h5 class='fs-5 text-center' style='color:#800000; margin-top:16.5rem;'>NO SCHEDULED FOUND</h5>";        
                        }
                    }
                // SHOW FORMED GROUP

                // SUBMIT ATTENDANCE
                    public function submitAttendance(Request $request, $id){
                        $data = operations::where('certainOperation_id', '=' , $id)->with('applicants')->get();
                        return view('fetch.recruiter.submitAttendance', compact('data'));
                    }
                // SUBMIT ATTENDANCE

                // PRINT ATTENDANCE
                    public function printAttendance(Request $request, $id){
                        $operationId = $id;
                        $data = applied::join('operations', 'applied.operation_id', '=', 'operations.certainOperation_id')
                        ->join('applicants', 'applied.applicants_id', '=', 'applicants.applicant_id')
                        ->where([['applied.operation_id', '=', $operationId],['operations.certainOperation_id', '=', $operationId],
                        ['applied.is_recruited', '!=' , 0]])->orderBy('applicants.position')->get();
                        $foreman = auth()->guard('employeesModel')->user()->firstname.' '.auth()->guard('employeesModel')->user()->lastname.' '.auth()->guard('employeesModel')->user()->extention; 
                        foreach($data as $count => $certainData){
                            $count = $count +1;
                            $applicantsAttendance = [
                                'foreman' => $foreman,
                                'operationId' => $certainData->operationId,
                                'shipName' => $certainData->shipName,
                                'shipCarry' => $certainData->shipCarry,
                                'operationStart' => $certainData->operationStart,
                                'operationEnd' => $certainData->operationEnd,
                                'slot' => $count,
                                'data' => $data
                            ]; 
                        }
                        $pdf = PDF::loadView('fetch.recruiter.applicantAttendance', $applicantsAttendance);
                        return $pdf->stream('attendance_'.$certainData->operationId.'.pdf');
                    }
                // PRINT ATTENDANCE

                // PRINT APPLICANT
                    public function printProjectWorker(Request $request, $id){
                        $data = applicants::where([['applicant_id', '=', $id]])->get();
                        foreach($data as $count => $certainData){
                            $applicantInfo = [
                                'data' => $data
                            ]; 
                        }
                        $pdf = PDF::loadView('fetch.applicants.applicantsInfo', $applicantInfo);
                        return $pdf->stream('Project Worker_'.$id.'.pdf');
                    }
                // PRINT APPLICANT

                // BADGE FOR ALL
                    public function badgeForAll(Request $request){
                        $data = applied::where([['operation_id', '=', $request->operationId]])->get();
                        $countBadge = count($data);
                        return response()->json($countBadge);
                    }
                // BADGE FOR ALL

                // BADGE FOR TOTAL APPLICANTS
                    public function badgeForTotalApplicants(Request $request){
                        $data = applied::where([['is_recommend', '!=', 1],['is_recruited', '!=', 1],
                        ['operation_id', '=', $request->operationId]])->get();
                        $countBadge = count($data);
                        return response()->json($countBadge);
                    }
                // BADGE FOR TOTAL APPLICANTS

                // BADGE FOR TOTAL RECOMMEND APPLICANTS
                    public function badgeForRecommendApplicants(Request $request){
                        $data = applied::where([['is_recommend', '=', 1],['is_recruited', '=', 0],
                        ['operation_id', '=', $request->operationId]])->get();
                        $countBadge = count($data);
                        return response()->json($countBadge);
                    }
                // BADGE FOR TOTAL RECOMMEND APPLICANTS

                // BADGE FOR TOTAL ACCEPT INVITATION
                    public function badgeAcceptInvitation(Request $request){
                        $data = applied::where([['is_recruited', '=', 1],['operation_id', '=', $request->operationId]])->get();
                        $countBadge = count($data);
                        return response()->json($countBadge);
                    }
                // BADGE FOR TOTAL ACCEPT INVITATION

                // BADGE FOR TOTAL RECRUITED APPLICANTS 
                    public function badgeForRecruitedApplicants(Request $request){
                        $data = applied::where([['operation_id', '=', $request->operationId],['is_recommend', '=', 0],
                        ['is_recruited', '=', 1]])->get();
                        $countBadge = count($data);
                        return response()->json($countBadge);
                    }
                // BADGE FOR TOTAL RECRUITED APPLICANTS

                // CONFIRMATION EMPLOYEES PASSWORD
                    public function confirmationPassword(Request $request){
                        $passwordVerify = employees::select('password')->where('employee_id','=', 
                        auth()->guard('employeesModel')->user()->employee_id)->first();
                        $checkpassword = Hash::check($request->employeePassword, $passwordVerify->password);
                        $confirmPassword = $checkpassword == true ? 1 : 0;
                        return response()->json($confirmPassword);
                    }   
                // CONFIRMATION EMPLOYEES PASSWORD

                // SUBMITTING ATTENDANCE INTO DB
                    public function submitApplicantAttendance(Request $request){
                        date_default_timezone_set('Asia/Manila'); 
                        $checkIfValid = operations::select('operationEnd')->where('certainOperation_id','=', $request->operationId)->first(); 
                        $operationEnd = date('F d, Y | h:i: A',strtotime($checkIfValid->operationEnd));
                        $currentDate = date('F d, Y | h:i: A', strtotime("+4 hours", strtotime(now())));
                        if($currentDate > $operationEnd){
                            $certainCode = date("Y").''.rand(00001,99999);          
                            $applicantId = $request->applicantPresent;
                            $perApplicantPerformance = $request->applicantPerformance;
                            $count = count($request->applicantPresent);
                            for ($i = 0; $i < $count; $i++) {
                                $data1 = $applicantId[$i];
                                $data2 = $perApplicantPerformance[$i];
                                $submitAttendance = completed::create([
                                    'operation_id' => $request->operationId,
                                    'applicant_id' => $data1,
                                    'recruiter_id' => auth()->guard('employeesModel')->user()->employee_id,
                                    'performanceRating' => $data2,
                                    'certainCode' => $certainCode,
                                    'date_time_complete' => now(),
                                ]);
                                $deleteApplied = applied::where([['applicants_id', '=', $data1],
                                ['operation_id',$request->operationId]])->delete();

                                $completeOperation = operations::where([['certainOperation_id', '=' , $request->operationId]])
                                ->update(['is_completed' => 1]);

                                $proWorkers = applicants::where([['applicant_id', '=' , $data1]])
                                ->update(['is_pro' => 1]);        
                                
                                // $operationData = operations::where([['certainOperation_id', '=' , $request->operationId]])
                                // ->first();
                            }
                            // $recruiter = auth()->guard('employeesModel')->user()->firstname.' '.auth()->guard('employeesModel')->user()->lastname.' '.auth()->guard('employeesModel')->user()->extention;
                            // $newOperationStart = date('F d, Y | h:i: A',strtotime($operationData->operationStart));
                            // $newOperationEnd = date('F d, Y | h:i: A',strtotime($operationData->operationEnd));
                            // $savehistory = history::create([
                            //     'content' => 'Mr. '.$recruiter.' has completed the status and passed the attendance of project workers who attend to operation '.$operationData->operationId.' | The ship name is '.$operationData->shipName.', and it carries '.$operationData->shipCarry.'. The operation start on '.$newOperationStart.' until '.$newOperationEnd.''
                            // ]);
                            return response()->json($submitAttendance ? 1 : 0);
                        }else{
                            return response()->json(2);
                        }
                     
                    }
                // SUBMITTING ATTENDANCE INTO DB

            // FETCH
        // RECRUITER UPCOMING OPERATION

        // RECRUITER VIEW APPLICANTS
            // ROUTES
                public function recruiterOnCallWorkerRoutes(){
                    return view('recruiter/onCallWorkers');
                }
            // ROUTES
            
            // ROUTES
                public function recruiterApplicantRoutes(){
                    return view('recruiter/applicants');
                }
            // ROUTES

            // FETCH
                // ALL APPLICANTS 
                    public function getAllApplicantsData(Request $request){
                        $data = applicants::where([['is_active', '=', 1],['lastname', '!=', ''],['firstname', '!=', ''],['is_pro' ,'=', 0]])->get();
                        return response()->json($data);
                    } 
                // ALL APPLICANTS 

                // ALL APPLICANTS 
                    public function getAllOnCallWorkers(Request $request){
                        $data = applicants::where([['is_active', '=', 1],['lastname', '!=', ''],['firstname', '!=', ''],['is_pro' ,'=', 1]])->get();
                        return response()->json($data);
                    } 
                // ALL APPLICANTS 

                // FETCH SPECIFIC APPLICANTS
                    public function getCertainApplicants(Request $request){ 
                        $data = applicants::where('applicant_id', '=', $request->applicantId)->first(['applicant_id', 'photos', 'lastname' ,'firstname',
                        'extention', 'Gender', 'position', 'birthday', 'age', 'phoneNumber', 'emailAddress' ,'address' , 'personal_id' , 'personal_id2']);
                        return response()->json($data);
                    }  
                // FETCH SPECIFIC APPLICANTS

                // APPLICANT EXPERIENCE
                    public function applicantExperienceSoya(Request $request){ 
                        $data = completed::join('operations', 'completed.operation_id', '=', 'operations.certainOperation_id')
                        ->where([['completed.applicant_id', '=' ,$request->applicantId],['operations.shipCarry' ,'=', 'Soya']])->get();
                        return response()->json($data->isNotEmpty() ? count($data) : '');
                    }

                    public function applicantExperienceCable(Request $request){ 
                        $data = completed::join('operations', 'completed.operation_id', '=', 'operations.certainOperation_id')
                        ->where([['completed.applicant_id', '=' ,$request->applicantId],['operations.shipCarry' ,'=', 'Cable']])->get();
                        return response()->json($data->isNotEmpty() ? count($data) : '');
                    }  

                    public function applicantExperienceRice(Request $request){ 
                        $data = completed::join('operations', 'completed.operation_id', '=', 'operations.certainOperation_id')
                        ->where([['completed.applicant_id', '=' ,$request->applicantId],['operations.shipCarry' ,'=', 'Rice']])->get();
                        return response()->json($data->isNotEmpty() ? count($data) : '');
                    }  

                    
                    public function applicantExperienceWood(Request $request){ 
                        $data = completed::join('operations', 'completed.operation_id', '=', 'operations.certainOperation_id')
                        ->where([['completed.applicant_id', '=' ,$request->applicantId],['operations.shipCarry' ,'=', 'Wood']])->get();
                        return response()->json($data->isNotEmpty() ? count($data) : '');
                    }
                    
                    public function applicantExperiencePlyWood(Request $request){ 
                        $data = completed::join('operations', 'completed.operation_id', '=', 'operations.certainOperation_id')
                        ->where([['completed.applicant_id', '=' ,$request->applicantId],['operations.shipCarry' ,'=', 'Plywood']])->get();
                        return response()->json($data->isNotEmpty() ? count($data) : '');
                    }
                // APPLICANT EXPERIENCE
            // FETCH
        // RECRUITER VIEW APPLICANTS

        // RECRUITER MANAGE ACCOUNT
            // ROUTES
                public function recruiterDetailsRoutes(){
                    return view('recruiter/manageAccount');
                }

                public function recruiterCredentials(){
                    return view('recruiter/recruiterCredentials');
                }
            // ROUTES

            // FETCH PERSONAL DATA
                public function getEmployeesData(Request $request){  
                    $data = employees::where([['employee_id', '=', auth()->guard('employeesModel')->user()->employee_id]])->get();
                    return response()->json($data);
                }  
            // FETCH PERSONAL DATA

            // EDIT RECRUITER INFORMATION
                public function editRecruiterInfo(Request $request){ 
                    if ($request->hasFile('updateEmployeePhoto')) {
                            $filename = $request->file('updateEmployeePhoto');
                            $imageName =   time().rand() . '.' .  $filename->getClientOriginalExtension();
                            $path = $request->file('updateEmployeePhoto')->storeAs('employees', $imageName, 'public');
                            $imageData['updateEmployeePhoto'] = '/storage/'.$path;
                            // EDIT ONE
                                $update = employees::find($request->uniqueEmployeeId);
                                $update->photos=$imageData['updateEmployeePhoto'];
                                $update->extention=$request->input('updateEmployeeExt');
                                $update->status=$request->input('updateEmployeeStatus');
                                $update->age=$request->input('updateEmployeeAge');
                                $update->address=$request->input('updateEmployeeAddress');
                                $update->phoneNumber=$request->input('updateEmployeePnumber');
                                $update->emailAddress=$request->input('updateEmployeeEmail');
                                $update->save();
                                return response()->json(1);
                            // EDIT ONE
                    }else{
                            // EDIT TWO
                                $update = employees::find($request->uniqueEmployeeId);
                                $update->extention=$request->input('updateEmployeeExt');
                                $update->status=$request->input('updateEmployeeStatus');
                                $update->age=$request->input('updateEmployeeAge');
                                $update->address=$request->input('updateEmployeeAddress');
                                $update->phoneNumber=$request->input('updateEmployeePnumber');
                                $update->emailAddress=$request->input('updateEmployeeEmail');
                                $update->save();
                                return response()->json(1);
                            // EDIT TWO
                    }
                }
            // EDIT RECRUITER INFORMATION 
            
            // UPDATE PASSWORD
                public function updateUsersPassword(Request $request){
                    $passwordVerify = employees::select('password')->where('employee_id', '=',  auth()->guard('employeesModel')->user()->employee_id)->first();
                    if(!Hash::check($request->currentPassword, $passwordVerify->password)){
                        return response()->json(0);
                    }else{
                        $update = employees::find(auth()->guard('employeesModel')->user()->employee_id);
                        $update->password = Hash::make($request->input('confirmPassword'));
                        $update->save();
                        return response()->json(1);
                    }         
                }
            // UPDATE PASSWORD
        // RECRUITER MANAGE ACCOUNT

        // RECRUITER COMPLETED OPERATION
                    // ROUTES
                        public function recruiterCompletedRoutes(){
                            return view('recruiter/completedOperation');
                        }
                    // ROUTES
        
                    // FETCH PERSONAL DATA
                    // FETCH PERSONAL DATA
        // RECRUITER COMPLETED OPERATION

        // ARCHIVED
                // BACKOUT ARCHIVED ROUTES
                      public function recruiterBackOutArchiveRoutes(){
                        return view('recruiter/backOutArchive');
                    }
                // BACKOUT ARCHIVED ROUTES
                
                // DECLINED ARCHIVED ROUTES
                    public function recruiterDeclinedArchiveRoutes(){
                        return view('recruiter/declinedArchive');
                    }
                // DECLINED ARCHIVED ROUTES

                // FETCH
                    // BACKOUT ARCHIVED DATA
                        public function getBackOutArchivedForRecruiter(Request $request){
                            $data = backout::join('operations', 'backout.operation_id', '=', 'operations.certainOperation_id')
                            ->join('applicants', 'backout.applicant_id', '=', 'applicants.applicant_id')
                            ->join('employees', 'backout.recruiter_id', '=', 'employees.employee_id')
                            ->where('backout.is_archived', '=' , 1)
                            ->select('operations.*','backout.backOut_id','backout.reason','applicants.applicant_id', 'applicants.lastname AS applicantLastName', 'applicants.firstname AS applicantFirstname',
                            'applicants.extention AS applicantExtention', 'applicants.position','applicants.phoneNumber',
                            'employees.lastname AS employeeLastName', 'employees.firstname AS employeeFirstName','employees.extention AS employeeExtension' )
                            ->orderBy('operations.operationStart', 'DESC')
                            ->get();
                            return response()->json($data);
                        }
                    // BACKOUT ARCHIVED DATA

                    // DECLINED ARCHIVED DATA
                        public function getDeclinedArchivedForRecruiter(Request $request){
                            $data = declined::join('operations', 'declined.operation_id', '=', 'operations.certainOperation_id')
                            ->join('applicants', 'declined.applicant_id', '=', 'applicants.applicant_id')
                            ->join('employees', 'declined.recruiter_id', '=', 'employees.employee_id')
                            ->where('declined.is_archived', '=' , 1)
                            ->select('operations.*','declined.declined_id','declined.reason','applicants.applicant_id', 'applicants.lastname AS applicantLastName', 'applicants.firstname AS applicantFirstname',
                            'applicants.extention AS applicantExtention', 'applicants.position','applicants.phoneNumber',
                            'employees.lastname AS employeeLastName', 'employees.firstname AS employeeFirstName','employees.extention AS employeeExtension' )
                            ->orderBy('operations.operationStart', 'DESC')
                            ->get();
                            return response()->json($data);
                        }
                    // DECLINED ARCHIVED DATA
                // FETCH
        // ARCHIVED
    // RECRUITER PORTAL 
}