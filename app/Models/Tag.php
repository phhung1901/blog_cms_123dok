<?php

namespace App\Models;

use App\Libs\StringUtils;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $table = 'tags';

    protected $guarded = ['id'];

    public function save(array $options = [])
    {
        if (empty($this->length)) {
            $this->length = StringUtils::wordsCount($this->name);
        }
        return parent::save($options);
    }

    public function posts() {
        $this->belongsToMany(Post::class, 'post_tag');
    }
}
