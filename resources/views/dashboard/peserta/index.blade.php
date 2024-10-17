@extends('dashboard.layout.main')
@section('container')
    <link href='/css/peserta_dashboard.css' rel='stylesheet'>
    <h3>Presensi Harian</h3>
    @if ($presensitoday == null)
        <div class="wrapperbtn d-flex flex-column align-items-center py-3">
            <a href="{{ url('/dashboard/create?status=Hadir') }}" class="btn btn-primary w-75 mb-2"
                data-status="Hadir">Hadir</a>

            <a href="#" id="izinBtn" class="btn btn-primary w-75 mb-2"
                data-url="{{ url('/dashboard/create?status=Izin') }}" data-status="Izin">Izin</a>

            <a href="{{ url('/dashboard/create?status=Sakit') }}" class="btn btn-primary w-75 mb-2"
                data-status="Sakit">Sakit</a>

            <div href="#" id="wfaBtn" class="btn btn-primary w-75 mb-2"
                data-url="{{ url('/dashboard/create?status=WFA') }}" data-status="WFA">WFA</div>
        </div>
    @else
        <div class="profileuser">
            @if (Auth::user()->role == 'peserta')
                @php
                    $path = Storage::url($user_profile->image_profile);

                @endphp
                <span class="image">
                    <img src="{{ $path }}" alt="avatar">
                </span>
            @else
                <img src="{{ asset('img/default-avatar.png') }}" alt="default avatar">
            @endif
            <div class="introduction">
                <span class="name">{{ Auth::user()->name }}</span>
                <span class="profession">{{ Auth::user()->division }}</span>
            </div>
        </div>

        <div class="wrapper">
            <div class="presen_content">
                <div id="current_time" class="current-time mb-3">
                </div>
                <div class="button-container">
                    <!-- Tombol Check-In -->
                    <a href="/dashboard/create" type="button"
                        class="btn btn-primary custom-btn {{ $presensitoday->checkin_time ? 'disabled' : '' }}"
                        id="checkin-button">
                        Check In
                        <span class="d-flex justify-content-center align-items-center gap-2">
                            {{ $presensitoday->checkin_time ? $presensitoday->checkin_time : 'Belum Absen' }}
                        </span>
                    </a>

                    <!-- Tombol Check-Out -->
                    <a href="/dashboard/create" type="button"
                        class="btn btn-primary custom-btn {{ $presensitoday->checkout_time ? 'disabled' : '' }}"
                        id="checkout-button">
                        Check Out
                        <span class="d-flex justify-content-center align-items-center gap-2">
                            {{ $presensitoday->checkout_time ? $presensitoday->checkout_time : 'Belum Absen' }}
                        </span>
                    </a>
                </div>
            </div>
        </div>
    @endif

    <aside>
        <!-- Gambar Check-In -->
        @if ($presensitoday && $presensitoday->image_in)
            <div class="gambar-container mt-3">
                <h4>Foto Saat Check-In</h4>
                <img src="{{ asset('storage/uploads/absensi/' . $presensitoday->image_in) }}" alt="Foto Check-In"
                    class="img-thumbnail">
            </div>
        @endif

        <!-- Gambar Check-Out -->
        @if ($presensitoday && $presensitoday->image_out)
            <div class="gambar-container mt-3">
                <h4>Foto Saat Check-Out</h4>
                <img src="{{ asset('storage/uploads/absensi/' . $presensitoday->image_out) }}" alt="Foto Check-out"
                    class="img-thumbnail">
            </div>
        @endif
    </aside>
@endsection
