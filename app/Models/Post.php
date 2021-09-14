<?php

namespace App\Models;

use App\Traits\ApiTraits;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory, ApiTraits;

    const ERASER = 1;
    const PUBLISHED = 2;

    protected $fillable = ['category_id', 'user_id', 'name', 'slug', 'extract', 'body', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
