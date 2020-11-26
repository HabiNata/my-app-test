<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TagModel extends Model
{
    protected $table = 'tag';

    public function PostModels()
    {
        return $this->belongsToMany(PostModel::class, 'post_tag','tag_id', 'post_id');
    }
}
