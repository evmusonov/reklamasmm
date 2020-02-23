<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Components\FileHelper;
use App\File;
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

    public function deleteFile()
    {
        if(request('module') && request('content_id') && request('filename')) {
            $filePath = config('filehelper.pathToStorage') . '/app/public/' . request('module') . '/' . request('content_id');
            if (is_dir($filePath)) {
                FileHelper::deleteDirectory($filePath);
            }
            File::where([
                ['module', request('module')],
                ['content_id', request('content_id')],
                ['filename', request('filename')]
            ])->delete();

            return 1;
        }

        return 0;
    }
}
