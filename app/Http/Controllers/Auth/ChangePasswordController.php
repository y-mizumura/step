<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Support\Facades\Auth;

class ChangePasswordController extends Controller
{
    public function showChangePasswordForm()
    {
       return view('auth/passwords/change');
    }
      
    public function changePassword(ChangePasswordRequest $request)
    {
        //パスワード変更処理
        $user = Auth::user();
        $user->password = bcrypt($request->get('password'));
        $user->save();

        // パスワード変更処理後、homeにリダイレクト
        return redirect()->route('password.form')->with('status', 'パスワードが変更されました。');
    }
}
