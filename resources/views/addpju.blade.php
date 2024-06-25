@extends('sidebar')
@section('title', 'locate')
@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Data PJU Monitoring</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Data PJU Monitoring Detail</li>
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
                    <div class="col-md-3">
                        <div class="rounded-frame" style="border: 1px solid #ced4da; border-radius: 10px; padding: 20px;">
                            <h5 style="text-align: left;">Add PJU Monitoring</h5>
                            <!-- Form untuk menambah data -->
                            <form method="POST" action="{{ route('store.addpju') }}">
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
                                <div class="mb-3">
                                    <label for="API" class="form-label">API</label>
                                    <input type="text" class="form-control" id="API" name="API">
                                </div>
                                <div class="mb-3">
                                    <label for="lifetime" class="form-label">Lamp Durability (day)</label>
                                    <input type="text" class="form-control" id="lifetime" name="lifetime">
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-9">
                    <iframe src="locatemaps" width="100%" height="630" style="border:0;"></iframe>
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
                                    <th><center>API</center></th>
                                    <th>lifetime</th>
                                    <th>Created at</th>
                                    <th>Updated at</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pju as $pjudata)
                                <tr>
                                    <!-- <td>{{ $pjudata->id }}</td> -->
                                    <td>{{ $pjudata->name }}</td>
                                    <td>{{ $pjudata->address }}</td>
                                    <td>{{ $pjudata->lat }}</td>
                                    <td>{{ $pjudata->lng }}</td>
                                    <td>{{ $pjudata->API }}</td>
                                    <td>{{ $pjudata->lifetime }}</td>
                                    <td>{{ $pjudata->created_at }}</td>
                                    <td>{{ $pjudata->updated_at }}</td>
                                    <td>
                                        <a href="{{ route('edit.addpju', $pjudata->id) }}" class="btn btn-warning">Edit</a>
                                        <!-- Tombol untuk menghapus data -->
                                    <form action="{{ route('delete.addpju', $pjudata->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
                                    </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection
