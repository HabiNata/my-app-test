<?php

namespace App;

use Highlight\Mode;
use Illuminate\Database\Eloquent\Model;
use League\CommonMark\Extension\Table\Table;
use Carbon\Carbon;

class PostModel extends Model
{
    protected $table = "post";

    protected $fillable = ['title', 'slug', 'body', 'category_id'];

    public function CategoryModel()
    {
        return $this->belongsTo(CategoryModel::class, 'category_id');
    }

    public function TagModels()
    {
        return $this->belongsToMany(TagModel::class, 'post_tag', 'post_id', 'tag_id');
    }

    // protected $guarded = [];
}
