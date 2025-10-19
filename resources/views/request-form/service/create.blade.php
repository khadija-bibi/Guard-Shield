@extends('layouts.auth')
@section('title', 'Service Request')
@section('content')
<div class="d-flex flex-col justify-content-center align-items-center min-vh-100">
    <div class="custom-container">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <h3 class="text-center fw-bold mb-4" style="color: #005957;">Create Service Request</h3>
        
        <form action="{{ route('service-request.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="company_id" class="form-label fw-medium" style="color: #1B4D3E;">Select Company</label>
                <select id="company_id" name="company_id" class="form-control" style="border-color: #00827F;">
                    <option value="">-- Select Company --</option>
                    @foreach($companies as $company)
                        <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : '' }}>
                            {{ $company->name }}
                        </option>
                    @endforeach
                </select>
                @error('company_id')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block">Location Address</label>
                <input type="text" name="location_address" id="location_address" class="form-control" style="border-color: #00827F;" >
                <input type="hidden" name="location_lat" id="location_lat">
                <input type="hidden" name="location_lng" id="location_lng">
                @error('location_address')
                    <p class="text-danger">{{ $message }}</p>  
                @enderror
            </div>

            {{-- <div id="map" style="height: 400px;" class="rounded shadow"></div> --}}
            <div class="mb-3">
                <label for="crewtype" class="form-label fw-medium" style="color: #1B4D3E;">Select Crew Type</label>
                <select id="crewtype" name="crewtype" class="form-control" style="border-color: #00827F;">
                    <option value="">-- Select Crew Type --</option>
                    <option value="Security Guard" {{ old('crewtype') == 'Security Guard' ? 'selected' : '' }}>Security Guard</option>
                    <option value="Armed Guard" {{ old('crewtype') == 'Armed Guard' ? 'selected' : '' }}>Armed Guard</option>
                    <option value="Patrolling Unit" {{ old('crewtype') == 'Patrolling Unit' ? 'selected' : '' }}>Patrolling Unit</option>
                    <option value="Supervisor" {{ old('crewtype') == 'Supervisor' ? 'selected' : '' }}>Supervisor</option>
                    <option value="Response Team" {{ old('crewtype') == 'Response Team' ? 'selected' : '' }}>Response Team</option>
                </select>
                @error('crewtype')
                    <p class="text-danger">{{ $message }}</p>  
                @enderror
            </div>
            <div class="mb-3">
                <label for="description" class="form-label fw-medium" style="color: #1B4D3E;">Description</label>
                <textarea type="text" name="description" class="form-control" id="description" placeholder="e.g. Need 5 security guards for night shift at factory premises" style="border-color: #00827F;">{{old('description')}}</textarea>
                @error('description')
                    <p class="text-danger font-medium">{{$message}}</p>  
                @enderror
            </div>
            <div class="mb-3">
                <label for="severity" class="form-label fw-medium" style="color: #1B4D3E;">Select Severity</label>
                <select id="severity" name="severity" class="form-control" style="border-color: #00827F;">
                    <option value="">-- Select Severity --</option>
                    <option value="Low" {{ old('severity') == 'Low' ? 'selected' : '' }}>Low</option>
                    <option value="Medium" {{ old('severity') == 'Medium' ? 'selected' : '' }}>Medium</option>
                    <option value="High" {{ old('severity') == 'High' ? 'selected' : '' }}>High</option>
                </select>
                @error('severity')
                    <p class="text-danger">{{ $message }}</p>  
                @enderror
            </div>
            <div class="mb-3">
                <label for="date_from" class="form-label fw-medium" style="color: #1B4D3E;">Date From</label>
                <input type="date" value="{{old('date_from')}}" name="date_from" class="form-control" id="date_from" style="border-color: #00827F;">
                @error('date_from')
                    <p class="text-danger font-medium">{{$message}}</p>  
                @enderror
            </div>
            <div class="mb-3">
                <label for="date_to" class="form-label fw-medium" style="color: #1B4D3E;">Date To</label>
                <input type="date" value="{{old('date_to')}}" name="date_to" class="form-control" id="date_to" style="border-color: #00827F;">
                @error('date_to')
                    <p class="text-danger font-medium">{{$message}}</p>  
                @enderror
            </div>
            <div class="mb-3">
                <label for="time_from" class="form-label">From Time</label>
                <input type="time" name="time_from" id="time_from" class="form-control" value="{{ old('time_from') }}">
                @error('time_from')
                    <p class="text-danger font-medium">{{$message}}</p>  
                @enderror
            </div>
            <div class="mb-3">
                <label for="time_to" class="form-label">To Time</label>
                <input type="time" name="time_to" id="time_to" class="form-control" value="{{ old('time_to') }}">
                @error('time_to')
                    <p class="text-danger font-medium">{{$message}}</p>  
                @enderror
            </div>
            <div class="mb-3">
                <label for="paymentPlan" class="form-label fw-medium" style="color: #1B4D3E;">Payment Plan</label>
                <select name="paymentPlan" id="paymentPlan" class="form-control" style="border-color: #00827F;">
                    <option value="">Select Payment Plan</option>
                    <option value="Monthly" {{ old('paymentPlan') == 'Monthly' ? 'selected' : '' }}>Monthly</option>
                    <option value="Weekly" {{ old('paymentPlan') == 'Weekly' ? 'selected' : '' }}>Weekly</option>
                    <option value="One_time" {{ old('paymentPlan') == 'Weekly' ? 'selected' : '' }}>One-Time</option>
                </select>
                @error('paymentPlan')
                    <p class="text-danger font-medium">{{ $message }}</p>
                @enderror
            </div>
              <div class="mb-3">
                <label for="budget" class="form-label fw-medium" style="color: #1B4D3E;">Budget</label>
                <input type="number" placeholder="Enter Budget" value="{{ old('budget') }}" name="budget" class="form-control" id="budget" style="border-color: #00827F;">
                @error('budget')
                    <p class="text-danger font-medium">{{ $message }}</p>  
                @enderror
            </div>
            <button type="submit" class="btn btn-custom w-100 py-2">Submit</button>
        </form>
    </div>
</div>

{{-- <script>
    mapboxgl.accessToken = 'YOUR_MAPBOX_API_KEY';

    const map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v11',
        center: [74.3587, 31.5204], // Lahore default
        zoom: 10
    });

    let marker;

    // On map click
    map.on('click', function (e) {
        const lng = e.lngLat.lng;
        const lat = e.lngLat.lat;

        // Remove old marker
        if (marker) marker.remove();

        // Add new marker
        marker = new mapboxgl.Marker({ draggable: true })
            .setLngLat([lng, lat])
            .addTo(map);

        // Save values
        document.getElementById('location_lat').value = lat;
        document.getElementById('location_lng').value = lng;

        // Reverse Geocode (get address)
        fetch(`https://api.mapbox.com/geocoding/v5/mapbox.places/${lng},${lat}.json?access_token=${mapboxgl.accessToken}`)
            .then(res => res.json())
            .then(data => {
                const place = data.features[0]?.place_name || "Unknown location";
                document.getElementById('location').value = place;
            });
    });
</script> --}}


@endsection
