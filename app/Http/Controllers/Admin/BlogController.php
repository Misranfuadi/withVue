<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Blog;
use App\Blogcategory;
use App\Blogtag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    //

     public function uploadImage(Request $request)
    {
        $this->validate($request,[
            'image' => 'required|max:2048|mimes:jpeg,jpg,png'
        ]);
        $fotoName = time().'.'.$request->image->extension();
        $request->image->move(public_path('uploads/blogImage'),$fotoName);
        return response()->json([
            'success' =>1,
            'file' => [
                'url' => "/uploads/blogImage/$fotoName"
            ]
        ]);
    }

    public function createBlog(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'post' => 'required',
            'post_excerpt' => 'required',
            'metaDescription' => 'required',
            'jsonData' => 'required',
            'category_id' => 'required',
            'tag_id' => 'required',
        ]);
        $tags = $request->tag_id;
        $blogTags = [];

        DB::beginTransaction();
        try {
            $blog = Blog::create([
                'title' => $request->title,
                'slug' => $request->title,
                'post' => $request->post,
                'post_excerpt' => $request->post_excerpt,
                'user_id' => Auth::user()->id,
                'metaDescription' => $request->metaDescription,
                'jsonData' => $request->jsonData,
            ]);
            // insert blog categories

            Blogcategory::create(['blog_id'=>$blog->id , 'category_id'=>$request->category_id]);
            //insert blog tags
            foreach ($tags as $t) {
                array_push($blogTags, ['tag_id' => $t, 'blog_id' => $blog->id]);
            }
            Blogtag::insert($blogTags);
            DB::commit();
            return 'done';
        } catch (\Throwable $th) {
            DB::rollback();
            return 'not done';
        }
    }
}
