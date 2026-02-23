<?php

namespace App\Controllers;

/**
 * AuthController - Handles authentication views redirect
 *
 * Login/Register views are handled by Shield automatically
 * via Config\Auth::$views configuration.
 */
class AuthController extends BaseController
{
    /**
     * Redirect root URL ke login atau dashboard
     */
    public function login()
    {
        if (auth()->loggedIn()) {
            return redirect()->to('/dashboard');
        }

        return redirect()->to(url_to('login'));
    }
}
