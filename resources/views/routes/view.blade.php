<div class="col-md-12">
    <div class="card card-info card-outline mb-4">
        <div class="card-body">
            <div id="map" style="height: 300px"></div>
        </div>

        <?php
        $source = json_decode($routes[0]->source_latlng);
        $destination = json_decode($routes[0]->destination_latlng);
        $way_points = html_entity_decode($routes[0]->route_waypoints);
        ?>

        <script>
            function waypoints() {
                var waypoint = <?php echo $way_points; ?>;

                waypoint = waypoint.map(item => {
                    delete item.location;
                    return item;
                });

                //return waypoint;

                var waypoints = [];

                waypoint.forEach(element => {
                    waypoints.push(({
                        location: element
                    }))
                });
                return waypoints;
            }


            function initMap() {

                // Map Center
                const mapCenter = {
                    lat: {{ config('map.INIT_LAT') }},
                    lng: {{ config('map.INIT_LNG') }}
                }; // Dhaka example

                const map = new google.maps.Map(document.getElementById("map"), {
                    zoom: 12,
                    center: mapCenter,
                });

                const directionsService = new google.maps.DirectionsService();
                const directionsRenderer = new google.maps.DirectionsRenderer({
                    map: map,
                    suppressMarkers: false,
                });

                // Start, End & Waypoints
                const start = {
                    lat: {{ $source->latitude }},
                    lng: {{ $source->longitude }}
                }; // Example Start
                const end = {
                    lat: {{ $destination->latitude }},
                    lng: {{ $destination->longitude }}
                }; // Example End


                // Set Directions Request
                const request = {
                    origin: start,
                    destination: end,
                    waypoints: waypoints(),
                    optimizeWaypoints: true,
                    travelMode: google.maps.TravelMode.DRIVING
                };

                // Calculate Route
                directionsService.route(request, function(result, status) {
                    if (status === "OK") {
                        directionsRenderer.setDirections(result);
                    } else {
                        console.log("Directions request failed due to " + status);
                    }
                });
            }


            // Initialize after load
            window.onload = initMap;
        </script>

        <script async defer
            src="https://maps.googleapis.com/maps/api/js?key={{ $mapConfig['MAP_KEY'] }}&libraries=places&callback=initMap">
        </script>
    </div>

    <div class="card card-info card-outline mb-4">
        <!--begin::Header-->
        <div class="card-header">
            <div class="card-title">Route</div>
        </div>
        <div class="card-body">
            <table style="width: 100%">

                <tr>
                    <td>Name/ID:</td>
                    <td>{{ $routes[0]->route_name }}</td>
                </tr>

                <tr>
                    <td>Start poin:</td>
                    <td>{{ $routes[0]->route_source }}</td>
                </tr>

                <tr>
                    <td>End point:</td>
                    <td>{{ $routes[0]->route_destination }}</td>
                </tr>

                <tr>
                    <td>Way points:</td>
                    <td>
                        @foreach (json_decode($routes[0]->route_waypoints) as $driver)
                            <small class="badge badge-secondary">{{ $driver->location }}</small>
                        @endforeach

                    </td>
                </tr>

            </table>
        </div>
    </div>

    <div class="card card-info card-outline mb-4">

        <!--begin::Header-->
        <div class="card-header">
            <div class="card-title">Drivers</div>
        </div>
        <!--end::Header-->
        <div class="card-body" style="height: 200px; overflow:scroll;">
            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>License No.</th>
                    <th>License type.</th>

                </tr>

                @foreach ($drivers as $driver)
                    <tr>
                        <td>{{ $driver->driver_id }}</td>
                        <td>{{ $driver->name }}</td>
                        <td>{{ $driver->phone }}</td>
                        <td>{{ $driver->license_no }}</td>
                        <td>{{ $driver->license_type }}</td>
                    </tr>
                @endforeach


            </table>
        </div>
    </div>

    <div class="card card-info card-outline mb-4">

        <!--begin::Header-->
        <div class="card-header">
            <div class="card-title">Students</div>
        </div>
        <!--end::Header-->
        <div class="card-body" style="height: 200px; overflow:scroll; ">

            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Mobile</th>

                </tr>

                @foreach ($students as $student)
                    <tr>
                        <td>{{ $student->student_id }}</td>
                        <td>{{ $student->student_name }}</td>
                        <td>{{ $student->gender }}</td>
                        <td>{{ $student->phone_number }}</td>
                    </tr>
                @endforeach


            </table>


        </div>
    </div>
</div>
