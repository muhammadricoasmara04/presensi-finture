@extends('dashboard.layout.main')

@section('container')
    <h1>Histori</h1>

    <!-- Form Pencarian dan Filter -->
    <form action="{{ url('/admin/recap') }}" method="GET" class="mb-4">
        <div class="row">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Cari nama..."
                    value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <input type="date" name="start_date" class="form-control" placeholder="Start Date"
                    value="{{ request('start_date') }}">
            </div>
            <div class="col-md-3">
                <input type="date" name="end_date" class="form-control" placeholder="End Date"
                    value="{{ request('end_date') }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Cari</button>
            </div>
        </div>
    </form>

    <!-- Tabel Rekap Presensi -->
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
                @foreach ($usersRecap as $key => $item)
                    <tr>
                        <td>{{ ($usersRecap->currentPage() - 1) * $usersRecap->perPage() + $key + 1 }}</td>
                        <!-- Nomor urut -->
                        <td>{{ $item->name }}</td> <!-- Nama -->
                        <td>{{ $item->status }}</td> <!-- Status -->
                        <td>{{ $item->reason }}</td> <!-- Keterangan -->
                        @php
                            $checkinTime = \Carbon\Carbon::parse($item->checkin_time)->format('H:i');
                        @endphp
                        <td
                            @if ($checkinTime > '09:15') style="color: red;" 
                            @elseif ($checkinTime > '09:00') style="color: yellow;" @endif>
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
                            <a href="{{ url('/admin/recap/' . $item->id . '/preview') }}"
                                class="btn btn-warning btn-sm">Preview</a>
                            <a href="" class="btn btn-primary btn-sm">Edit</a>
                            <form action="" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center mt-3">
        {{ $usersRecap->appends(request()->query())->links('pagination::bootstrap-4') }}
    </div>
@endsection
