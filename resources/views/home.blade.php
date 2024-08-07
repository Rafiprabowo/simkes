<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Manajemen Kesehatan Pegawai</title>
    <link href="https://unpkg.com/@tabler/core@1.0.0-beta10/dist/css/tabler.min.css" rel="stylesheet">
</head>
<body>
    <div class="page">
        <header class="navbar navbar-expand-md navbar-light d-print-none">
            <div class="container-xl">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
                    <a href=".">
                        Sistem Informasi Manajemen Kesehatan Pegawai
                    </a>
                </h1>
                  <div class="navbar-nav flex-row order-md-last">
                    <a href="/login" class="btn btn-outline-primary">Login</a>
                </div>
            </div>
        </header>
        <div class="page-wrapper">
            <div class="container-xl">
                <div class="page-header d-print-none">
                    <div class="row align-items-center">
                        <div class="col">
                            <h2 class="page-title">
                                Selamat Datang di Sistem Informasi Manajemen Kesehatan Pegawai
                            </h2>
                            <div class="page-pretitle">
                                Dashboard
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-body">
                    <div class="row row-deck row-cards">
                        <div class="col-sm-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="subheader">Jumlah Pegawai</div>
                                    </div>
                                    <div class="h1 mb-3">{{$countPegawai}}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="subheader">Jumlah Checkup</div>
                                    </div>
                                    <div class="h1 mb-3">{{$countMCU}}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="subheader">Jumlah Diagnosa</div>
                                    </div>
                                    <div class="h1 mb-3">{{$countDiagnosa}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <footer class="footer footer-transparent d-print-none">
                    <div class="container-xl">
                        <div class="row text-center align-items-center flex-row-reverse">
                            <div class="col-lg-auto ms-lg-auto">
                                <ul class="list-inline list-inline-dots mb-0">
                                    <li class="list-inline-item">
                                        &copy; 2024 Sistem Informasi Manajemen Kesehatan Pegawai
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </footer>
    </div>

    <script src="https://unpkg.com/@tabler/core@1.0.0-beta10/dist/js/tabler.min.js"></script>
</body>
</html>
