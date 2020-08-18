<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{

    public function dataCategory()
    {
        return Category::orderBy('created_at','DESC')->get();
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=> 'required',
            'iconImage'=> 'required'
        ]);

        return Category::create([
            'name' => $request->name,
            'iconImage' => $request->iconImage
        ]);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name'=> 'required',
            'iconImage'=> 'required',
            'id'=> 'required'
        ]);

        return Category::where('id', $request->id)->update([
            'name' => $request->name,
            'iconImage' => $request->iconImage
        ]);
    }

    public function destroy(Request $request)
    {
        $this->validate($request, [
            'id'=> 'required'
        ]);

        $fileName = $request->iconImage;
        $filePath = public_path('uploads/category/'.$fileName);

       if(file_exists($filePath)){
           unlink($filePath);
       }

        return Category::where('id', $request->id)->delete();
    }

    public function uploadImage(Request $request)
    {
        $this->validate($request,[
            'file' => 'required|max:2048|mimes:jpeg,jpg,png'
        ]);
        $fotoName = time().'.'.$request->file->extension();
        $request->file->move(public_path('uploads/category'),$fotoName);
        return $fotoName;
    }

    public function deleteImage(Request $request)
    {
       $fileName = $request->imageName;
       $filePath = public_path('uploads/category/'.$fileName);

       if(file_exists($filePath)){
           unlink($filePath);
       }
       return $fileName.' has been delete';
    }
}
