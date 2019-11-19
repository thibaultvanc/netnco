<?php

namespace App;

use App\Tag;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded= [];

    public function author()
    {
        return $this->belongsTo(User::class);
    }
   
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_has_tags');
    }
}
