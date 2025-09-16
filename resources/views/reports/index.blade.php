@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Laporan Pengiriman dalam Perjalanan per Armada</h4>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nomor Armada</th>
                    <th>Jenis Kendaraan</th>
                    <th>Total Pengiriman (Dalam Perjalanan)</th>
                </tr>
            </thead>
            <tbody>
                @forelse($report as $item)
                    <tr>
                        <td>{{ $item->fleet_number }}</td>
                        <td>{{ $item->vehicle_type ?? '-' }}</td>
                        <td>{{ $item->total_shipments }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">Tidak ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection