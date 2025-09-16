<?php

namespace Tests\Feature;

use App\Models\Fleet;
use App\Models\LocationCheckIn;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LocationCheckInTest extends TestCase
{
    use RefreshDatabase;

    public function test_fleet_can_checkin_location()
    {
        $fleet = Fleet::factory()->create();

        $response = $this->post(route('checkin.store'), [
            'fleet_id' => $fleet->id,
            'latitude' => -6.2088,
            'longitude' => 106.8456,
        ]);

        $response->assertRedirect(route('fleets.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('location_check_ins', [
            'fleet_id' => $fleet->id,
            'latitude' => -6.2088,
            'longitude' => 106.8456,
        ]);
    }

    public function test_map_page_shows_checkins()
    {
        $fleet = Fleet::factory()->create();
        LocationCheckIn::factory()->create([
            'fleet_id' => $fleet->id,
            'latitude' => -6.2088,
            'longitude' => 106.8456,
        ]);

        $response = $this->get(route('fleet.map'));

        $response->assertStatus(200);
        $response->assertSee($fleet->fleet_number);
    }
}
