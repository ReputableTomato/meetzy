<?php

namespace App\Http\Controllers\Authentication;

use App\Facades\Authentication\AuthenticationServiceFacade;
use App\Facades\Authentication\RegistrationServiceFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\Authentication\RegistrationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class RegistrationController extends Controller
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

        return Inertia::render('Auth/Registration');
    }

    /**
     * @param RegistrationRequest $request
     * @return Response
     */
    public function store(RegistrationRequest $request): Response
    {
        return RegistrationServiceFacade::register($request);
    }
}
