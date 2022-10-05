<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'id',
        'parent_id',
        'name',
        'slug',
        'description'
    ];

    protected $guarded = [];

    public function categories(): HasMany
    {
        return $this->hasMany(Category::class, "parent_id");
    }

    public function allCategories(): HasMany
    {
        return $this->categories()->with("allCategories");
    }
}
