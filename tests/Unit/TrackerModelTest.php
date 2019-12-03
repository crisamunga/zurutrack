<?php

namespace Tests\Unit;

use App\Tracker;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TrackerModelTest extends TestCase
{
    use RefreshDatabase;
    private $tracker;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCanCreateTrackerModel()
    {
        $this->tracker = Tracker::create([
            [
                'name' => 'Test tracker',
                'serial' => '111111111111',
                'model' => 'Fake Model',
                'added_on' => Carbon::now()
            ]
        ]);
        $this->assertTrue(true);
    }
}
