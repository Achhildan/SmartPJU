<div class="row">
    <div class="col-md-3">
        <div class="rounded-frame" style="border: 1px solid #ced4da; border-radius: 10px; padding: 20px;">
            <h5 style="text-align: left;">Edit Lamp Location</h5> 
            <form method="POST" action="{{ route('update.location', $marker->id) }}">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $marker->name }}">
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="address" name="address" value="{{ $marker->address }}">
                </div>
                <div class="mb-3">
                    <label for="latitude" class="form-label">Latitude</label>
                    <input type="text" class="form-control" id="latitude" name="lat" value="{{ $marker->lat }}">
                </div>
                <div class="mb-3">
                    <label for="longitude" class="form-label">Longitude</label>
                    <input type="text" class="form-control" id="longitude" name="lng" value="{{ $marker->lng }}">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>