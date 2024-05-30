<?php

namespace App\Http\Controllers;

use App\Mail\ForgotPassword;
use App\Mail\RegisterMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
class AuthController extends Controller
{
    public function login_admin(){
        if(!empty(Auth::check())){
            return redirect(route("admin.dashboard"));
        }
        return view("admin.auth.login");
    }
    public function auth_login_admin(Request $request){
        $remember=!empty($request->remember)?true:false;
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password,'is_admin'=>1,'status'=>0,'is_delete'=>0],$remember)){
            return redirect(route("admin.dashboard"));
        }else{
            return redirect()->back()->with("error","Please enter currect email and password");
        }
    }
    public function logout_admin(){
        Auth::logout();
        session()->flash("success","Logout successfully");
        return redirect(url(''));
    }

    public function AuthRegister(Request $request){
        
        $checkEmail=User::checkEmail($request->email);
        if(empty($checkEmail)){
            $save=new User();
            $save->name=trim($request->name);
            $save->email=trim($request->email);
            $save->password=Hash::make($request->password);
            $save->save();


            Mail::to($save->email)->send(new RegisterMail($save));
            $json['status']=true;
            $json['message']='Your account register created. Please verify your email address';
        }else{
            $json['status']=false;
            $json['message']='This email already register please choose another';
        }
        echo json_encode($json);
    }
    public function ActiveEmail($id){
        $id=base64_decode($id);
        $user=User::getSingle($id);
        $user->email_verified_at=date('Y-m-d H:i:s');
        $user->save();
        return redirect(url(''))->with('success','Email successfully verified');
    }
    public function AuthLogin(Request $request){
        $remember=!empty($request->is_remember)?true:false;
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password,'status'=>0,'is_delete'=>0],$remember)){
            if(!empty(Auth::user()->email_verified_at)){
                $json['status']=true;
                $json['message']='success';
            }else{
                Mail::to(Auth::user()->email)->send(new RegisterMail(Auth::user()));
                Auth::logout();
                $json['status']=false;
                $json['message']='Your account email not verified. please check inbox email address';
            }
        }else{
            $json['status']=false;
            $json['message']='Please enter currect email and password';
        }
        echo json_encode($json);
    }
    public function ForgotPassword(Request $request)
    {
        $data['meta_title']="Forgot Password";
        return view('auth.forgot',$data);
    }
    public function AuthForgotPassword(Request $request)
    {
        $user=User::where('email','=',$request->email)->first();
        if(!empty($user))
        {
            $user->remember_token=Str::random(30);
            $user->save();
            Mail::to($user->email)->send(new ForgotPassword($user));
            return redirect()->back()->with('success',"Please check your email and reset your password");
        }else{
            return redirect()->back()->with('error',"Email not found in the system");
        }
    }
    public function ResetPassword($remember_token)
    {
        $user=User::where('remember_token','=',$remember_token)->first();
        if(!empty($user))
        {
            $data['user']=$user;
            $data['meta_title']="Reset Password";

            return view('auth.reset',$data);
        }else{
            abort(404);
        }
    }
    public function AuthResetPassword($remember_token,Request $request)
    {
        $validator=Validator::make($request->all(),[
            'password'=>'required|min:5',
            'cpassword'=>'required|same:password'
        ]);
        if($validator->passes()){
            $user=User::where('remember_token','=',$remember_token)->first();
            $user->password=Hash::make($request->password);
            $user->remember_token=Str::random(30);
            $user->email_verified_at=date('Y-m-d H:i:s');
            $user->save();
            return redirect(url(''))->with('success','Password successfully reset');
        }else{
            return back()
            ->withErrors($validator)
            ->withInput();
        }
    }
}
