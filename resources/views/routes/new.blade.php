@extends('layouts.app')
@section('style')
    <style>
        #map {
            height: 500px;
            width: 100%;
            margin-top: 20px;
        }

        form {
            display: flex;
            gap: 10px;
            margin-bottom: 10px;
        }

        input {
            padding: 8px;
            width: 250px;
            background-color: #FFF000;
        }

        button {
            padding: 8px 12px;
        }

        .tag {
            display: inline-block;
            background-color: #fff;
            padding: 8px 12px;
            margin: 5px;
            border-radius: 9px;
            position: relative;
            border-color: #2C645C;
            border-width: 1px;
            border-style: solid;
            font-size: 12px;
        }

        .tag .remove-btn {
            margin-left: 10px;
            color: red;
            cursor: pointer;
            font-weight: bold;
            position: absolute;
            top: 0px;
            right: 5px;
            font-size: 12px;
        }
    </style>
@endsection
@section('content')
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Route Manager</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Add New</a></li>
                        <li class="breadcrumb-item" aria-current="page">Show All</li>
                    </ol>
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-sm-5">
                    <div class="card card-info card-outline mb-4">
                        <!--begin::Header-->
                        <div class="card-header">
                            <div class="card-title">Route</div>
                        </div>
                        <!--end::Header-->

                        <div class="card-body">

                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form id="routeForm">
                                            <!--begin::Body-->

                                            <!--begin::Row-->
                                            <div class="row g-3">


                                                <div class="col-md-12">
                                                    <label for="routename" class="form-label">Load Route</label>

                                                    <select id="load-route" name="load_route" class="form-select">
                                                        <option selected>Select ....</option>

                                                        @if (isset($route_name) && count($route_name) > 0 && is_array($route_name))
                                                            @foreach ($route_name as $route)
                                                                <option value="{{ $route->route_name }}">
                                                                    {{ $route->route_name }}</option>
                                                            @endforeach
                                                        @endif

                                                    </select>
                                                    {{-- <input type="text" id="routename" class="form-control"
                                                        placeholder="Enter location"> --}}
                                                </div>


                                                <!--begin::Col-->
                                                <div class="col-md-6">
                                                    <label for="source" class="form-label">Source</label>
                                                    <input type="text" class="form-control" id="source"
                                                        placeholder="Enter Source" required>

                                                </div>
                                                <!--end::Col-->
                                                <!--begin::Col-->
                                                <div class="col-md-6">
                                                    <label for="destination" class="form-label">Destination</label>
                                                    <input type="text" id="destination" class="form-control"
                                                        placeholder="Enter Destination" required>

                                                </div>
                                                <!--end::Col-->


                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label for="locationInput" class="form-label">Waypoint</label>
                                                            <input type="text" id="locationInput"
                                                                class="form-control me-2" placeholder="Enter location">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="addwaypoint" class="form-label">&nbsp;</label>
                                                            <button class="btn btn-outline-success form-control"
                                                                id="addwaypoint" onclick="addLocation()">Add
                                                                waypoint</button>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label">&nbsp;</label>
                                                            <button type="submit"
                                                                class="btn btn-outline-primary form-control">Show
                                                                Route</button>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="col-md-9">
                                                    <div id="locationList" style="margin-top: 20px;"></div>
                                                </div>
                                            </div>
                                            <!--end::Row-->

                                        </form>
                                    </div>



                                </div>
                            </div>
                        </div>

                        <div class="card-footer" style="padding-top: 15px; padding-bottom:15px;">
                            <div class="row">
                                <div class="col-sm-8">

                                    <input type="text" id="routename" class="form-control" placeholder="Route Name">
                                </div>
                                <div class="col-sm-4">
                                    <button type="button" id="save-route" class="btn btn-outline-primary form-control">Save
                                        Route</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-sm-7">
                    <div class="card card-info card-outline mb-4">
                        <!--begin::Header-->
                        {{-- <div class="card-header">
                            <div class="card-title"></div>
                        </div> --}}
                        <!--end::Header-->

                        <div class="card-body">
                            <div id="map" style="height: 500px"></div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-default card-outline mb-4">


                        <div class="card-body p-0">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script>
        //Waypoint Manage

        const waypoints = [];
        let waypointLatLng;

        let source_latlng, destination_latlng;


        function addLocation() {
            const input = document.getElementById("locationInput");
            const location = input.value.trim();

            if (location) {
                waypoint = {
                    location: location,
                    stopover: true,
                    lat: waypointLatLng.latitude,
                    lng: waypointLatLng.longitude,
                };
                waypoints.push(waypoint);

                //console.log(waypoints);

                renderWaypoints();
                input.value = '';

            }
        }

        function removeLocation(index) {
            waypoints.splice(index, 1);
            renderWaypoints();
        }

        function renderWaypoints() {
            const container = document.getElementById("locationList");
            container.innerHTML = "";

            waypoints.forEach((waypoint, index) => {
                const tag = document.createElement("div");
                tag.className = "tag";
                tag.innerHTML =
                    `${waypoint.location} <span class="remove-btn" onclick="removeLocation(${index})">x</span>`;
                container.appendChild(tag);
            });
        }
        //-- end of waypoint manage




        let map, directionsService, directionsRenderer;

        function initMap() {
            map = new google.maps.Map(document.getElementById("map"), {
                center: {
                    lat: 20.5937,
                    lng: 78.9629
                },
                zoom: 5
            });

            directionsService = new google.maps.DirectionsService();
            directionsRenderer = new google.maps.DirectionsRenderer();
            directionsRenderer.setMap(map);

            // Add autocomplete
            const sourceInput = document.getElementById("source");
            const destInput = document.getElementById("destination");
            const locationInput = document.getElementById("locationInput");


            const options = {
                types: ['{{ $mapConfig['MAP_SEARCH_TYPE'] }}'], // or use ['geocode'] for full addresses
                componentRestrictions: {
                    country: '{{ $mapConfig['COUNTRY'] }}'
                } // restrict to India or remove for global
            };

            const source = new google.maps.places.Autocomplete(sourceInput, options);
            const destination = new google.maps.places.Autocomplete(destInput, options);
            const autocomplete = new google.maps.places.Autocomplete(locationInput, options);


            // Listen when a user selects a place
            source.addListener("place_changed", () => {
                const place = source.getPlace();

                if (place.geometry && place.geometry.location) {
                    const lat = place.geometry.location.lat();
                    const lng = place.geometry.location.lng();
                    source_latlng = {
                        "latitude": lat,
                        "longitude": lng
                    };

                    console.log("source: ");
                    console.log(source_latlng);

                } else {
                    console.log("No details available for this place.");
                }
            });


            // Listen when a user selects a place
            destination.addListener("place_changed", () => {
                const place = destination.getPlace();

                if (place.geometry && place.geometry.location) {
                    const lat = place.geometry.location.lat();
                    const lng = place.geometry.location.lng();
                    destination_latlng = {
                        "latitude": lat,
                        "longitude": lng
                    };


                    console.log("destination:");
                    console.log(destination_latlng);

                } else {
                    console.log("No details available for this place.");
                }
            });






            // Listen when a user selects a place
            autocomplete.addListener("place_changed", () => {
                const place = autocomplete.getPlace();

                if (place.geometry && place.geometry.location) {
                    const lat = place.geometry.location.lat();
                    const lng = place.geometry.location.lng();
                    waypointLatLng = {
                        "latitude": lat,
                        "longitude": lng
                    };

                    console.log("Waypoints:");
                    console.log(waypointLatLng);

                } else {
                    console.log("No details available for this place.");
                }
            });


            document.getElementById("routeForm").addEventListener("submit", function(e) {
                e.preventDefault();
                calculateRoute();
            });
        }

        function calculateRoute() {
            const source = document.getElementById("source").value;
            const destination = document.getElementById("destination").value;

            // Deep copy the array using JSON (safe for simple data)
            let tempWayPoints = JSON.parse(JSON.stringify(waypoints));


            //console.log(waypoints);
            //remove Lat and Lng form array
            tempWayPoints.forEach(wp => {
                if ("lat" in wp) delete wp.lat;
                if ("lng" in wp) delete wp.lng;
            });

            console.log(tempWayPoints);


            const request = {
                origin: source,
                destination: destination,

                waypoints: tempWayPoints,

                optimizeWaypoints: false,

                travelMode: google.maps.TravelMode.DRIVING
            };

            directionsService.route(request, function(result, status) {
                if (status === google.maps.DirectionsStatus.OK) {
                    directionsRenderer.setDirections(result);
                } else {
                    alert("Route not found: " + status);
                }
            });
        }

        async function getLatLngFromAddress(address, apiKey = "{{ $mapConfig['MAP_KEY'] }}") {
            const url =
                `https://maps.googleapis.com/maps/api/geocode/json?address=${encodeURIComponent(address)}&key=${apiKey}`;

            try {
                const response = await fetch(url);
                const data = await response.json();

                if (data.status === "OK") {
                    const location = data.results[0].geometry.location;
                    return {
                        lat: location.lat,
                        lng: location.lng
                    };
                } else {
                    throw new Error("Geocoding failed: " + data.status);
                }
            } catch (error) {
                console.error("Error fetching geocoding data:", error);
                return null;
            }
        }
    </script>

    <!-- Include Google Maps JS with Places Library -->

    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key={{ $mapConfig['MAP_KEY'] }}&libraries=places&callback=initMap">
    </script>

    <script>
        $(document).ready(function() {
            $("#save-route").click(function() {

                // console.log(waypoints);
                data = {
                    "_token": "{{ csrf_token() }}",
                    'old_route_name': $("#load-route").val(),
                    'new_route_name': $("#routename").val(),
                    'source': $("#source").val(),
                    'destination': $("#destination").val(),
                    'source_latlng': source_latlng,
                    'destination_latlng': destination_latlng,
                    'way': waypoints,
                };



                if (data.old_route_name.length < 1 || data.source.length <
                    1 || data.destination.length < 1) {
                    alert('Please select the fields');
                    return false;
                }

                $("#loading").css('visibility', 'visible');

                //send data to server for save
                $.ajax({

                    url: '/saveroute',
                    method: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify(data),
                    success: function(response) {
                        $("#loading").css('visibility', 'hidden');
                        console.log('Success:', response);

                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message,
                            timer: 2500,
                            showConfirmButton: false,
                        });
                    },
                    error: function(xhr) {
                        $("#loading").css('visibility', 'hidden');
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: xhr.responseText,
                        });
                    }
                });

                // console.log(data);

            });

            //Load existing route
            $('#load-route').change(function() {


                //clean Waypoint list
                waypoints.length = 0;
                $("#locationList").html('');

                let data = {
                    "_token": "{{ csrf_token() }}",
                    'route_name': $("#load-route").val()
                };

                $("#loading").css('visibility', 'visible');
                $.ajax({

                    url: '/loadroute',
                    method: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify(data),
                    success: function(response) {
                        $("#loading").css('visibility', 'hidden');

                        //console.log('Success:', response.data);
                        let response_data = JSON.parse(response.data);
                        //console.log('Success:', response_data[0]);
                        // console.log(response_data.route_name);
                        let map_data = response_data[0];

                        $("#source").val(map_data.route_source);
                        $("#destination").val(map_data.route_destination);
                        let old_waypoints = JSON.parse(map_data.route_waypoints);

                        $.each(old_waypoints, function(index, val) {
                            console.log(val);
                            waypoints.push(val);
                        })

                        //console.log(waypoints);
                        renderWaypoints();

                        calculateRoute();




                    },
                    error: function(xhr) {
                        $("#loading").css('visibility', 'hidden');
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: xhr.responseText,
                        });
                    }
                });

            });

        });
    </script>
@endsection
