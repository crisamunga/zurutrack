<?php

namespace App\Http\Controllers\Api;

use App\Tracker;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Api\TrackerResource;
use App\Http\Requests\Api\CreateTrackerRequest;
use App\Http\Requests\Api\UpdateTrackerRequest;
use App\Http\Resources\UserResource;

class TrackerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $trackers = $user->trackers()->with('tracker_model')->get();
        return TrackerResource::collection($trackers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTrackerRequest $request)
    {
        $data = $request->validated();
        $user = Auth::user();
        $data['added_by_id'] = $user->id;
        $tracker = Tracker::create($data);
        $tracker->users()->save($user, ['is_admin' => true]);
        return new TrackerResource($tracker);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tracker  $tracker
     * @return \Illuminate\Http\Response
     */
    public function show(Tracker $tracker)
    {
        return new TrackerResource($tracker);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tracker  $tracker
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTrackerRequest $request, Tracker $tracker)
    {
        $data = $request->validated();
        $tracker->update($data);
        return new TrackerResource($tracker);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tracker  $tracker
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tracker $tracker)
    {
        $tracker->delete();
        return response()->json(null);
    }

    public function get_users(Tracker $tracker)
    {
        return UserResource::collection($tracker->users);
    }

    public function set_users(Request $request, Tracker $tracker)
    {
        # code...
    }
}
