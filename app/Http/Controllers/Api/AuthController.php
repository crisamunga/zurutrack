<?php
namespace App\Http\Controllers\Api;

use App\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\RegisterRequest;

class AuthController extends Controller
{
    public function profile()
    {
        return new UserResource(Auth::user());
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        $user = User::create($data);
        return new UserResource($user);
    }

    public function login(LoginRequest $request)
    {
        $data = $request->validated();
        $http = new Client;
        $response = $http->post(config('services.passport.endpoint'), [
            'form_params' => [
                'grant_type' => config('services.passport.grant_type'),
                'client_id' => config('services.passport.client_id'),
                'client_secret' => config('services.passport.client_secret'),
                'username' => $data['email'],
                'password' => $data['password'],
                'scope' => '*',
            ],
            'exceptions' => false,
        ]);
        // return response()->json(['message' => 'Success'], 200);
        $responseBody = json_decode((string) $response->getBody(), true);
        $responseCode = $response->getStatusCode();
        return response()->json($responseBody, $responseCode);
    }

    public function logout(Request $request)
    {
        $token = Auth::user()->token();
        $token->revoke();
        return response()->json(['message' => 'Logged out'], 200);
    }
}
