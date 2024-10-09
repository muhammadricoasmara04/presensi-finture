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
                        <input type="email" class="register__input" name="email" id="email" placeholder="" autofocus
                            required value="{{ old('email') }}">
                        <label for="email" class="register__label">Email</label>
                    </div>
                </div>
                <div class="register__box">
                    <i class="ri-user-3-line register__icon"></i>
                    <div class="register__box-input">
                        <input type="name" class="register__input" name="name" id="name" placeholder="" autofocus
                            required value="{{ old('name') }}">
                        <label for="name" class="register__label">Nama</label>
                    </div>
                </div>
                <div class="register__box">
                    <i class="ri-user-3-line register__icon"></i>
                    <div class="register__box-input">
                        <input type="bumn" class="register__input" name="bumn" id="bumn" placeholder="" autofocus
                            required value="{{ old('bumn') }}">
                        <label for="name" class="register__label">Nama BUMN</label>
                    </div>
                </div>
                <div class="register__box">
                    <i class="ri-lock-2-line register__icon"></i>
                    <div class="register__box-input">
                        <input type="password" class="register__input" name="password" id="password" placeholder="" required>
                        <label for="password" class="register__label">Password</label>
                    </div>
                </div>
            </div>

            <button type="submit" class="register__button">Daftar</button>
        </form>
    </div>

    
@endsection
