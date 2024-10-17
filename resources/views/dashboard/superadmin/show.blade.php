@extends('dashboard.layout.main')

@section('container')
    <h2>User</h2>

    <a href="/admin/registerusers" type="button" class="btn bg-primary"><i class='bx bxs-user-plus'></i>Add User</a>

    <div class="table-wrapper">
        <table class="fl-table">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>Nama</th>
                    <th>Divisi</th>
                    <th>Email</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($usersDB as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td> <!-- Nomor urut -->
                        <td>{{ $item->name }}</td> <!-- Nama -->
                        <td>{{ $item->division }}</td>
                        <td>{{ $item->email }}</td> <!-- Status -->

                        <td>
                            <!-- Contoh aksi -->
                            <a href="{{ url('admin/userall/' . $item->id . '/edituser') }}"
                                class="btn btn-primary btn-sm">Edit</a>
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
