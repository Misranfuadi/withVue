<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;

class AdminController extends Controller
{
    //

    public function dataTag()
    {
        return Tag::orderBy('created_at','DESC')->get();
    }

    public function storeTag(Request $request)
    {
        $this->validate($request, [
            'tagName'=> 'required'
        ]);

        return Tag::create([
            'tagName' => $request->tagName
        ]);
    }

    public function updateTag(Request $request)
    {
        $this->validate($request, [
            'tagName'=> 'required',
            'id'=> 'required'
        ]);

        return Tag::where('id', $request->id)->update([
            'tagName' => $request->tagName
        ]);
    }
}
