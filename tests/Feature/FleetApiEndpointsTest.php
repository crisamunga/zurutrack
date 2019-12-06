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
    /**
     * Test index route
     *
     * @return void
     */
    public function testIndex()
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
    public function testStore()
    {

        Passport::actingAs($this->user);
        $response = $this->json('POST', '/api/fleets', ['name' => 'Fleet']);
        $response->assertStatus(201);
    }

    /**
     * Tests the show method
     */
    public function testShow()
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
    public function testUpdate()
    {
        $fleet = factory(Fleet::class)->create();
        $this->user->fleets()->save($fleet);

        Passport::actingAs($this->user);
        $response = $this->json('PUT', "/api/fleets/{$fleet->id}", ['name' => 'Fleet Two']);
        $response->assertStatus(200);
    }

    public function testDelete()
    {
        
        $fleet = factory(Fleet::class)->create();
        $this->user->fleets()->save($fleet);

        Passport::actingAs($this->user);
        $response = $this->json('DELETE', "/api/fleets/{$fleet->id}");
        $response->assertStatus(200);
    }
}
