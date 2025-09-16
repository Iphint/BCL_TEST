@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8"> <!-- biar muat peta -->
            <div class="card shadow">
                <div class="card-header bg-info text-white">
                    <h4>📍 Check-in Lokasi Armada: {{ $fleet->fleet_number }}</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('checkin.store') }}">
                        @csrf
                        <input type="hidden" name="fleet_id" value="{{ $fleet->id }}">

                        <div class="mb-3">
                            <label for="latitude" class="form-label">🧭 Latitude</label>
                            <input id="latitude" type="number" step="0.00000001" name="latitude"
                                   class="form-control" placeholder="Contoh: -6.2088" required>
                            @error('latitude')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="longitude" class="form-label">🧭 Longitude</label>
                            <input id="longitude" type="number" step="0.00000001" name="longitude"
                                   class="form-control" placeholder="Contoh: 106.8456" required>
                            @error('longitude')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div id="map" style="height: 350px; border-radius: 10px; margin-bottom: 15px;"></div>

                        <button type="submit" class="btn btn-info w-100 text-white">✅ Simpan Lokasi</button>
                        <a href="{{ route('fleets.index') }}" class="btn btn-secondary mt-2 w-100">⬅️ Kembali ke Daftar Armada</a>
                    </form>

                    <div class="alert alert-warning mt-4">
                        <strong>💡 Tips:</strong> 
                        <ul class="mb-0">
                            <li>Lokasi akan otomatis terisi sesuai posisi kamu.</li>
                            <li>Kamu bisa <b>geser marker</b> di peta untuk ubah posisi manual.</li>
                            <li>Atau isi langsung koordinat latitude & longitude di form.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Leaflet CSS & JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    var map = L.map('map').setView([-6.2088, 106.8456], 13);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap'
    }).addTo(map);

    // marker bisa di-drag
    var marker = L.marker([-6.2088, 106.8456], { draggable: true }).addTo(map);

    // kalau marker digeser, update input lat/lng
    marker.on('dragend', function(e) {
        var lat = marker.getLatLng().lat;
        var lng = marker.getLatLng().lng;
        document.getElementById('latitude').value = lat;
        document.getElementById('longitude').value = lng;
    });

    // coba dapat lokasi device
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var lat = position.coords.latitude;
            var lng = position.coords.longitude;
            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;
            map.setView([lat, lng], 15);
            marker.setLatLng([lat, lng]);
        }, function(error) {
            console.warn("⚠️ Lokasi tidak bisa didapat: " + error.message);
        });
    }
});
</script>
@endsection
