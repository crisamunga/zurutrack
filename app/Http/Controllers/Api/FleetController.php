<?php

namespace App\Http\Controllers\Api;

use App\Fleet;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateFleetRequest;
use App\Http\Requests\Api\UpdateFleetRequest;
use App\Http\Resources\Api\FleetResource;
use Illuminate\Support\Facades\Auth;

class FleetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fleets = Auth::user()->fleets;
        return FleetResource::collection($fleets);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateFleetRequest $request)
    {
        $data = $request->validated();
        $fleet = Fleet::create($data);
        $user = Auth::user();
        $user->fleets()->save($fleet);
        return new FleetResource($fleet);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Fleet  $fleet
     * @return \Illuminate\Http\Response
     */
    public function show(Fleet $fleet)
    {
        return new FleetResource($fleet);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Fleet  $fleet
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFleetRequest $request, Fleet $fleet)
    {
        $data = $request->validated();
        $fleet->fill($data)->save();
        return new FleetResource($fleet);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Fleet  $fleet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fleet $fleet)
    {
        $fleet->delete();
        return response()->json(['message' => 'Fleet deleted'], 200);
    }
}
