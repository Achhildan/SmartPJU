@extends('sidebar')
@section('title', 'Edit PJU Data')
@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Edit PJU Data</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Edit PJU Data Detail</li>
            </ol>

            <div class="container-fluid">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
                @endif

                <div class="row">
                    <div class="col-md-8">
                        <div class="rounded-frame" style="border: 1px solid #ced4da; border-radius: 10px; padding: 20px;">
                            <h5 style="text-align: left;">Edit PJU Monitoring</h5>
                            <form method="POST" action="{{ route('update.addpju', $pju->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name*</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $pju->name }}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="address" name="address" value="{{ $pju->address }}">
                                </div>
                                <div class="mb-3">
                                    <label for="latitude" class="form-label">Latitude</label>
                                    <input type="text" class="form-control" id="latitude" name="lat" value="{{ $pju->lat }}">
                                </div>
                                <div class="mb-3">
                                    <label for="longitude" class="form-label">Longitude</label>
                                    <input type="text" class="form-control" id="longitude" name="lng" value="{{ $pju->lng }}">
                                </div>
                                <div class="mb-3">
                                    <label for="API" class="form-label">API*</label>
                                    <input type="text" class="form-control" id="API" name="API" value="{{ $pju->API }}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="lifetime" class="form-label">lifetime</label>
                                    <input type="text" class="form-control" id="lifetime" name="lifetime" value="{{ $pju->lifetime }}">
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>
                </div><br/>
            </div>
        </div>
    </main>
</div>
@endsection
