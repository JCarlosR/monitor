<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Socialite;

use App\User;

class SocialiteController extends Controller
{
    private $availableDrivers = [
        'facebook', 'twitter', 'google'
    ];

    public function redirectToProvider($provider)
    {
        if (!in_array($provider, $this->availableDrivers)) {
            return redirect()->route('login');
        }

        return Socialite::driver($provider)->redirect();            
    }

    public function handleProviderCallback($provider)
    {
        if (!in_array($provider, $this->availableDrivers)) {
            return redirect()->route('login');
        }

        $userSocialite = Socialite::driver($provider)->user();
        
        // dd($userSocialite);

        if ($userSocialite->getEmail()) {
            $user = User::where('email', $userSocialite->getEmail())->first();    
        } else {
            $user = User::where($provider . '_id', $userSocialite->getId())->first();
        }
        
        if ($user) {
            // update user information
            $user->update([
                'name' => $userSocialite->getName(),
                $provider . '_id' => $userSocialite->getId(),
                'avatar' => $userSocialite->getAvatar(),
                'nick' => $userSocialite->getNickname()
            ]);
        } else {
            // create based on the received data
            $user = User::create([
                'name' => $userSocialite->getName(),
                'email' => $userSocialite->getEmail(),
                'password' => '',

                $provider . '_id' => $userSocialite->getId(),
                'avatar' => $userSocialite->getAvatar(),
                'nick' => $userSocialite->getNickname()
            ]);
        }       

        auth()->login($user);
        return redirect()->route('home');
    }

}
