<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        $report = DB::table('shipments')
            ->join('fleets', 'shipments.fleet_id', '=', 'fleets.id')
            ->where('shipments.status', 'in_transit')
            ->select(
                'fleets.fleet_number',
                'fleets.vehicle_type',
                DB::raw('COUNT(*) as total_shipments')
            )
            ->groupBy('fleets.id', 'fleets.fleet_number', 'fleets.vehicle_type')
            ->get();

        return view('reports.index', compact('report'));
    }
}
