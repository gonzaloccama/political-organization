<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Exception;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function goToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function goHandleCallback()
    {
        try {
            $user = Socialite::driver('google')->stateless()->user();

            $verify_user = User::where('user_media_id', $user->id)->first();

            if ($verify_user) {

                Auth::login($verify_user);

                return redirect($this->redirectTo());

            } else {
                $verify_email = User::where('email', $user->email)->first();

                if ($verify_email) {
                    $verify_email->user_media_id = $user->id;
                    $verify_email->media_type = 'google';

                    if ($verify_email->save()) {
                        Auth::login($verify_email);
                        return redirect($this->redirectTo());
                    }
                } else {
                    return redirect('login')->with('error', 'El usuario no tiene autorización para ingresar.');
                }
            }

        } catch (Exception $exception) {
            return redirect('login')->with('error', 'Algo salio mal con las credenciales.');
        }
    }


    protected function redirectTo()
    {
        if (Auth::user()->user_group == 1) {
            return route('admin.dashboard');  // admin dashboard path
        } else {
            return route('home');  // member dashboard path
        }
    }
}
