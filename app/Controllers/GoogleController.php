<?php

namespace Ducnm\app\Controllers;

use App\Http\Controllers\Controller;
use Ducnm\app\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{

    public function redirectToGoogle(): RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Create a new controller instance.
     *
     * @return RedirectResponse
     */
    public function handleGoogleCallback(): RedirectResponse
    {
//        try {

            $user = Socialite::driver('google')->user();

            $finduser = User::where('google_id', $user->id)->first();

            if ($finduser) {

                Auth::login($finduser);
                \Log::info('Tài khoản '.$finduser->name.' đã đang nhập hệ thống');
                return redirect()->intended('dashboard');

            } else {
                $getUserByEmail = User::where('email', $user->email)->first();
                if ($getUserByEmail) {
                    $getUserByEmail->google_id = $user->id;
                    $getUserByEmail->save();
                } else {
                    $newUser = User::create([
                        'name' => $user->name,
                        'email' => $user->email,
                        'google_id' => $user->id,
                        'password' => encrypt('123456aA@')
                    ]);
                }

                Auth::login($newUser);
                \Log::info('Tạo khoản tạo mới '.$user->name.' đã đang nhập hệ thống');
                return redirect()->intended('/');
            }

//        } catch (Exception $e) {
//            \Log::error($e->getMessage());
//        }
    }
}
