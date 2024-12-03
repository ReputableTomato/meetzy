<?php

namespace App\Http\Controllers\Chat;

use App\Facades\Chat\ChatServiceFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\Chat\ChatIndexRequest;
use Illuminate\Http\Request;
use Inertia\Response;

class ChatController extends Controller
{
    /**
     * @param ChatIndexRequest $request
     * @return \Inertia\Response
     */
    public function index(ChatIndexRequest $request): Response
    {
        return ChatServiceFacade::index($request);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
