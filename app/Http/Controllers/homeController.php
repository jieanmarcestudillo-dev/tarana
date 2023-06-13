<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\MailNotify;
use Illuminate\Support\Facades\Mail;
use App\Models\applicants;
use Hash;



class homeController extends Controller
{
    public function tarana(){
        return view('mainHome');
    }
    public function termsandcondition(){
        return view('termsandcondition');
    }
    public function privacypolicy(){
        return view('privacypolicy');
    }
    public function forgotPassword(){
        return view('forgotPassword');
    }
    public function resetPassword(){
        return view('resetPassword');
    }

    public function resetPasswordFunction(Request $request){
        $email = applicants::where('emailAddress', '=', $request->email)->select('emailAddress')->first();
        if($email != ''){
            $sendLink = Mail::to($email->emailAddress)->send(new MailNotify($email->emailAddress));
            if($sendLink){
                return response()->json(1);
                exit();
            }
        }else{
            return response()->json(0);
            exit();
        }
    }

    public function newPasswordFunction(Request $request){
        $newPassword = Hash::make($request->password);
        $updatePassword = applicants::where([['emailAddress', '=' , $request->email]])
        ->update(['password' => $newPassword]);
        return response()->json($updatePassword ? 1 : 0);
    }
}
