@extends('dashboard.layout.main')
@section('container')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>
    @if (request('status') == 'Sakit')
        <form action="{{ url('/dashboard/uploadSickLetter') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="status" value="{{ request('status') }}">
            <div class="row mt-3">
                <div class="col">
                    <label for="suratSakit">Upload Surat Sakit:</label>
                    <input type="file" id="suratSakit" name="suratSakit" accept=".pdf, .doc, .docx, .jpg, .png">
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </form>
    @else
        <h1>Absen Webcam</h1>
        <div id="userData" data-userid="{{ Auth::user()->id }}"></div>
        <div class="row" style="margin-top:40">
            <div class="col d-flex">
                <input type="hidden" id=location>
                <div id="webcam">
                    <!-- Webcam video akan ditampilkan di sini -->
                </div>
                <div id="map">
                    <!-- Peta akan ditampilkan di sini -->
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                @if ($check > 0)
                    <button class="btncreate btn-danger btn-block" id="takecapture">
                        <i class='bx bx-camera'></i>
                        <span class="text nav-text">Absen Pulang</span>
                    </button>
                @else
                    <button class="btncreate btn-primary btn-block" id="takecapture">
                        <i class='bx bx-camera'></i>
                        <span class="text nav-text">Absen Masuk</span>
                    </button>
                @endif
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <div id="userData" data-username="{{ Auth::user()->name }}"></div>
            </div>
        </div>
        <div>
            <input type="text" id="status" value="{{ request('status') }}" hidden>
        </div>
        <div>
            <input type="text" id="reason" value="{{ request('reason') }}" hidden>
        </div>
        <script></script>
    @endif
@endsection
