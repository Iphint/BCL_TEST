@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-warning text-white">
                    <h4>✏️ Edit Armada: {{ $fleet->fleet_number }}</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('fleets.update', $fleet) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="fleet_number" class="form-label">🔢 Nomor Armada</label>
                            <input type="text" name="fleet_number" class="form-control" value="{{ old('fleet_number', $fleet->fleet_number) }}" required>
                            @error('fleet_number')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="vehicle_type" class="form-label">🚗 Jenis Kendaraan</label>
                            <select name="vehicle_type" class="form-select" required>
                                <option value="">-- Pilih Jenis --</option>
                                <option value="Truk" {{ old('vehicle_type', $fleet->vehicle_type) == 'Truk' ? 'selected' : '' }}>Truk</option>
                                <option value="Van" {{ old('vehicle_type', $fleet->vehicle_type) == 'Van' ? 'selected' : '' }}>Van</option>
                                <option value="Pickup" {{ old('vehicle_type', $fleet->vehicle_type) == 'Pickup' ? 'selected' : '' }}>Pickup</option>
                            </select>
                            @error('vehicle_type')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="capacity" class="form-label">📦 Kapasitas Muatan (kg)</label>
                            <input type="number" name="capacity" class="form-control" value="{{ old('capacity', $fleet->capacity) }}" min="1" required>
                            @error('capacity')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="availability" class="form-label">✅ Status Ketersediaan</label>
                            <select name="availability" class="form-select" required>
                                <option value="available" {{ old('availability', $fleet->availability) == 'available' ? 'selected' : '' }}>Tersedia</option>
                                <option value="unavailable" {{ old('availability', $fleet->availability) == 'unavailable' ? 'selected' : '' }}>Tidak Tersedia</option>
                            </select>
                            @error('availability')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-warning w-100">💾 Update Armada</button>
                        <a href="{{ route('fleets.index') }}" class="btn btn-secondary mt-2 w-100">⬅️ Kembali ke Daftar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection