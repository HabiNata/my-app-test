<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{

    protected $table = 'categories';

    public function PostModels()
    {
        return $this->hasMany(PostModel::class, 'category_id');
    }
}
