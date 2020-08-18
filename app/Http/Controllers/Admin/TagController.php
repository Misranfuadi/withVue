<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Tag;

class TagController extends Controller
{
    public function dataTag()
    {
        return Tag::orderBy('created_at','DESC')->get();
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
