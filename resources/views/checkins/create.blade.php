@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h4>📍 Check-in Lokasi Armada: {{ $fleet->fleet_number }}</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('checkin.store') }}">
                        @csrf

                        <input type="hidden" name="fleet_id" value="{{ $fleet->id }}">

                        <div class="mb-3">
                            <label for="latitude" class="form-label">🧭 Latitude (Contoh: -6.2088)</label>
                            <input type="number" step="0.00000001" name="latitude" class="form-control" placeholder="Contoh: -6.2088" required>
                            @error('latitude')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="longitude" class="form-label">🧭 Longitude (Contoh: 106.8456)</label>
                            <input type="number" step="0.00000001" name="longitude" class="form-control" placeholder="Contoh: 106.8456" required>
                            @error('longitude')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-info w-100 text-white">✅ Simpan Lokasi</button>
                        <a href="{{ route('fleets.index') }}" class="btn btn-secondary mt-2 w-100">⬅️ Kembali ke Daftar Armada</a>
                    </form>

                    <div class="alert alert-warning mt-4">
                        <strong>💡 Tips:</strong> Kamu bisa dapat koordinat dari Google Maps:
                        <ol>
                            <li>Buka Google Maps</li>
                            <li>Klik kanan lokasi → pilih "What's here?"</li>
                            <li>Salin angka latitude, longitude</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection