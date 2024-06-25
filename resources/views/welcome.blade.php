@extends('layoutdash')
@section('title', 'ceklay')
@section('content')
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Monitoring</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Monitoring</li>
                        </ol>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">ESTIMATE TOTAL COST </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body">TOTAL POWER CONSUMPTION</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">ESTIMATE LIFETIME</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body">TOTAL PJU</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6">
                              
                            </div>
                            <div class="col-xl-6">
                              
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                DataTable Smart PJU
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                <thead>
                                <tr>
                                    <th>Time</th>
                                    <th>Data</th>   
                                    <th>Radio</th>
                                    <th>Type</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Time</th>
                                    <th>Data</th>   
                                    <th>Radio</th>
                                    <th>Type</th>
                                </tr>
                            </tfoot>
                                    <tbody>
                                        <?php
                                        // Atur opsi untuk file_get_contents
                                        $opts = array(
                                            "ssl" => array(
                                                "verify_peer" => false,
                                                "verify_peer_name" => false,
                                            ),
                                        );

                                        // Buat konteks stream dengan opsi yang disetel
                                        $context = stream_context_create($opts);

                                        // URL API
                                        $linkApi = "https://api-data.telkomiot.id/api/v2.0/APP65b1ea2f77cf677842/DEV65e46a67213cd86462/lasthistory";

                                        // Ambil data dari API menggunakan file_get_contents dengan konteks stream yang telah dibuat
                                        $dataAPI = file_get_contents($linkApi, false, $context);

                                        // Periksa jika terjadi kesalahan
                                        if ($dataAPI === false) {
                                            // Tampilkan pesan kesalahan
                                            echo "<tr><td colspan='7'>Gagal mengambil data dari API.</td></tr>";
                                        } else {
                                            // Decode JSON menjadi array asosiatif
                                            $data = json_decode($dataAPI, true);

                                            // Periksa apakah decoding berhasil
                                            if ($data === null) {
                                                echo "<tr><td colspan='7'>Gagal melakukan decode JSON.</td></tr>";
                                            } else {
                                                // Tampilkan data dalam format yang mudah dibaca
                                                foreach ($data as $row) {
                                                    echo "<tr>";
                                                    echo "<td>{$row['time']}</td>";            
                                                    echo "<td>{$row['data']}</td>";          
                                                    echo "<td>{$row['radio']}</td>";
                                                    echo "<td>{$row['type']}</td>";
                                                    echo "</tr>";
                                                }
                                            }
                                        }
                                        ?>
                                        </tbody>
                                        </table>
                            </div>
                        </div>
                    </div>
                </main>
               
            </div>
@endsection
