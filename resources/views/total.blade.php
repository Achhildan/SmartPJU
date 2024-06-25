@extends('sidebar')
@section('title', 'Dashboard')
@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Total PJU </h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Monitoring</li>
            </ol>
            <div>
            <p>Jumlah PJU: {{ $totalCount }}</p>
                
            </div>
        </div>
    </main>
</div>
@endsection
