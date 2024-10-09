@extends('dashboard.layout.main')

@section('container')
    <h2>Histori Absen </h2>

    <div class="table-wrapper" style="overflow-x: auto;">
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
                        <td>{{ $item->reason }}</td> <!-- Status -->
                        <td>{{ $item->checkin_time }}</td> <!-- Clock-in -->
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
