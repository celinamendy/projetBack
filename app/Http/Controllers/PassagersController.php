<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePassagersRequest;
use App\Http\Requests\UpdatePassagersRequest;
use App\Models\Passagers;

class PassagersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StorePassagersRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Passagers $passagers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Passagers $passagers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePassagersRequest $request, Passagers $passagers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Passagers $passagers)
    {
        //
    }
}
