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

        if($user->userType == 'user'){
            return redirect('/login');

        }

        if($request->path() == 'login'){
            return redirect('/');

        }
        return view('index');

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
            if ($user->userType == 'user'){
                Auth::logout();
                return  response()->json([
                            'msg' => 'Incorrect login details'
                        ],401);
            }else{
                return  response()->json([
                            'msg' => 'login'
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
