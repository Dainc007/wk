<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreGameRequest;
use App\Http\Requests\UpdateGameRequest;
use App\Models\Game;

final class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): void
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): void
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGameRequest $request): void
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Game $game): void
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Game $game): void
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGameRequest $request, Game $game): void
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Game $game): void
    {
        //
    }
}
