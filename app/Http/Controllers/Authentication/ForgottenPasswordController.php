<?php

namespace App\Http\Controllers\Authentication;

use App\Facades\Authentication\ForgottenPasswordServiceFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\Authentication\ResetPasswordRequest;
use App\Http\Requests\Authentication\SaveNewPasswordRequest;
use App\Models\User\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ForgottenPasswordController extends Controller
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

        return Inertia::render('Auth/ForgottenPassword');
    }

    /**
     * @param Request $request
     * @return RedirectResponse|\Inertia\Response
     */
    public function resetRender(Request $request, $token)
    {
        if (auth()->check()) {
            return redirect()->route('home');
        }

        $user = User::where('password_reset_token', $token)->first();

        if (!$user) {
            return redirect()->route('login.render');
        }

        if ($user->password_reset_token_expires_at < now()) {
            return Inertia::render('Auth/ResetPassword', [
                'token' => $token,
                'error' => 'The password reset token has expired. Please request a new one.',
            ]);
        }

        return Inertia::render('Auth/ResetPassword', [
            'token' => $token,
        ]);
    }

    /**
     * @param ResetPasswordRequest $request
     * @return Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(ResetPasswordRequest $request): Response
    {
        return ForgottenPasswordServiceFacade::store($request);
    }

    /**
     * @param SaveNewPasswordRequest $request
     * @param $token
     * @return Response|RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function save(SaveNewPasswordRequest $request, $token): Response|RedirectResponse
    {
        return ForgottenPasswordServiceFacade::save($request, $token);
    }
}
