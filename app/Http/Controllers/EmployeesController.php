<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Redirect;
use App\Models\employees;
use Auth;    
use Session;
use Hash;

class EmployeesController extends Controller
{
    use AuthenticatesUsers;
    
    public function employeesLoginRoutes(){
        return view('employeesLogin');
    }    

    protected function employeesCredentials(Request $request){
        return [
            'emailAddress' => request()->{$this->employeesEmail()},
            'password' => request()->employeesPassword,
        ];
    }
    protected function employeesEmail(){
        return 'employeesEmail';
    }

    // EMPLOYEES LOGIN
        public function employeesLoginFunction(Request $request){
            $employeesEmail = $request->employeesEmail;
            $password = $request->employeesPassword;
            if(auth()->guard('employeesModel')->attempt($this->employeesCredentials($request))){
                if(auth()->guard('employeesModel')->user()->is_active != 0){
                    if(auth()->guard('employeesModel')->user()->is_utilized == 0){
                        $employees = auth()->guard('employeesModel')->user()->employee_id;
                        $updateUtilized = employees::where('employee_id', '=', $employees)->update(['is_utilized' => '1']);
                        if($updateUtilized){ 
                            if(auth()->guard('employeesModel')->user()->position === 'Recruiter'){
                                if(Auth::guard('employeesModel')->check()){
                                    // RECRUITER DASHBOARD
                                    $request->session()->regenerate();
                                    return response()->json(3);
                                }
                            }else{
                                if(Auth::guard('employeesModel')->check()){
                                    // ADMIN DASHBOARD
                                    $request->session()->regenerate();
                                    return response()->json(1);
                                }
                            }
                        }
                    }else{
                        // ALREADY LOGGED IN
                        return response()->json(4);
                    }
                }else{
                    // INACTIVE ACCOUNT
                    return response()->json(2);
                }
            }else{
                // WRONG CREDENTIALS
                return response()->json(0);
            }
        }
    // EMPLOYEES LOGIN

    // EMPLOYEES LOGOUT
        public function employeesLogoutFunction(){
            $update = employees::where('employee_id', auth()->guard('employeesModel')->user()->employee_id)
            ->update(array('is_utilized' => 0));
            if($update){
                Session::flush();
                Auth::logout();
                return response()->json(1);
            }
        }
    // EMPLOYEES LOGOUT
}
