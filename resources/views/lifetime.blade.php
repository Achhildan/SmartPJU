@extends('sidebar')
@section('title', 'lifetime')
@section('content')
<div id="layoutSidenav_content">
    <main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Estimasi Lifetime</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Monitoring</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-lightbulb"></i>
                Estimasi Daya Tahan Lampu:
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Nama PJU</th>
                            <th>Tanggal Pemasangan</th>
                            <th>Daya Tahan Lampu (Hari)</th>
                            <th>Estimasi Daya Tahan (Tanggal)</th>
                            <th>Estimasi Sisa Waktu (Hari)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pjuEstimates as $pju)
                            <tr>
                                <td>{{ $pju['name'] }}</td>
                                <td>{{ $pju['created_at'] }}</td>
                                <td>{{ $pju['lifetime'] }}</td>
                                <td>{{ $pju['estimasi_daya_tahan'] }}</td>
                                <td>{{ $pju['estimasi_sisa_waktu'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>
@endsection
