<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    //
    public function index()
    {
        $data = ['msg' =>'Hanya json'];
        $headers = ['type'=>'null'];
        return response()->json($data, 200,$headers);
    }
}
