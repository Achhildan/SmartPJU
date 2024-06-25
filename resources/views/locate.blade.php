@extends('sidebar')
@section('title', 'locate')
@section('content')
<div id="layoutSidenav_content">
    <main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Data PJU Location</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Data PJU Location Detail</li>
        </ol>

        <div class="container-fluid">
            <!-- Pesan kesalahan -->
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Pesan sukses -->
            @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
            @endif

            <div class="row">
                <!-- Frame form input -->
                <!-- <div class="col-md-3">
                    <div class="rounded-frame" style="border: 1px solid #ced4da; border-radius: 10px; padding: 20px;">
                        <h5 style="text-align: left;">Add Lamp Location</h5> -->
                        <!-- Form untuk menambah data -->
                        <!-- <form method="POST" action="{{ route('store.location') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name">
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" name="address">
                            </div>
                            <div class="mb-3">
                                <label for="latitude" class="form-label">Latitude</label>
                                <input type="text" class="form-control" id="latitude" name="lat">
                            </div>
                            <div class="mb-3">
                                <label for="longitude" class="form-label">Longitude</label>
                                <input type="text" class="form-control" id="longitude" name="lng">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form> -->
                    <!-- </div>
                </div> -->
                <!-- Frame maps -->
                <div class="col-md-12">
                    <iframe src="locatemaps" width="100%" height="450" style="border:0;"></iframe>
                </div>
            </div><br/>

            <!-- Tabel menampilkan data dari website -->
            <div class="card mb-4"><br/>
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    DataTable PJU Location
                </div>
                <div class="card-body">
                    <table id="datatablesSimple" class="table table-bordered">
                        <thead>
                            <tr>
                                <!-- <th>ID</th> -->
                                <th>Name</th>
                                <th>Address</th>
                                <th>Latitude</th>
                                <th>Longitude</th>
                                <th>Created at</th>
                                <th>Updated at</th>
                                <!-- <th>Action</th> Kolom tambahan untuk tombol aksi -->
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
                                <td>{{ $marker->created_at }}</td>
                                <td>{{ $marker->updated_at }}</td>
                                <!-- <td>
                                    Tombol untuk mengubah data
                                    <a href="{{ route('edit.location', $marker->id) }}" class="btn btn-primary edit-button" style="display: inline;">Ubah</a>
                                    Tombol untuk menghapus data
                                    <form action="{{ route('delete.location', $marker->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                                    </form>
                                </td> -->
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</div>

<!-- Script untuk konfirmasi sebelum mengubah data -->
<script>
    // Tambahkan event listener untuk tombol Ubah
    document.querySelectorAll('.edit-button').forEach(button => {
        button.addEventListener('click', function(event) {
            // Minta konfirmasi dari pengguna sebelum melakukan aksi
            if (!confirm('Apakah Anda yakin ingin mengubah data ini?')) {
                // Batalkan aksi default jika pengguna membatalkan konfirmasi
                event.preventDefault();
            }
        });
    });
</script>
@endsection
