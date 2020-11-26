@extends('layouts.app')

@section('title', 'Post')

@section('contents')

    <div class="container">

        <div>

            <h3>{{ $post->title }}</h3>

            <div class="text-secondary">
                <a href="/category/{{ $post->CategoryModel->slug }}">{{ $post->CategoryModel->name }}</a>
                &middot; {{ $post->CategoryModel->created_at->format('d F, Y') }}
                &middot;
                @foreach ($post->TagModels as $tag)
                    <a href="/tag/{{ $tag->slug }}">{{ $tag->name }}</a>
                @endforeach
            </div>

            <hr>

            <p>
                {{ $post->body }}
            </p>

            @if (Auth::check())
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-link text-danger text-sm p-0" data-toggle="modal"
                    data-target="#exampleModal">

                    Delete

                </button>
            @endif

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">

                <div class="modal-dialog" role="document">

                    <div class="modal-content">

                        <div class="modal-header">

                            <h5 class="modal-title" id="exampleModalLabel">Anda yakin ?</h5>

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                <span aria-hidden="true">&times;</span>

                            </button>

                        </div>

                        <div class="modal-body">

                            <form action="/post/{{ $post->slug }}/delete" method="post">

                                @method('delete')

                                {{ csrf_field() }}

                                <div class="mb-2">

                                    <div>

                                        {{ $post->title }}

                                    </div>

                                    <div>

                                        <small class="text-secunder"> {{ $post->created_at->format('d, M Y') }} </small>

                                    </div>

                                </div>

                                <button class="btn btn-danger btn-sm" type="submit">YA</button>

                                <button type="button" class="btn btn-success btn-sm" data-dismiss="modal">Tidak</button>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
