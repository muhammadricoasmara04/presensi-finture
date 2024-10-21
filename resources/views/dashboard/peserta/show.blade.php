@extends('dashboard.layout.main')

@section('container')
    <h1>Histori Absen </h1>

    <div class="table-wrapper">
        <table class="fl-table">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>Nama</th>
                    <th>Status</th>
                    <th>Keterangan</th>
                    <th>Clock-in</th>
                    <th>Clock-out</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($presensi as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td> <!-- Nomor urut -->
                        <td>{{ $item->name }}</td> <!-- Nama -->
                        <td>{{ $item->status }}</td> <!-- Status -->
                        <td>{{ $item->reason }}</td> <!-- Alasan -->

                        @php
                            $checkinTime = \Carbon\Carbon::parse($item->checkin_time)->format('H:i');
                        @endphp

                        <td
                            @if ($checkinTime > '09:15') style="color: red;" 
            @elseif ($checkinTime > '09:00') 
                style="color: yellow;" @endif>
                            {{ $checkinTime }}

                            @if ($checkinTime > '09:15')
                                <span style="color: red;">(Sangat Terlambat)</span>
                            @elseif ($checkinTime > '09:00')
                                <span style="color: yellow;">(Sedikit Terlambat)</span>
                            @endif
                        </td>

                        <td>{{ $item->checkout_time }}</td> <!-- Clock-out -->
                        <td>{{ $item->date }}</td> <!-- Tanggal -->
                        <td>
                            <!-- Contoh aksi -->

                            <div class="col-sm">
                                <a href="{{ url('/dashboard/show/' . $item->id . '/preview') }}"
                                    class="btn btn-primary">Preview</a>
                            </div>

                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection
