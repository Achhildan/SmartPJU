@extends('sidebar')
@section('title', 'dashboard')
@section('content')

<style>
    .bg-custom-blue {
        background-color: cornflowerblue !important;
        color: white; /* Agar teks tetap terlihat */
    }
</style>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Monitoring</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
            <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-custom-blue text-white mb-4">
                                    <div class="card-body">ESTIMATE TOTAL COST </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="cost">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-custom-blue text-white mb-4">
                                    <div class="card-body">TOTAL POWER CONSUMPTION</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="power">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-custom-blue text-white mb-4">
                                    <div class="card-body">ESTIMATE LAMP LIFETIME</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="lifetime">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                            <div class="card bg-custom-blue text-white mb-4">
                                <div class="card-body d-flex align-items-center justify-content-between">
                                    <h4>{{$totalCount}}</h4>
                                    <span class="ml-2">TOTAL PJU</span>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <span class="small text-white stretched-link">View Details</span>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>

                        </div>

                        </div>
            <div class="row">
                <iframe src= "locatemaps" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>                
            </div>
            <br/>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Location Table Smart PJU
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <!-- <th>No</th> -->
                                <th>Name</th>
                                <th>Address</th>
                                <th>Latitude</th>
                                <th>Longitude</th>
                                <!-- <th>Status</th> -->
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($markers as $marker)
                                <tr>
                                    <!-- <td>{{ $marker->id }}</td> -->
                                    <td>{{ $marker->name }}</td>
                                    <td>{{ $marker->address }}</td>
                                    <td>{{ $marker->lat }}</td>
                                    <td>{{ $marker->lng }}</td>
                                    <!-- <td>ON</td> -->
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection
