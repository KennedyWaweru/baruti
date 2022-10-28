<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use Exception;
use App\User;
use Illuminate\Support\Facades\Auth;

class FacebookController extends Controller
{
    // Social Login using Facebook ]

    public function redirectToFacebook(){
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback(){
        try{
            $user = Socialite::driver('facebook')->user();

            $saveUser = User::updateOrCreate(
                [
                    'facebook_id' => $user->getId(),
                ],
                [
                    'name' => $user->getName(),
                    'email' => $user->getEmail(),
                    'password' => Hash::make(Str::random(20))
                ]
                );

            Auth::loginUsingId($saveUser->id);
            return redirect()->route('base');
        }catch(Exception $e){
            dd($e->getMessage());
        }
    }
}
