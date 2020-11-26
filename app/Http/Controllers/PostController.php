<?php

namespace App\Http\Controllers;

use App\{CategoryModel, PostModel, TagModel};

use Illuminate\Support\Str;

use App\Http\Controllers\Controller;

use App\Http\Requests\PostRequest;
use phpDocumentor\Reflection\DocBlock\Tag;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'verified'])->except(['Index', 'show']);
    }

    public function Index()
    {
        $posts = PostModel::latest()->paginate(6);

        return view('post.index', compact('posts'));
    }

    public function Show(PostModel $post)
    {

        // dd($post);
        return view('post.show', compact('post'));
    }

    public function create()
    {
        return view('post.create', [
            'post' => new PostModel(),
            'category'=>CategoryModel::get(),
            'tag'=>TagModel::get(),
        ]);
    }

    public function store(PostRequest $request)
    {
        // +++++Cara Ke 1++++
        // $post = new PostModel();

        // $post->title = $request->title;

        // $post->slug = Str::slug($request->title);

        // $post->body = $request->body;

        // $post->save();

        // ++++Cara Ke 2++++
        // $request->validate([

        //     'title'=>'required|min:3',

        //     'body'=>'required',

        // ]);

        // PostModel::create([

        //     'title'=>$request->title,

        //     'slug'=>Str::slug($request->title),

        //     'body'=>$request->body,

        // ]);

        //+++Cara Ke 3+++++

        /// Validasi yang di panggil; Ada di bawah !
        // $post = $this->validateRequest($request);

        // dd(request()->tag);

        $post = $request->all();

        $post['slug'] = Str::slug($request->title);

        $post['category_id'] = $request->category;

        $post = PostModel::create($post);

        $post->TagModels()->attach($request->tag);

        session()->flash('success', 'Create Post Success');

        return redirect('post');
        // return back();
    }

    public function edit(PostModel $post)
    {
        return view('post.edit', [
            'post'=>$post,
            'category'=>CategoryModel::get(),
            'tag'=>TagModel::get(),
        ]);
    }

    public function update(PostRequest $request, PostModel $post)
    {

        // $update['slug'] = Str::slug($request->title);

        // PostModel::table('post')->update($update);

        /// Validasi yang di panggil; Ada di bawah !
        // $update = $this->validateRequest($request);

        $update = $request->all();

        dd($update);

        $update['category_id'] = $request->category;

        $post->update($update);

        // $post->TagModels()->sync($request->tag);

        session()->flash('success', 'Update Post Success');

        return redirect('post');

        // return back();

        // dd('coba');
    }

    // pemanggilan validasi agar rapih !!!!!
    // public function validateRequest(Request $request)
    // {
    //     return $request->validate([

    //         'title'=>'required|min:3',

    //         'body'=>'required',

    //     ]);
    // }

    public function delete(PostModel $post)
    {
        // dd($post);
        $post->TagModels()->detach();

        $post->delete();

        session()->flash('success', 'Delete Post Success');

        return redirect('post');

    }
}
