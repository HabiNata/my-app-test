<?php

namespace App\Http\Controllers\account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    public function edit()
    {
        return view('password.edit');
    }

    public function update()
    {
        request()->validate([
            'old-password' => 'required',
            'new-password' => ['required', 'min:8', 'confirmed', 'string'],
        ]);
    }
}
