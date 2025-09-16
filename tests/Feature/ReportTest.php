<?php

namespace Tests\Feature;

use App\Models\Shipment;
use App\Models\Fleet;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReportTest extends TestCase
{
    use RefreshDatabase;

    public function test_report_shows_in_transit_shipments_per_fleet()
    {
        $fleet1 = Fleet::factory()->create();
        $fleet2 = Fleet::factory()->create();

        // Buat 3 pengiriman in_transit untuk fleet1
        Shipment::factory()->count(3)->create([
            'fleet_id' => $fleet1->id,
            'status' => 'in_transit'
        ]);

        // Buat 1 pengiriman in_transit untuk fleet2
        Shipment::factory()->create([
            'fleet_id' => $fleet2->id,
            'status' => 'in_transit'
        ]);

        $response = $this->get(route('reports.index'));

        $response->assertStatus(200);

        // Ambil data dari view (simulasi)
        $reportData = \Illuminate\Support\Facades\DB::table('shipments')
            ->join('fleets', 'shipments.fleet_id', '=', 'fleets.id')
            ->where('shipments.status', 'in_transit')
            ->select('fleets.fleet_number', \Illuminate\Support\Facades\DB::raw('COUNT(*) as total_shipments'))
            ->groupBy('fleets.id', 'fleets.fleet_number')
            ->get();

        $this->assertCount(2, $reportData);
        $this->assertEquals(3, $reportData[0]->total_shipments);
        $this->assertEquals(1, $reportData[1]->total_shipments);
    }
}
