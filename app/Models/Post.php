<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    protected $fillable = ['title', 'content', 'category_id', 'status', 'publish_at'];
    protected $guarded = ['id'];
    protected $dates = ['publish_at'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function scopeSearchByCategory($query, $category)
    {
        return $query->whereHas('category', function ($query) use ($category) {
            $query->where('name', 'like', '%' . $category . '%');
        });
    }

}