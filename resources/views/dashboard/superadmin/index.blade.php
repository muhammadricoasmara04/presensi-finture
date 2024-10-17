@extends('dashboard.layout.main')
@section('container')
    <link href='/css/superadmin.css' rel='stylesheet'>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="container-fluid">
                    <div class="col-lg-12 col-9">
                        <div class="container">
                            <img src="/img/fintura.png" width="316px" alt="Logo Finture" class="brand-image img-square"
                                style="display: block; margin: auto;">
                            <p class="display-4 text-center"><b>Welcome!</b></p>
                            <p class="lead text-center">Dashboard Presensi Finture</p>
                        </div>
                    </div>
                    <!-- Small boxes (Stat box) -->
                    <div class="card-body-admin">
                        <div class="card_inner">
                            <h4 class="font-weight-normal mb-3">Histori Presensi
                                <i class="mdi mdi-chart-line mdi-24px float-end"></i>
                            </h4>
                            <i class='bx bx-history'></i>
                            <h6 class="card-text">Increased by 60%</h6>
                            <a href="/admin/recap">Histori Recap Presensi</a>
                        </div>

                        <div class="card_inner">
                            <h4 class="font-weight-normal mb-3">User Check
                                <i class="mdi mdi-chart-line mdi-24px float-end"></i>
                            </h4>
                            <i class='bx bxs-user-detail'></i>
                            <h6 class="card-text">Increased by 60%</h6>
                            <a href="/admin/userall">Data User</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
