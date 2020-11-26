<?php

namespace App\Http\Controllers;

use App\CategoryModel;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(CategoryModel $category)
    {

        $posts = $category->PostModels()->latest()->paginate(6);

        // dd($post);

        return view('post.index', compact('posts', 'category') );

    }
}
