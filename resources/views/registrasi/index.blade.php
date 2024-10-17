@extends('dashboard.layout.main')

@section('container')
    <div class="register">
        <form action="/registeruser" class="register__form" method="POST">
            @csrf
            <h1 class="register__title">Register</h1>
            <div class="register__content">
                <div class="register__box">
                    <i class="ri-user-3-line register__icon"></i>
                    <div class="register__box-input">
                        <input type="text" class="register__input" name="name" id="name" placeholder="" required
                            value="{{ old('name') }}">
                        <label for="name" class="register__label">Nama</label>
                    </div>
                </div>

                <div class="register__box">
                    <i class="ri-user-3-line register__icon"></i>
                    <div class="register__box-input">
                        <input type="text" class="register__input" name="division" id="division" placeholder="" required
                            value="{{ old('division') }}">
                        <label for="division" class="register__label">Divisi</label>
                    </div>
                </div>

                <div class="register__box">
                    <i class="ri-user-3-line register__icon"></i>
                    <div class="register__box-input">
                        <input type="email" class="register__input" name="email" id="email" placeholder="" required
                            value="{{ old('email') }}">
                        <label for="email" class="register__label">Email</label>
                    </div>
                </div>

                <div class="register__box">
                    <i class="ri-lock-2-line register__icon"></i>
                    <div class="register__box-input">
                        <input type="password" class="register__input" name="password" id="password" placeholder=""
                            required>
                        <label for="password" class="register__label">Password</label>
                    </div>
                </div>

                <div class="register__box">
                    <i class="ri-user-3-line register__icon"></i>
                    <div class="register__box-input">
                        <select class="register__input" name="role" id="role" required style="color: black;">
                            <option value="" disabled selected>Pilih Role</option>
                            <option value="superadmin">Super Admin</option>
                            <option value="peserta">User</option>
                            <!-- Tambahkan role lain sesuai kebutuhan -->
                        </select>

                    </div>
                </div>
            </div>
            <button type="submit" class="register__button">Daftar</button>
        </form>
    </div>
@endsection
