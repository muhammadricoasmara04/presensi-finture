@extends('dashboard.layout.main')

@section('container')
    <h1>Histori</h1>
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
                        <td>{{ $key + 1 }}</td> <!-- Nomor urut -->
                        <td>{{ $item->name }}</td> <!-- Nama -->
                        <td>{{ $item->status }}</td> <!-- Status -->
                        <td>{{ $item->reason }}</td> <!-- Status -->
                        <td
                            style="{{ \Carbon\Carbon::parse($item->checkin_time)->format('H:i') > '09:00' ? 'color: red;' : '' }}">
                            {{ $item->checkin_time }}
                            @if (\Carbon\Carbon::parse($item->checkin_time)->format('H:i') > '09:00')
                                <span style="color: red;">(Terlambat)</span>
                            @endif
                        </td>
                        <td>{{ $item->checkout_time }}</td> <!-- Clock-out -->
                        <td>{{ $item->date }}</td> <!-- Tanggal -->
                        <td>
                            <!-- Contoh aksi -->
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
        {{ $usersRecapPage->links() }} <!-- Links untuk paginasi -->
    </div>
@endsection
