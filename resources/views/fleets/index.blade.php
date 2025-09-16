@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Daftar Armada</h2>
    <a href="{{ route('fleets.create') }}" class="btn btn-success">Tambah Armada</a>
</div>

<form method="GET" class="mb-4">
    <div class="row">
        <div class="col-md-4">
            <select name="vehicle_type" class="form-select">
                <option value="">Semua Jenis</option>
                <option value="Truk" {{ request('vehicle_type') == 'Truk' ? 'selected' : '' }}>Truk</option>
                <option value="Van" {{ request('vehicle_type') == 'Van' ? 'selected' : '' }}>Van</option>
                <option value="Pickup" {{ request('vehicle_type') == 'Pickup' ? 'selected' : '' }}>Pickup</option>
            </select>
        </div>
        <div class="col-md-4">
            <select name="availability" class="form-select">
                <option value="">Semua Status</option>
                <option value="available" {{ request('availability') == 'available' ? 'selected' : '' }}>Tersedia</option>
                <option value="unavailable" {{ request('availability') == 'unavailable' ? 'selected' : '' }}>Tidak Tersedia</option>
            </select>
        </div>
        <div class="col-md-4">
            <button type="submit" class="btn btn-primary w-100">Filter</button>
        </div>
    </div>
</form>

<table class="table table-bordered table-hover">
    <thead class="table-light">
        <tr>
            <th>Nomor Armada</th>
            <th>Jenis Kendaraan</th>
            <th>Kapasitas (kg)</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($fleets as $fleet)
            <tr>
                <td>{{ $fleet->fleet_number }}</td>
                <td>{{ $fleet->vehicle_type }}</td>
                <td>{{ $fleet->capacity }}</td>
                <td>
                    <span class="badge bg-{{ $fleet->availability == 'available' ? 'success' : 'danger' }}">
                        {{ $fleet->availability == 'available' ? 'Tersedia' : 'Tidak Tersedia' }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('fleets.edit', $fleet) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('fleets.destroy', $fleet) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus?')">Hapus</button>
                    </form>
                    <a href="{{ route('checkin.create', $fleet) }}" class="btn btn-sm btn-info">Check-in</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center">Tidak ada data armada.</td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection