@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4>Pesan Armada</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('bookings.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="fleet_id" class="form-label">Pilih Armada</label>
                        <select name="fleet_id" class="form-select" required>
                            <option value="">-- Pilih Armada Tersedia --</option>
                            @foreach($availableFleets as $fleet)
                                <option value="{{ $fleet->id }}">{{ $fleet->fleet_number }} - {{ $fleet->vehicle_type }} ({{ $fleet->capacity }}kg)</option>
                            @endforeach
                        </select>
                        @error('fleet_id') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="booking_date" class="form-label">Tanggal Pemesanan</label>
                        <input type="date" name="booking_date" class="form-control" required min="{{ date('Y-m-d') }}">
                        @error('booking_date') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="item_details" class="form-label">Detail Barang</label>
                        <textarea name="item_details" class="form-control" rows="3" required></textarea>
                        @error('item_details') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Pesan Armada</button>
                    <a href="{{ route('home') }}" class="btn btn-secondary mt-2 w-100">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection