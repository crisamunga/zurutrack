<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateClientRequest;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Resources\UserResource;

class ClientController extends Controller
{
    public function check($email)
    {
        $user = User::where('email', $email)->firstOrFail();
        return new UserResource($user);
    }

    public function store(CreateClientRequest $request)
    {
        $data = $request->validated();
        $user = User::create($data);
        return new UserResource($user);
    }
}
