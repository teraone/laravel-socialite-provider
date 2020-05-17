<?php

namespace HelloOne\Laravel\Socialite;


use Illuminate\Routing\Controller;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectToProvider(\Illuminate\Http\Request $request)
    {
       return Socialite::driver('hello-one-guest')->redirect();

    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('hello-one-project-guest')->user();

        dd( $user);
    }
}
