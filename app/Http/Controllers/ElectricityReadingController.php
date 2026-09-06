<?php

namespace App\Http\Controllers;

use App\Models\ElectricityReading;
use App\Http\Requests\StoreElectricityReadingRequest;
use App\Http\Requests\UpdateElectricityReadingRequest;

class ElectricityReadingController extends Controller
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
    public function store(StoreElectricityReadingRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ElectricityReading $electricityReading)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ElectricityReading $electricityReading)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateElectricityReadingRequest $request, ElectricityReading $electricityReading)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ElectricityReading $electricityReading)
    {
        //
    }
}
