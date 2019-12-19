<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Api\LinkUserRequest;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Requests\Api\UnlinkUserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        return UserResource::collection($user->clients);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegisterRequest $request)
    {
        
        $data = $request->validated();
        $client = User::create($data);
        $user = Auth::user();
        $user->clients()->attach($client);
        return new UserResource($client);
    }

    /**
     * Link to other user account
     */
    public function link(LinkUserRequest $request)
    {
        $data = $request->validated();
        $email = $data['email'];
        $client = User::where('email', $email)->first();
        if (!$client) {
            return response()->json(['message' => 'Not Found'], 404);
        }
        $user = Auth::user();
        $user->clients()->attach($client);
        return new UserResource($client);
    }

    /**
     * Unlink to other user account
     */
    public function unlink(UnlinkUserRequest $request)
    {
        $data = $request->validated();
        $client = User::find($data['user_id']);
        $user = Auth::user();
        $user->clients()->detach($client);
        return response()->json(null);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        Auth::user()->clients()->detach($user);
        return response()->json(null);
    }
}
