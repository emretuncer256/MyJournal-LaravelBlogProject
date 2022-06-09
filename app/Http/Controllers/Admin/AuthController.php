<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminModel as ADM;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function index()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remeber_me)) {
            toastr()->success('Giriş başarıyla gerçekleşti.', 'Tekrardan Hoş Geldin ' . Auth::user()->name);
            return redirect()->route('admin.dashboard')->with('success', 'Giriş başarıyla gerçekleşti.');
        }
        return redirect()->route('admin.login', $request->post())->withErrors('Email adresi veya Şifre hatalı.');
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        toastr()->success('Başarıyla çıkış yapıldı.', 'Görüşmek Üzere');
        return redirect()->route('admin.login')->with('success', 'Başarıyla çıkış yapıldı.');
    }
}
