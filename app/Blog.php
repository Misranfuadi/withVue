<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Blog extends Model
{
    //
    protected $fillable = ['title','post','jsonData','post_excerpt','slug','featuredImage','user_id','metaDescription','views'];

    public function setSlugAttribute($title){
        $this->attributes['slug'] = $this->uniqueSlug($title);
    }

    public function uniqueSlug($title){
        $slug = Str::slug($title,'-');
        $count = Blog::where('slug','LIKE', "{$slug}%")->count();
        $newCount = $count > 0  ? ++$count : '';
        return $newCount > 0 ? "$slug-$newCount": $slug;

    }
}
