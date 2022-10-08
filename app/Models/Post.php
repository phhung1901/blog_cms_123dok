<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    protected $table = 'posts';

    protected $guarded = ['id'];

    public function category() {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function author() {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function tags() {
        return $this->belongsToMany(Tag::class, 'post_tag');
    }
}
