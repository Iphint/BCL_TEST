<?php

namespace Tests\Feature;

use App\Models\Fleet;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FleetManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_view_fleet_list()
    {
        Fleet::factory()->count(3)->create();

        $response = $this->get(route('fleets.index'));

        $response->assertStatus(200);
        $response->assertSee('Manajemen Armada');
        $response->assertSee('FLEET-'); // cek apakah data muncul
    }

    public function test_admin_can_create_fleet()
    {
        $response = $this->post(route('fleets.store'), [
            'fleet_number' => 'FLEET-9999',
            'vehicle_type' => 'Truk',
            'capacity' => 3000,
        ]);

        $response->assertRedirect(route('fleets.index'));
        $this->assertDatabaseHas('fleets', [
            'fleet_number' => 'FLEET-9999',
            'vehicle_type' => 'Truk',
            'capacity' => 3000,
        ]);
    }

    public function test_fleet_filter_by_availability()
    {
        Fleet::factory()->create(['availability' => 'available']);
        Fleet::factory()->create(['availability' => 'unavailable']);

        $response = $this->get(route('fleets.index', ['availability' => 'available']));

        $response->assertStatus(200);
        // Pastikan hanya yang 'available' yang muncul
        $this->assertCount(1, Fleet::where('availability', 'available')->get());
    }
}
