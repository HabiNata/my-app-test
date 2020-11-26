@extends('layouts.app')

@section('title', 'Create')

@section('contents')

    <div class="container">

        <div class="row">

            <div class="col-md-6">

                <div class="card">
                    <div class="card-header">Create a New Post</div>

                    <div class="card-body">

                        <form action="/post/store" method="POST">

                            {{ csrf_field() }}

                            @include('post.partials.form-control', ['submit' => 'Create'])

                        </form>

                    </div>
                </div>

            </div>

        </div>

    </div>

@endsection
