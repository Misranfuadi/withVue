<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    //

    public function dataUser()
    {
        return User::where('userType','!=','user')->orderBy('created_at','DESC')->get();
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'fullName'=> 'required',
            'email'=> 'bail|required|email|unique:users,email',
            'password'=> 'bail|required|min:4',
            'userType'=> 'required',
        ]);

        $user =  User::create([
            'fullName' => $request->fullName,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'userType' => $request->userType,
        ]);

        return $user;
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'fullName'=> 'required',
            'email'=> "bail|required|email|unique:users,email,$request->id",
            'password'=> 'nullable|min:4',
            'userType'=> 'required',
        ]);

        $data = [ 'fullName' => $request->fullName,
            'email' => $request->email,
            'userType' => $request->userType,];

        if($request->password){
            $data['password'] = bcrypt($request->password);
        }

        $user =  User::where('id', $request->id)->update($data);

        return $user;
    }

    public function destroy(Request $request)
    {
        $this->validate($request, [
            'id'=> 'required'
        ]);

        return user::where('id', $request->id)->delete();
    }
}
