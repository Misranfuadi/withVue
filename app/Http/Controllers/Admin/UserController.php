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
        if (request()->ajax()){
            $user = User::orderBy('created_at','DESC')->with('role')->get();
             return $user;
        }else{
            return abort(404);
        }

    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'fullName'=> 'required',
            'email'=> 'bail|required|email|unique:users,email',
            'password'=> 'bail|required|min:4',
            'role_id'=> 'required'
        ]);

        $user =  User::create([
            'fullName' => $request->fullName,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => $request->role_id
        ]);

        return $user;
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'fullName'=> 'required',
            'email'=> "bail|required|email|unique:users,email,$request->id",
            'password'=> 'nullable|min:4',
            'role_id'=> 'required'
        ]);

        $data = [ 'fullName' => $request->fullName,
            'email' => $request->email,
            'role_id' => $request->role_id];

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
