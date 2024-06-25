@extends('sidebar')
@section('title', 'LocateEdit')

@section('content')
    <h3><center>Daftar Lampu Smart PJU</center></h3>
    
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalLocateTambah"> 
        Tambah Data Lampu
    </button>

    <p>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Address</th>
                <th>Lat</th>
                <th>Long</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($markers as $index => $bk)
                <tr>
                    <td>{{ $bk->id }}</td>
                    <td>{{ $bk->name }}</td>
                    <td>{{ $bk->address }}</td>
                    <td>{{ $bk->lat }}</td>
                    <td>{{ $bk->lng }}</td>
                    <td>
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalLocateEdit{{ $bk->id }}">Edit</button>
                        <a href="{{ route('locateedit.hapus', $bk->id) }}" onclick="return confirm('Yakin mau dihapus?')">
                            <button class="btn btn-danger">Delete</button>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {{ $markers->links() }}
    </div>
    <!-- End Pagination -->

    <!-- Modal Tambah Data Lampu -->
    <div class="modal fade" id="modalLocateTambah" tabindex="-1" role="dialog" aria-labelledby="modalLocateTambahLabel" aria-hidden="true">
        <!-- Modal Content -->
    </div>
    <!-- End Modal Tambah Data Lampu -->

    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <!-- Include jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Include Bootstrap Datepicker CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

    <!-- Include Bootstrap Datepicker JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

    <!-- Modal Edit Data Lampu -->
    @foreach ($markers as $bk)
        <div class="modal fade" id="modalLocateEdit{{ $bk->id }}" tabindex="-1" role="dialog" aria-labelledby="modalLocateEditLabel" aria-hidden="true">
            <!-- Modal Content -->
        </div>
    @endforeach
    <!-- End Modal Edit Data Lampu -->

    <!-- Initialize Bootstrap Datepicker -->
    <script>
        $(document).ready(function() {
            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd', // Desired date format
                autoclose: true,
                todayHighlight: true
            });
        });
    </script>
@endsection
