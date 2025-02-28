<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function google_login()
    {
        return Socialite::driver('google')->redirect();
    }


    public function google_callback()
    {
        $user = Socialite::driver('google')->user();

        $oldUser = User::where('email', $user->email)->first();
        if($oldUser) {
            Auth::login($oldUser);
            return redirect('/');
        }

        $newUser = new User();
        $newUser->name = $user->name;
        $newUser->email = $user->email;
        $newUser->password = Hash::make(uniqid());
        $newUser->save();
        Auth::login($newUser);
        return redirect('/');
    }
}
