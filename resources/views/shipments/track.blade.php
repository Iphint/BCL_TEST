@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4>Pelacakan Pengiriman</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('track.show') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="tracking_number" class="form-label">Nomor Pengiriman</label>
                        <input type="text" name="tracking_number" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Lacak Sekarang</button>
                </form>
            </div>
        </div>
    </div>
</div>

@if(session('shipment'))
    <div class="row justify-content-center mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5>Hasil Pelacakan</h5>
                </div>
                <div class="card-body">
                    <p><strong>Nomor:</strong> {{ session('shipment')->tracking_number }}</p>
                    <p><strong>Tanggal Kirim:</strong> {{ session('shipment')->shipment_date }}</p>
                    <p><strong>Asal:</strong> {{ session('shipment')->origin }}</p>
                    <p><strong>Tujuan:</strong> {{ session('shipment')->destination }}</p>
                    <p><strong>Status:</strong> 
                        <span class="badge bg-{{ session('shipment')->status == 'delivered' ? 'success' : (session('shipment')->status == 'in_transit' ? 'warning' : 'secondary') }}">
                            {{ ucfirst(session('shipment')->status) }}
                        </span>
                    </p>
                    <p><strong>Detail Barang:</strong> {{ session('shipment')->item_details }}</p>
                    @if(session('shipment')->fleet)
                        <p><strong>Armada:</strong> {{ session('shipment')->fleet->fleet_number }} ({{ session('shipment')->fleet->vehicle_type }})</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endif
@endsection