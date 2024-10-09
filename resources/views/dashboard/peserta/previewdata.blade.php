@extends('dashboard.layout.main')
@section('container')
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <div class="card">
        <div class="innerchild">
            <h1>Preview Presensi</h1>
            <div class="card-location">
                <div class="map-container">
                    <p>Lokasi Absensi</p>
                    <div class="mapshow" id="maps"></div>
                </div>
            </div>

            <div class="card-image">
                <div class="col-sm-6">
                    <p>Image Check In</p>
                    @if ($presensi->image_in)
                        <img src="{{ Storage::url('uploads/absensi/' . $presensi->image_in) }}" alt="Check-in Image">
                    @endif
                </div>

                <div class="col-sm-6">
                    <p>Image Check Out</p>
                    @if ($presensi->image_out)
                        <img src="{{ Storage::url('uploads/absensi/' . $presensi->image_out) }}" alt="Check-out Image">
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var locationIn = [{{ explode(',', $presensi->location_in)[0] ?? 'null' }},
                {{ explode(',', $presensi->location_in)[1] ?? 'null' }}
            ];

            var locationOut = null;

            // Mengonversi string latitude,longitude menjadi array
            @if ($presensi->location_out)
                locationOut = [{{ explode(',', $presensi->location_out)[0] }},
                    {{ explode(',', $presensi->location_out)[1] }}
                ];
            @endif

            // Membuat peta
            var map = L.map('maps').setView(locationIn[0] !== 'null' ? locationIn : [0, 0], 15);

            // Tambahkan tile layer
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© OpenStreetMap'
            }).addTo(map);

            // Marker untuk lokasi check-in
            if (locationIn[0] !== 'null' && locationIn[1] !== 'null') {
                L.marker(locationIn).addTo(map)
                    .bindPopup('Location In').openPopup();
            }

            // Marker untuk lokasi check-out jika valid
            if (locationOut && locationOut[0] !== 'null' && locationOut[1] !== 'null') {
                L.marker(locationOut).addTo(map)
                    .bindPopup('Location Out').openPopup();
            }
        });
    </script>
@endsection
