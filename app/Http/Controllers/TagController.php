<?php

namespace App\Http\Controllers;

use App\TagModel;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function show(TagModel $tag)
    {
        $posts = $tag->PostModels()->latest()->paginate(6);

        return view('post.index', compact('posts', 'tag'));
    }
}
