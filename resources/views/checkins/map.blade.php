@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Peta Lokasi Armada (Versi Teks)</h4>
    </div>
    <div class="card-body">
        @if($checkIns->isEmpty())
            <p class="text-center text-muted">Belum ada check-in lokasi.</p>
        @else
            <ul class="list-group">
                @foreach($checkIns as $ci)
                    <li class="list-group-item">
                        <strong>Armada:</strong> {{ $ci->fleet->fleet_number }} 
                        - <strong>Lokasi:</strong> 
                          <a href="https://www.google.com/maps?q={{ $ci->latitude }},{{ $ci->longitude }}" 
                             target="_blank" class="text-decoration-none">
                             Klik disini
                          </a>
                        - <strong>Waktu Cek In:</strong> {{ $ci->checked_at }}
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>
@endsection
