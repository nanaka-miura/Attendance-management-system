<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AdminLoginRequest;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function adminLogin()
    {
        return view('admin/admin-login');
    }

    public function adminDoLogin(AdminLoginRequest $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();

            if ($user->admin_status) {
                return redirect('admin/attendance/list');
            } else {
                Auth::logout();
                return redirect('/admin/login');
            }
        }
    }

    public function adminLogout()
    {
        Auth::logout();
        return redirect('/admin/login');
    }


    public function store(Request $request)
    {
        $user = $this->creator->create($request->all());
        $user->sendEmailVerificationNotification();
        return redirect('/register')->with('message', '登録が完了しました。認証メールを送信しましたのでご確認ください。');
    }

    public function doLogin(Request $request)
    {

    $credentials = $request->only('email', 'password');

    $user = \App\Models\User::where('email', $credentials['email'])->first();

    if ($user && !$user->hasVerifiedEmail()) {
        $this->sendVerificationEmail($user);
        return redirect()->back()->withErrors([
            'email' => 'メール認証が必要です。認証メールを再送信しました。'
        ]);
    }

    if (Auth::attempt($credentials)) {
        return redirect()->intended('/login');
    }

    return redirect()->back()->withErrors([
        'email' => 'ログイン情報が登録されていません'
    ]);
    }

    protected function sendVerificationEmail($user)
    {
        $user->sendEmailVerificationNotification();
    }


}