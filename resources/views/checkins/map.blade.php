@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">📍 Lokasi Armada (Daftar Check-In)</h4>
            <span class="badge bg-light text-dark">{{ $checkIns->count() }} data</span>
        </div>
        <div class="card-body">
            @if($checkIns->isEmpty())
                <p class="text-center text-muted">Belum ada check-in lokasi.</p>
            @else
                <div class="list-group">
                    @foreach($checkIns as $ci)
                        <div class="list-group-item list-group-item-action mb-2 rounded shadow-sm">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1">
                                        🚚 Armada: 
                                        <span class="fw-bold text-primary">{{ $ci->fleet->fleet_number }}</span>
                                    </h6>
                                    <p class="mb-1 text-muted small">
                                        🕒 {{ \Carbon\Carbon::parse($ci->checked_at)->format('d M Y, H:i') }}
                                    </p>
                                    <span class="text-secondary">
                                        📍 Lat: {{ $ci->latitude }}, Lng: {{ $ci->longitude }}
                                    </span>
                                </div>
                                <div>
                                    <a href="https://www.google.com/maps?q={{ $ci->latitude }},{{ $ci->longitude }}"
                                       target="_blank" 
                                       class="btn btn-sm btn-outline-success">
                                        🌍 Lihat di Maps
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
