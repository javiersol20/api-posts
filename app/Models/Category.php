<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\ApiTraits;

class Category extends Model
{
    use HasFactory, ApiTraits;
    protected $allowInclude = ['posts', 'posts.user'];
    protected $allowFilter = ['id','name','slug'];
    protected $allowSort = ['id','name','slug'];
    protected $fillable = ['name', 'slug'];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }


}
