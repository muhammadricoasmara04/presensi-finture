@extends('dashboard.layout.main')
@section('container')
    <link href='/css/superadmin.css' rel='stylesheet'>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="container-fluid">
                    <div class="col-lg-12 col-9">
                        <div class="container">
                            <img src="/img/logo.png" width="316px" alt="Logo FHCI" class="brand-image img-square"
                                style="opacity: .8; display: block; margin: auto;">
                            <h1 class="display-4 text-center"><b>Welcome!</b></h1>
                            <p class="lead text-center">Presensi CFO and CEO</p>
                        </div>
                    </div>
                    <!-- Small boxes (Stat box) -->
                    <div class="card-body-admin">
                        <div class="card_inner">
                            <img src="/img/circle.png" class="card-img-absolute" alt="circle-image">
                            <h4 class="font-weight-normal mb-3">Histori Presensi <i
                                    class="mdi mdi-chart-line mdi-24px float-end"></i>
                            </h4>
                            <i class='bx bx-history'></i>
                            <h6 class="card-text">Increased by 60%</h6>
                            <a href="/admin/recap">Histori Recap Presensi</a>
                        </div>

                        <div class="card_inner">
                            <img src="/img/circle.png" class="card-img-absolute" alt="circle-image">
                            <h4 class="font-weight-normal mb-3">User All <i
                                    class="mdi mdi-chart-line mdi-24px float-end"></i>
                            </h4>
                            <i class='bx bx-history'></i>
                            <h6 class="card-text">Increased by 60%</h6>
                            <a href="/admin/userall">Data User</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
