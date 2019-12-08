<?php

namespace Tests\Feature;

use App\User;
use App\Tracker;
use Tests\TestCase;
use App\TrackerModel;
use Laravel\Passport\Passport;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TrackerApiEndpointsTest extends TestCase
{
    use RefreshDatabase;
    private $user;
    private $tracker_model;

    public function setUp() : void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->tracker_model = factory(TrackerModel::class)->create();
    }

    public function test_all_endpoints_require_authentication()
    {
        // Fails is unauthenticated
        $response = $this->json("GET", '/api/trackers');
        $this->assertTrue($response->getStatusCode() === 401, "Response is: " . $response->getContent());


        $response = $this->json('POST', '/api/trackers', ['name' => 'Fleet']);
        $this->assertTrue($response->getStatusCode() === 401, "Response is: " . $response->getContent());

        $response = $this->json("GET", "/api/trackers/0");
        $this->assertTrue($response->getStatusCode() === 401, "Response is: " . $response->getContent());


        $response = $this->json('PUT', '/api/trackers/0', ['name' => 'Fleet']);
        $this->assertTrue($response->getStatusCode() === 401, "Response is: " . $response->getContent());

        $response = $this->json("DELETE", "/api/trackers/0");
        $this->assertTrue($response->getStatusCode() === 401, "Response is: " . $response->getContent());
    }


    /**
     * Test for getting all trackers
     *
     * @return void
     */
    public function test_can_get_all_trackers()
    {
        Passport::actingAs($this->user);
        $response = $this->json('GET', '/api/trackers');
        $this->assertTrue($response->getStatusCode() === 200, "Response is: " . $response->getContent());
    }

    /**
     * Test for getting a single tracker
     *
     * @return void
     */
    public function test_can_get_a_single_tracker()
    {
        $tracker = factory(Tracker::class)->create();
        Passport::actingAs($this->user);
        $response = $this->json('GET', "/api/trackers/{$tracker->id}");
        $this->assertTrue($response->getStatusCode() === 200, "Response is: " . $response->getContent());
    }

    /**
     * Test for creaitng new trackers
     *
     * @return void
     */
    public function test_can_create_a_new_tracker()
    {
        Passport::actingAs($this->user);
        $data = ['name' => 'Tracker', 'serial' => '124578', 'tracker_model_id' => $this->tracker_model->id];
        $response = $this->json('POST', '/api/trackers', $data);
        $this->assertTrue($response->getStatusCode() === 201, "Response is: " . $response->getContent());
    }

    /**
     * Test for updating existing trackers
     *
     * @return void
     */
    public function test_can_update_an_existing_tracker()
    {
        $tracker = factory(Tracker::class)->create();
        Passport::actingAs($this->user);
        $data = ['name' => 'Tracker', 'serial' => '1245789', 'tracker_model_id' => $this->tracker_model->id];
        $response = $this->json('PUT', "/api/trackers/{$tracker->id}", $data);
        $this->assertTrue($response->getStatusCode() === 200, "Response is: " . $response->getContent());
    }

    /**
     * Test for deleting trackers
     *
     * @return void
     */
    public function test_can_delete_a_tracker()
    {
        $tracker = factory(Tracker::class)->create();
        Passport::actingAs($this->user);
        $response = $this->json('DELETE', "/api/trackers/{$tracker->id}");
        $this->assertTrue($response->getStatusCode() === 200, "Response is: " . $response->getContent());
    }
}
