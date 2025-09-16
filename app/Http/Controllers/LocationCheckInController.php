<?php

namespace App\Http\Controllers;

use App\Models\Fleet;
use App\Models\LocationCheckIn;
use App\Models\Shipment;
use Illuminate\Http\Request;

class LocationCheckInController extends Controller
{
    public function create(Fleet $fleet)
    {
        return view('checkins.create', compact('fleet'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fleet_id' => 'required|exists:fleets,id',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        LocationCheckIn::create($request->all());

        $shipment = Shipment::where('fleet_id', $request->fleet_id)
            ->where('status', 'pending')
            ->first();

        if ($shipment) {
            $shipment->update(['status' => 'in_transit']);
        }

        return redirect()->route('fleets.index')->with('success', 'Lokasi berhasil di-check-in  dan status pengiriman diperbarui.');
    }

    public function map()
    {
        $checkIns = LocationCheckIn::with('fleet')->latest()->get();
        return view('checkins.map', compact('checkIns'));
    }
}
