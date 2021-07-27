<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DayWeekFinderTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $fromdate = '2015-10-21 19:18:44';
        $todate = '2015-10-21 20:15:24';
        $timezone = 'Asia/Kathmandu';

        $response = $this->getJson('api/day-week-finder?fromdate='.$fromdate.'&todate='.$todate.'&timezone='.$timezone);
        
        /*$response = $this->postJson('api/day-week-finder',[
            'fromdate' => '2015-10-21 19:18:44',
            'todate' => '2015-10-21 20:15:24',
            'timezone' => 'Asia/Kathmandu'
        ]);*/

        //$response->dump();

        $response
        ->assertStatus(201)
        ->assertJson([
                'created' => true,
            ]);
    }
}
