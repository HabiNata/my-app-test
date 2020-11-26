@extends('layouts.app')

@section('title', 'Create')

@section('contents')

    <div class="container">

        @include('alert')

        <div class="row">

            <div class="col-md-6">

                <div class="card">

                    <div class="card-header">Update : {{ $post->slug }}</div>

                    <div class="card-body">

                        <form action="/post/{{ $post->slug }}/update" method="POST">

                            @method('patch')

                            {{ csrf_field() }}

                            @include('post.partials.form-control')

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
