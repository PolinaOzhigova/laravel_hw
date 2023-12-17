<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;
    protected $fillable = ['post_id', 'content'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}