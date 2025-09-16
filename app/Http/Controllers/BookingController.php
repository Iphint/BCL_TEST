<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Fleet;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function create()
    {
        $availableFleets = Fleet::where('availability', 'available')->get();
        return view('bookings.create', compact('availableFleets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fleet_id' => 'required|exists:fleets,id',
            'booking_date' => 'required|date|after_or_equal:today',
            'item_details' => 'required|string',
        ]);

        $fleet = Fleet::findOrFail($request->fleet_id);

        if ($fleet->availability !== 'available') {
            return back()->withErrors(['fleet_id' => 'Armada tidak tersedia.']);
        }

        // Buat booking
        Booking::create($request->all());

        // Update status armada jadi tidak tersedia
        $fleet->update(['availability' => 'unavailable']);

        // Opsional: Buat shipment otomatis
        \App\Models\Shipment::create([
            'tracking_number' => 'TRK' . rand(100000, 999999),
            'shipment_date' => $request->booking_date,
            'origin' => 'Gudang Pusat',
            'destination' => 'Pelanggan',
            'status' => 'pending',
            'item_details' => $request->item_details,
            'fleet_id' => $request->fleet_id,
        ]);

        return redirect()->route('home')->with('success', 'Pemesanan berhasil! Armada telah dipesan.');
    }
}
