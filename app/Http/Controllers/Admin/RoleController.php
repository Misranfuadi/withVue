<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Role;

class RoleController extends Controller
{
    public function dataRole()
    {
        if (request()->ajax()){
            return Role::orderBy('created_at','DESC')->get();
        }else{
            return abort(404);
        }

    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'roleName'=> 'bail|required|unique:roles,roleName'
        ]);

        return Role::create([
            'roleName' => $request->roleName
        ]);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'roleName'=> "bail|required|unique:roles,roleName,$request->id",
            'id'=> 'required'
        ]);

        return Role::where('id', $request->id)->update([
            'roleName' => $request->roleName
        ]);
    }

    public function destroy(Request $request)
    {
        $this->validate($request, [
            'id'=> 'required'
        ]);

        return Role::where('id', $request->id)->delete();
    }
}
