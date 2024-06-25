@extends('sidebar')
@section('title', 'Dashboard')
@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Total Power Consumption</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Monitoring</li>
            </ol>
            <div>
                <form method="post" action="{{ route('power.calculate') }}">
                    @csrf
                    <select name="{{ $field_name }}" onchange="this.form.submit()">
                        <option value="" {{ is_null($selected_name) ? 'selected' : '' }}>All PJU</option>
                        @foreach ($names as $name)
                            <option value="{{ $name }}" {{ isset($selected_name) && $selected_name == $name ? 'selected' : '' }}>{{ $name }}</option>
                        @endforeach
                    </select>
                </form>
                @if (isset($selected_name))
                    <br/>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-bolt me-1"></i>
                            Hasil Perhitungan Daya untuk {{ $selected_name }}:
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Bulan</th>
                                        <th>Tahun</th>
                                        <th>Total Daya (W)</th>
                                        <!-- <th>Total Biaya (Rp)</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($monthly_data as $data)
                                        <tr>
                                            <td>{{ $data['month'] }}</td>
                                            <td>{{ $data['year'] }}</td>
                                            <td>{{ $data['total_power'] }} W</td>
                                            <!-- <td>{{ number_format($data['total_cost'], 2) }} Rp</td> -->
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @else
                    <br/>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-bolt me-1"></i>
                            Total Daya Bulanan dari Semua PJU:
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Bulan</th>
                                        <th>Tahun</th>
                                        <th>Total Daya (W)</th>
                                        <!-- <th>Total Biaya (Rp)</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($total_monthly_data as $data)
                                        <tr>
                                            <td>{{ $data['month'] }}</td>
                                            <td>{{ $data['year'] }}</td>
                                            <td>{{ $data['total_power'] }} W</td>
                                            <!-- <td>{{ number_format($data['total_cost'], 2) }} Rp</td> -->
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </main>
</div>
@endsection
