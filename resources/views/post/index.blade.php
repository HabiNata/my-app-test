@extends('layouts.app')

@section('title', 'Index')

@section('contents')

    <div class="container">

        <div class="d-flex justify-content-between mb-2">

            <div>

                @isset($category)

                    <h4>Category : {{ $category->name }} </h4>

                @endisset

                @isset($tag)

                    <h4>Tag : {{ $tag->name }}</h4>

                @endisset

                @if (!isset($category) && !isset($tag))

                    <h4>All Post</h4>

                @endif

            </div>

            <div>
                @if (Auth::check())
                    <a href="/post/create" class="btn btn-primary">New Post</a>
                @else
                    <a href="/login" class="btn btn-primary">Login to create post</a>
                @endif

            </div>

        </div>

        <div class="row">

            @forelse ($posts as $post)
                <div class="col-md-4 mb-4">

                    <div class="card mb-4 h-100 mh-100">

                        <div class="card-header">

                            {{ $post->title }}

                        </div>

                        <div class="card-body">

                            <div>
                                {{ Str::limit($post->body, 100) }}
                            </div>

                            <a href="/post/{{ $post->slug }}">Read More</a>

                        </div>

                        <div class="card-footer">

                           <div class="d-flex justify-content-between">

                            <div>

                                Create At.

                                {{ $post->created_at->diffForHumans() }}

                                {{-- {{ $post->created_at->format('; d, M Y') }} --}}

                            </div>

                            <div>

                                @if (Auth::check())
                                    <a href="/post/{{ $post->slug }}/edit" class="btn btn-sm btn-primary">Edit</a>
                                @endif

                            </div>

                           </div>

                        </div>

                    </div>

                </div>

            @empty

                <div class="alert alert-danger text-danger">

                    There's no Post.

                </div>

            @endforelse

        </div>

        <div class="d-flex justify-content-center">

            {{ $posts->links() }}

        </div>

    </div>

@endsection
