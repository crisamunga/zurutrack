<?php

namespace Tests\Unit;

use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TrackerModelTest extends TestCase
{
    private $tracker;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCanCreateTrackerModel()
    {
        $user = factory(\App\User::class)->make();

        $this->assertDatabaseHas('users', [
            'id' => $user->id
        ]);
    }
}
