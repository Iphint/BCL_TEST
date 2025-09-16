<?php

namespace Tests\Feature;

use App\Models\Fleet;
use App\Models\Shipment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShipmentTrackingTest extends TestCase
{
    use RefreshDatabase;
    public function test_user_can_track_shipment_by_tracking_number()
    {
        // Arrange: Buat data armada & pengiriman
        $fleet = Fleet::factory()->create();
        $shipment = Shipment::factory()->create([
            'tracking_number' => 'TRK123456',
            'fleet_id' => $fleet->id,
            'status' => 'in_transit'
        ]);

        // Act: Kirim request POST ke route track
        $response = $this->post(route('track.show'), [
            'tracking_number' => 'TRK123456'
        ]);

        // Assert: Cek apakah session berisi shipment
        $response->assertSessionHas('shipment');
        $this->assertEquals('TRK123456', session('shipment')->tracking_number);
    }
    public function test_user_gets_error_when_tracking_number_not_found()
    {
        // Act
        $response = $this->post(route('track.show'), [
            'tracking_number' => 'INVALID123'
        ]);

        // Assert
        $response->assertSessionHas('error');
        $this->assertEquals('Nomor pengiriman tidak ditemukan.', session('error'));
    }
}
