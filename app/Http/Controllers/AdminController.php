<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function login()
    {
        if (Auth::check()) {
            return redirect('/');
        }

        return view('admin.login');
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }

    public function auth()
    {
        $validatedData = request()->validate([
            'login'    => 'required',
            'password' => 'required',
            'remember' => 'nullable|string'
        ]);

        if (Admin::auth($validatedData)) {
            return redirect('/admin');
        } else {
            return redirect('/admin/login')->with('status', 'Неверный логин или пароль');
        }
    }
}
