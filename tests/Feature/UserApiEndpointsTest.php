<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Laravel\Passport\Passport;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserApiEndpointsTest extends TestCase
{
    use RefreshDatabase;
    private $user;

    public function setUp() : void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
    }

    public function test_all_endpoints_require_authentication()
    {
        // Fails is unauthenticated
        $response = $this->json("GET", '/api/users');
        $response->assertStatus(401);


        $response = $this->json('POST', '/api/users', ['name' => 'User', 'email' => 'user@example.com', 'password' => '12345678', 'password_confirmation' => '12345678']);
        $response->assertStatus(401);

        $response = $this->json('POST', '/api/users/link', ['email' => 'user@example.com']);
        $response->assertStatus(401);

        $response = $this->json('POST', '/api/users/unlink', ['email' => 'user@example.com']);
        $response->assertStatus(401);

        $response = $this->json("DELETE", "/api/users/0");
        $response->assertStatus(401);
    }

    public function test_can_get_all_linked_users()
    {
        Passport::actingAs($this->user);
        $response = $this->json('GET', '/api/users/');
        $this->assertTrue($response->getStatusCode() === 200, "Response is: " . $response->getContent());
    }

    public function test_can_link_existing_user()
    {
        Passport::actingAs($this->user);
        $client = factory(User::class)->create();
        $response = $this->json('POST', '/api/users/link', ['email' => $client->email]);
        $this->assertTrue($response->getStatusCode() === 200, "Response is: " . $response->getContent());
        $exists = $this->user->clients()->where('email', $client->email)->exists();
        $this->assertTrue($exists, "Client and reseller user accounts were not linked");
    }
    
    public function test_can_create_new_user()
    {
        Passport::actingAs($this->user);
        $data = ['name' => 'User', 'email' => 'user@example.com', 'password' => '12345678', 'password_confirmation' => '12345678'];
        $response = $this->json('POST', '/api/users', $data);
        $this->assertTrue($response->getStatusCode() === 201, "Response is: " . $response->getContent());
        $exists = $this->user->clients()->where('email', 'user@example.com')->exists();
        $this->assertTrue($exists, "Client and reseller user accounts were not linked");
    }
    
    public function test_can_remove_linked_user()
    {
        Passport::actingAs($this->user);
        $client = factory(User::class)->create();
        $this->user->clients()->attach($client);
        $response = $this->json('POST', '/api/users/unlink', ['user_id' => $client->id]);
        $this->assertTrue($response->getStatusCode() === 200, "Response is: " . $response->getContent());
        $exists = $this->user->clients()->where('email', $client->email)->exists();
        $this->assertFalse($exists, "Client and reseller user accounts were not unlinked");
        $client_exists = User::where('id', $client->id)->exists();
        $this->assertTrue($client_exists, "The client account was deleted.");
    }
    
    public function test_can_remove_linked_user_with_delete_method()
    {
        Passport::actingAs($this->user);
        $client = factory(User::class)->create();
        $this->user->clients()->attach($client);
        $response = $this->json('DELETE', "/api/users/{$client->id}");
        $this->assertTrue($response->getStatusCode() === 200, "Response is: " . $response->getContent());
        $exists = $this->user->clients()->where('email', $client->email)->exists();
        $this->assertFalse($exists, "Client and reseller user accounts were not unlinked");
        $client_exists = User::where('id', $client->id)->exists();
        $this->assertTrue($client_exists, "The client account was deleted.");
    }
}
