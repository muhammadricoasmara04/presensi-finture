@extends('dashboard.layout.main')
@section('container')
    <h1>Edit Profile</h1>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <form action="/dashboard/{{ $users->id }}/editprofile" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="col">
            <div class="form-group boxed">
                <div class="input-wrapper">
                    <label for="name" class="nama_label">Nama</label>
                    <input type="text" class="form-control" value="{{ $users->name }}" name="name"
                        placeholder="Nama Lengkap" autocomplete="off">
                </div>
            </div>
            <div class="form-group boxed">
                <div class="input-wrapper">
                    <label for="division" class="bumn_label">Divisi</label>
                    <input type="text" class="form-control" value="{{ $users->division }}" name="bumn"
                        placeholder="Divisi" autocomplete="off" disabled>
                </div>
            </div>
            <div class="form-group boxed">
                <div class="input-wrapper">
                    <label for="password" class="password_label">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Password" autocomplete="off">
                    @if ($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group boxed">
                <div class="input-wrapper">
                    <label for="password_confirmation" class="password_label">Confirm Password</label>
                    <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password"
                        autocomplete="off">
                </div>
            </div>
            <div class="custom-file-upload" id="fileUpload1">
                <label for="fileuploadInput" class="password_label">Upload Foto</label>
                <input type="file" name="foto" id="fileuploadInput" accept=".png, .jpg, .jpeg">
                <label for="fileuploadInput"></label>

                <!-- Elemen untuk preview gambar -->
                <div class="preview-wrapper">
                    <img id="imagePreview" src="#" alt="Preview Gambar"
                        style="display: none; max-width: 100%; height: auto;" />
                </div>
            </div>
            <div class="form-group boxed">
                <div class="input-wrapper">
                    <button type="submit" class="btn btn-primary btn-block">
                        <i class='bx bx-pencil icon'></i>
                        Update
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection
