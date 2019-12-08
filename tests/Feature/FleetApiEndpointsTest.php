<?php

namespace Tests\Feature;

use App\User;
use App\Fleet;
use Tests\TestCase;
use Laravel\Passport\Passport;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FleetApiEndpointsTest extends TestCase
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
        $response = $this->json("GET", '/api/fleets');
        $response->assertStatus(401);


        $response = $this->json('POST', '/api/fleets', ['name' => 'Fleet']);
        $response->assertStatus(401);

        $response = $this->json("GET", "/api/fleets/0");
        $response->assertStatus(401);


        $response = $this->json('PUT', '/api/fleets/0', ['name' => 'Fleet']);
        $response->assertStatus(401);

        $response = $this->json("DELETE", "/api/fleets/0");
        $response->assertStatus(401);
    }

    /**
     * Test index route
     *
     * @return void
     */
    public function test_can_get_all_fleets()
    {
        Passport::actingAs($this->user);
        $response = $this->json("GET", '/api/fleets');
        $response->assertStatus(200);
    }

    /**
     * Test index route
     *
     * @return void
     */
    public function test_can_create_new_fleet()
    {
        Passport::actingAs($this->user);
        $response = $this->json('POST', '/api/fleets', ['name' => 'Fleet']);
        $response->assertStatus(201);
    }

    /**
     * Tests the show method
     */
    public function test_can_get_fleet_details()
    {
        $fleet = factory(Fleet::class)->create();
        $this->user->fleets()->save($fleet);

        Passport::actingAs($this->user);
        $response = $this->json("GET", "/api/fleets/{$fleet->id}");
        $response->assertStatus(200);
    }

    /**
     * Tests the update method
     */
    public function test_can_update_fleet_details()
    {
        $fleet = factory(Fleet::class)->create();
        $this->user->fleets()->save($fleet);

        Passport::actingAs($this->user);
        $response = $this->json('PUT', "/api/fleets/{$fleet->id}", ['name' => 'Fleet Two']);
        $response->assertStatus(200);
    }

    public function test_can_delete_fleet()
    {
        $fleet = factory(Fleet::class)->create();
        $this->user->fleets()->save($fleet);

        Passport::actingAs($this->user);
        $response = $this->json('DELETE', "/api/fleets/{$fleet->id}");
        $response->assertStatus(200);
    }
}
