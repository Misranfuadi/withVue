<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Tag;

class TagController extends Controller
{
    public function dataTag()
    {
        if (request()->ajax()){
            return Tag::select('id','tagName','created_at')->orderBy('created_at','DESC')->get();
        }else{
            return abort(404);
        }

    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'tagName'=> 'required'
        ]);

        return Tag::create([
            'tagName' => $request->tagName
        ]);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'tagName'=> 'required',
            'id'=> 'required'
        ]);

        return Tag::where('id', $request->id)->update([
            'tagName' => $request->tagName
        ]);
    }

    public function destroy(Request $request)
    {
        $this->validate($request, [
            'id'=> 'required'
        ]);

        return Tag::where('id', $request->id)->delete();
    }
}
