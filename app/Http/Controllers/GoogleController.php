<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use Exception;
use App\User;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    // Login with google
    public function redirectToGoogle(){
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(){
        try{

            $user = Socialite::driver('google')->user();

            $finduser = User::where('google_id', $user->id)->first();

            if($finduser){
                Auth::login($finduser);

                return redirect()->intended('dashboard');
            }else{
                $newuser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id' => $user->id,
                    'password' => Hash::make(Str::random(20))
                ]);

                Auth::login($newuser);

                return redirect()->intended('dashboard');
            }

        }catch(Exception $e){
            dd($e->getMessage());
        }
    }
}
