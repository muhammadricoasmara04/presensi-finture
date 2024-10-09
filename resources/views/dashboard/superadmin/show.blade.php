@extends('dashboard.layout.main')

@section('container')
    <h2>Responsive Table</h2>

    <a href="/admin/registerusers" type="button" class="btn bg-primary"><i class='bx bxs-user-plus'></i>Add Users</a>

    <div class="table-wrapper" style="overflow-x: auto;">
        <table class="fl-table">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>Nama</th>
                    <th>BUMN</th>
                    <th>Email</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($usersDB as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td> <!-- Nomor urut -->
                        <td>{{ $item->name }}</td> <!-- Nama -->
                        <td>{{ $item->bumn }}</td> <!-- Status -->
                        <td>{{ $item->email }}</td> <!-- Status -->

                        <td>
                            <!-- Contoh aksi -->
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
@endsection
