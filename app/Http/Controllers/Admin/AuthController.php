<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class AuthController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout','index');
    //     $this->middleware('auth')->except('login');
    // }

    public function index(Request $request)
    {

        if(!Auth::check() && $request->path() != 'login'){
            return redirect('/login');
        }
        if(!Auth::check() && $request->path() == 'login'){
            return view('index');
        }

        $user = Auth::user();

        if($user->role->isAdmin == '0'){
            return redirect('/login');

        }

        if($request->path() == 'login'){
            return redirect('/');

        }
        return $this->checkPermission($user,$request);

    }
    public function checkPermission($user, $request){
         $permission = json_decode($user->role->permission);
         $hasPermission = false;
         if (!$permission) {
             return view('index');
         }
         foreach ($permission as $permis) {
             if($permis->name == $request->path()){
                 if($permis->read){
                     $hasPermission = true;
                 }
             }
         }
         if ($hasPermission) {
             return view('index');
         }else {
             return abort(404);
         }

    }

    //
    public function login(Request $request)
    {
        # code...
        $this->validate($request,[
            'email' => 'bail|required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        if(Auth::attempt($credentials)){

            $user = Auth::user();
            if ($user->role->isAdmin == 0){
                Auth::logout();
                return  response()->json([
                            'msg' => 'Access denied'
                        ],401);
            }else{
                return  response()->json([
                            'msg' => 'Access available'
                        ]);
            }
        }else {
            return  response()->json([
                        'msg' => 'Incorrect login details'
                    ],401);
        }

    }

    public function logout()
    {
        # code...
        Auth::logout();
        return redirect('/login');
    }
}
