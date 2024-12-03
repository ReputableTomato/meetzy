<?php

namespace App\Http\Controllers\Authentication;

use App\Facades\Authentication\AuthenticationServiceFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\Authentication\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AuthenticationController extends Controller
{
    /**
     * @param Request $request
     * @return RedirectResponse|\Inertia\Response
     */
    public function render(Request $request)
    {
        if (auth()->check()) {
            return redirect()->route('home');
        }

        return Inertia::render('Auth/Login');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function destroy(Request $request): RedirectResponse
    {
        if (!auth()->check()) {
            return redirect()->route('login.render');
        }

        auth()->logout();

        return redirect()->route('login.render');
    }

    /**
     * @param LoginRequest $request
     * @return RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        return AuthenticationServiceFacade::authenticate($request);
    }
}
