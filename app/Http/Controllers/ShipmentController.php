<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use Illuminate\Http\Request;

class ShipmentController extends Controller
{
    public function index()
    {
        return view('shipments.track');
    }

    public function track()
    {
        return view('shipments.track');
    }

    public function showTracking(Request $request)
    {
        $request->validate([
            'tracking_number' => 'required|string'
        ]);

        $shipment = Shipment::where('tracking_number', $request->tracking_number)->with('fleet')->first();

        if (!$shipment) {
            return back()->with('error', 'Nomor pengiriman tidak ditemukan.');
        }

        return back()->with('shipment', $shipment);
    }
}
