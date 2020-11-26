@extends('layouts.app')

@section('contents')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Change Password') }}</div>

                    <div class="card-body">
                        <form action="/account/password/update" method="post">
                            @csrf
                            @method('patch')
                            <div class="form-group">
                                <label for="old-password">Old Password</label>
                                <input type="password" name="old-password" id='old-password'
                                    class="form-control @error('old-password') is-invalid @enderror">
                                @error('old-password')

                                    <div class="invalid-feedback">

                                        {{ $message }}

                                    </div>

                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="new-password">New Password</label>
                                <input type="password" name="new-password" id='new-password'
                                    class="form-control @error(new-password) is-invalid @enderror">
                                @error('new-password')

                                    <div class="invalid-feedback">

                                        {{ $message }}

                                    </div>

                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Old Password</label>
                                <input type="password" name="password_confirmation" id='password_confirmation'
                                    class="form-control @error('password_confirmation') is-invalid @enderror">
                                @error('password_confirmation'')

                                    <div class="invalid-feedback">

                                        {{ $message }}

                                    </div>

                                @enderror
                            </div>
                            <button class="btn btn-primary" type="submit">Changer Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
