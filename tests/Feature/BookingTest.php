<?php

namespace Tests\Feature;

use App\Models\Fleet;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookingTest extends TestCase
{
     use RefreshDatabase;

    public function test_user_can_book_available_fleet()
    {
        $fleet = Fleet::factory()->create(['availability' => 'available']);

        $response = $this->post(route('bookings.store'), [
            'fleet_id' => $fleet->id,
            'booking_date' => now()->addDays(1)->toDateString(),
            'item_details' => 'Barang elektronik'
        ]);

        $response->assertRedirect(route('home'));
        $response->assertSessionHas('success');

        // Cek fleet berubah jadi unavailable
        $this->assertDatabaseHas('fleets', [
            'id' => $fleet->id,
            'availability' => 'unavailable'
        ]);

        // Cek booking tersimpan
        $this->assertDatabaseHas('bookings', [
            'fleet_id' => $fleet->id,
            'item_details' => 'Barang elektronik'
        ]);
    }

    public function test_user_cannot_book_unavailable_fleet()
    {
        $fleet = Fleet::factory()->create(['availability' => 'unavailable']);

        $response = $this->post(route('bookings.store'), [
            'fleet_id' => $fleet->id,
            'booking_date' => now()->addDays(1)->toDateString(),
            'item_details' => 'Barang elektronik'
        ]);

        $response->assertSessionHasErrors('fleet_id');
    }

    public function test_cannot_book_with_past_date()
    {
        $fleet = Fleet::factory()->create(['availability' => 'available']);

        $response = $this->post(route('bookings.store'), [
            'fleet_id' => $fleet->id,
            'booking_date' => now()->subDay()->toDateString(), // kemarin
            'item_details' => 'Barang elektronik'
        ]);

        $response->assertSessionHasErrors('booking_date');
    }
}
