<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Fixture\StoreFixtureRequest;
use App\Http\Requests\Fixture\UpdateFixtureRequest;
use App\Models\Fixture;

final class FixtureController extends Controller
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
    public function store(StoreFixtureRequest $request): void
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Fixture $fixture): void
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fixture $fixture): void
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFixtureRequest $request, Fixture $fixture): void
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fixture $fixture): void
    {
        //
    }
}
