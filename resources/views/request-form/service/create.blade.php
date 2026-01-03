@extends('layouts.main')
@section('title', 'Service Request-Create')
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
            <div class="row">
                {{-- Right Column --}}
                <div class="col-md-6">
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
                        <label>Search Location:</label>
                        <input type="text" id="search_location" class="form-control" placeholder="Search location...">

                        <div id="suggestions" style="background:white; border:1px solid #ccc; display:none; position:absolute; z-index:999; width:100%; max-height:200px; overflow-y:auto;"></div>

                        <br>
                        <div id="map" style="height: 400px;"></div>

                        <label>Address:</label>
                        <input type="text" id="location_address" name="location_address" class="form-control" readonly>

                        <label>Latitude:</label>
                        <input type="text" id="location_lat" name="location_lat" class="form-control" readonly>

                        <label>Longitude:</label>
                        <input type="text" id="location_lng" name="location_lng" class="form-control" readonly>

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
                </div>
                {{-- Right Column --}}
                <div class="col-md-6">
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
                    <div class="mb-3" id="paymentPlanWrapper">
                        <label for="paymentPlan" class="form-label fw-medium" style="color: #1B4D3E;">Payment Plan</label>
                        <select name="paymentPlan" id="paymentPlan" class="form-control" style="border-color: #00827F;">
                            <option value="">Select Payment Plan</option>
                            <option value="Monthly">Monthly</option>
                            <option value="One_time">One-Time</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="budget" class="form-label fw-medium" style="color: #1B4D3E;">Budget</label>
                        <input type="number" placeholder="Enter Budget" value="{{ old('budget') }}" name="budget" class="form-control" id="budget" style="border-color: #00827F;">
                        @error('budget')
                            <p class="text-danger font-medium">{{ $message }}</p>  
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-custom w-100 py-2">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
mapboxgl.accessToken = "{{ env('MAPBOX_TOKEN') }}";

const map = new mapboxgl.Map({
    container: 'map',
    style: 'mapbox://styles/mapbox/streets-v11',
    center: [73.0479, 33.6844], // Islamabad
    zoom: 10
});

let marker;

// ---------------------------
// CUSTOM LANDMARKS JSON
// ---------------------------
const landmarks = [
  {
    "name": "NUML Islamabad",
    "lat": 33.66704,
    "lng": 73.05056
  },
  {
    "name": "Faisal Masjid",
    "lat": 33.73009,
    "lng": 73.03718
  },
  {
    "name": "Pakistan Monument",
    "lat": 33.69356,
    "lng": 73.06886
  },
  {
    "name": "Centaurus Mall",
    "lat": 33.70795,
    "lng": 73.05024
  },
  {
    "name": "Jinnah Convention Center",
    "lat": 33.71962,
    "lng": 74.10726
  }
];

// ---------------------------
// SET MARKER + ADDRESS
// ---------------------------
function setMarkerAndAddress(long, lat, address = null) {
    if (marker) marker.remove();

    marker = new mapboxgl.Marker().setLngLat([long, lat]).addTo(map);

    document.getElementById('location_lat').value = lat;
    document.getElementById('location_lng').value = long;

    if (address) {
        document.getElementById('location_address').value = address;
        return;
    }

    fetch(`https://api.mapbox.com/geocoding/v5/mapbox.places/${long},${lat}.json?access_token={{ env('MAPBOX_TOKEN') }}`)
        .then(res => res.json())
        .then(data => {
            const place = data.features[0]?.place_name;
            document.getElementById('location_address').value = place;
        });
}

// ---------------------------
// MAP CLICK
// ---------------------------
map.on('click', function (e) {
    setMarkerAndAddress(e.lngLat.lng, e.lngLat.lat);
});

// ---------------------------
// AUTOCOMPLETE SEARCH
// ---------------------------
document.getElementById('search_location').addEventListener('keyup', function () {
    let query = this.value.toLowerCase();
    const sugBox = document.getElementById('suggestions');
    sugBox.innerHTML = "";

    if (query.length < 1) {
        sugBox.style.display = "none";
        return;
    }

    sugBox.style.display = "block";

    // 1️⃣ SEARCH CUSTOM LANDMARKS FIRST
    let found = landmarks.filter(l => l.name.toLowerCase().includes(query));
    found.forEach(item => {
        let div = document.createElement('div');
        div.style.padding = "8px";
        div.style.cursor = "pointer";
        div.innerHTML = item.name;

        div.addEventListener('click', function () {
            map.flyTo({ center: [item.lng, item.lat], zoom: 15 });
            setMarkerAndAddress(item.lng, item.lat, item.name);
            sugBox.style.display = "none";
            document.getElementById('search_location').value = item.name;
        });

        sugBox.appendChild(div);
    });

    // 2️⃣ FALLBACK TO MAPBOX SEARCH IF NO CUSTOM LANDMARK MATCHES
    if (found.length === 0) {
        fetch(`https://api.mapbox.com/geocoding/v5/mapbox.places/${query}.json?autocomplete=true&country=pk&types=poi,address&access_token={{ env('MAPBOX_TOKEN') }}`)
            .then(res => res.json())
            .then(data => {
                data.features.forEach(item => {
                    let div = document.createElement('div');
                    div.style.padding = "8px";
                    div.style.cursor = "pointer";
                    div.innerHTML = item.place_name;

                    div.addEventListener('click', function () {
                        map.flyTo({ center: item.center, zoom: 15 });
                        setMarkerAndAddress(item.center[0], item.center[1], item.place_name);
                        sugBox.style.display = "none";
                        document.getElementById('search_location').value = item.place_name;
                    });

                    sugBox.appendChild(div);
                });

                if (!sugBox.innerHTML.trim()) {
                    sugBox.innerHTML = "<div style='padding:8px;color:red;'>No location found inside Pakistan.</div>";
                }
            });
    }
});


</script>

<script>
document.addEventListener("DOMContentLoaded", () => {

    let dateFrom = document.getElementById("date_from");
    let dateTo = document.getElementById("date_to");
    let paymentPlan = document.getElementById("paymentPlan");

    function updatePaymentPlan() {
        let from = dateFrom.value;
        let to = dateTo.value;

        if (!from || !to) {
            return;
        }

        let start = new Date(from);
        let end = new Date(to);

        if (end < start) {
            alert("Date To cannot be earlier than Date From");
            dateTo.value = "";
            return;
        }

        // Total days difference
        let diffTime = end - start;
        let diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

        // ---------- LOGIC ----------
        // If < 30 days → Only One-Time
        // If ≥ 30 days → Show Monthly + One-Time
        // ---------------------------

        paymentPlan.innerHTML = ""; // clear options

        // Always keep default
        let defaultOption = document.createElement("option");
        defaultOption.value = "";
        defaultOption.textContent = "Select Payment Plan";
        paymentPlan.appendChild(defaultOption);

        if (diffDays <= 35) {
            // Short-term → No monthly
            let oneTime = document.createElement("option");
            oneTime.value = "One_time";
            oneTime.textContent = "One-Time";
            paymentPlan.appendChild(oneTime);

        } else {
            // Long-term → show both
            let monthly = document.createElement("option");
            monthly.value = "Monthly";
            monthly.textContent = "Monthly";

            let oneTime = document.createElement("option");
            oneTime.value = "One_time";
            oneTime.textContent = "One-Time";

            paymentPlan.appendChild(monthly);
            paymentPlan.appendChild(oneTime);
        }
    }

    dateFrom.addEventListener("change", updatePaymentPlan);
    dateTo.addEventListener("change", updatePaymentPlan);
});
</script>
{{-- <script>
$('#date_from, #date_to').on('change', function () {
    let from = $('#date_from').val();
    let to = $('#date_to').val();

    if (!from || !to) return;

    $.ajax({
        url: '/payment-plans',
        type: 'POST',
        data: {
            date_from: from,
            date_to: to,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function (res) {
            let select = $('#paymentPlan');
            select.empty();

            res.plans.forEach(plan => {
                select.append(`<option value="${plan}">${plan.replace('_', ' ')}</option>`);
            });
        }
    });
});

</script> --}}



@endsection
