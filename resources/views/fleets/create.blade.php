@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h4>🚛 Tambah Armada Baru</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('fleets.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="fleet_number" class="form-label">🔢 Nomor Armada</label>
                            <input type="text" name="fleet_number" class="form-control" placeholder="Contoh: FLEET-001" required>
                            @error('fleet_number')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="vehicle_type" class="form-label">🚗 Jenis Kendaraan</label>
                            <select name="vehicle_type" class="form-select" required>
                                <option value="">-- Pilih Jenis --</option>
                                <option value="Truk">Truk</option>
                                <option value="Van">Van</option>
                                <option value="Pickup">Pickup</option>
                            </select>
                            @error('vehicle_type')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="capacity" class="form-label">📦 Kapasitas Muatan (kg)</label>
                            <input type="number" name="capacity" class="form-control" placeholder="Contoh: 2000" min="1" required>
                            @error('capacity')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-success w-100">✅ Simpan Armada</button>
                        <a href="{{ route('fleets.index') }}" class="btn btn-secondary mt-2 w-100">⬅️ Kembali ke Daftar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection