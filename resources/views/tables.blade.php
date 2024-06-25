@extends('sidebar')
@section('title', 'Data Tables')
@section('content')
<div id="layoutSidenav_content">
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Data Realtime</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Data Tables Detail</li>
        </ol>

        <form id="pjuForm" method="GET" action="{{ route('tables.index') }}">
            <label for="pju_selection">Pilih PJU:</label>
            <select name="pju_selection" id="pju_selection" onchange="document.getElementById('pjuForm').submit();">
                @foreach ($pju_list as $pju)
                    <option value="{{ $pju->name }}" {{ $pju_selection == $pju->name ? 'selected' : '' }}>{{ $pju->name }}</option>
                @endforeach
            </select>
        </form>

        <p>Data terakhir diupdate pada: {{ $waktu_simpan }} WIB</p>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                DataTable Smart PJU
                <div class="float-end">
                <form action="{{ route('tables.exportExcel') }}" method="GET">
                    <input type="hidden" name="pju_selection" value="{{ $pju_selection }}">
                    <!-- <button type="submit" class="btn btn-success">Export to Excel</button> -->
                </form>
                    <!-- <a class="btn btn-primary" href="{{ route('pdf_creator') }}">Print PDF</a>
                    <a class="btn btn-success" href="{{ route('export_table') }}">Export Excel</a> -->
                </div>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('tables.index') }}">
                    <label for="start_date">Tanggal Mulai:</label>
                    <input type="date" id="start_date" name="start_date" value="{{ request('start_date') }}">
                    <label for="end_date">Tanggal Selesai:</label>
                    <input type="date" id="end_date" name="end_date" value="{{ request('end_date') }}">
                    <button type="submit">Filter</button>
                    <button type="button" onclick="clearDates()">Clear</button>
                </form>
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Time</th>
                            <th>Power</th>
                            <!-- <th>Status</th> Kolom baru untuk Status -->
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Time</th>
                            <th>Power</th>
                            <!-- <th>Status</th> Kolom baru untuk Status -->
                        </tr>
                    </tfoot>
                    <tbody id="table_body">
                        @foreach ($records as $record)
                        <tr>
                            <td>{{ $record->time }}</td>
                            <td>{{ $record->power }}</td>
                            <!-- <td>{{ $record->power == 0 ? 'OFF' : 'ON' }}</td> Status dihitung dinamis -->
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
</div>

<script>
function clearDates() {
    document.getElementById('start_date').value = '';
    document.getElementById('end_date').value = '';
    document.forms[0].submit();
}
</script>
@endsection
