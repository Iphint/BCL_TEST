<?php

namespace App\Http\Controllers;

use App\Models\Fleet;
use Illuminate\Http\Request;

class FleetController extends Controller
{
    public function index(Request $request)
    {
        $query = Fleet::query();

        if ($request->vehicle_type) {
            $query->where('vehicle_type', $request->vehicle_type);
        }

        if ($request->availability) {
            $query->where('availability', $request->availability);
        }

        $fleets = $query->get();

        return view('fleets.index', compact('fleets'));
    }

    public function create()
    {
        return view('fleets.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'fleet_number' => 'required|unique:fleets',
            'vehicle_type' => 'required',
            'capacity' => 'required|integer|min:1',
        ]);

        Fleet::create($request->all());

        return redirect()->route('fleets.index')->with('success', 'Armada berhasil ditambahkan.');
    }

    public function edit(Fleet $fleet)
    {
        return view('fleets.edit', compact('fleet'));
    }

    public function update(Request $request, Fleet $fleet)
    {
        $request->validate([
            'fleet_number' => 'required|unique:fleets,fleet_number,' . $fleet->id,
            'vehicle_type' => 'required',
            'capacity' => 'required|integer|min:1',
        ]);

        $fleet->update($request->all());

        return redirect()->route('fleets.index')->with('success', 'Armada berhasil diupdate.');
    }

    public function destroy(Fleet $fleet)
    {
        $fleet->delete();
        return redirect()->route('fleets.index')->with('success', 'Armada berhasil dihapus.');
    }
}
