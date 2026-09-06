<?php

namespace App\Http\Controllers;

use App\Models\GuestLog;
use App\Http\Requests\StoreGuestLogRequest;
use App\Http\Requests\UpdateGuestLogRequest;

class GuestLogController extends Controller
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
    public function store(StoreGuestLogRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(GuestLog $guestLog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GuestLog $guestLog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGuestLogRequest $request, GuestLog $guestLog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GuestLog $guestLog)
    {
        //
    }
}
