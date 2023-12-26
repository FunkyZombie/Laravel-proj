<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use App\Services\Contracts\Social;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Laravel\Socialite\Contracts\User as SocialUser;

class SocialService implements Social
{
	/**
	 * @param \Laravel\Socialite\Contracts\User $socialUser
	 * @return string
	 */
	public function loginAndGetRedirectUrl(SocialUser $socialUser): string
    {
        $user = User::query()->where('email', '=', $socialUser->getEmail())->first();
        
        if ($user == null) {
            //registration
            return route('register');
        }

        $user->name = $socialUser->getName();
        $user->avatar = $socialUser->getAvatar();

        if ($user->save()) {
            Auth::loginUsingId($user->id);
            return route('account');
        }

        throw new \Exception('Did not save user');
	}
}