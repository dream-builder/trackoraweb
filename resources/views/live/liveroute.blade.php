@extends('layouts.app')
@section('content')
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Live Traffic</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('student.create') }}">Add New</a></li>
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
                <div class="col-sm-12">
                    <div class="card card-info card-outline mb-4">
                        <!--begin::Header-->
                        <div class="card-header">
                            <div class="card-title">
                                <div class="com-sm-4">

                                    <form>
                                        <select class="form-select" id="load-route">
                                            <option>Please select route ...</option>

                                            @if (is_array($routes))
                                                @foreach ($routes as $route)
                                                    <option value="{{ $route->route_name }}">{{ $route->route_name }}
                                                    </option>
                                                @endforeach
                                            @endif

                                        </select>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!--end::Header-->

                        <div class="card-body p-0">
                            <div id="map" style="height: 500px"></div>
                        </div>

                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const waypoints = [];
        let map, directionsService, directionsRenderer;
        let source;
        let destination;
        let students_in_route = {};
        let student_markers = {};

        const initialPosition = {
            lat: 23.760768772762013,
            lng: 90.41925034018475
        };

        function initMap() {
            map = new google.maps.Map(document.getElementById("map"), {
                center: {
                    lat: {{ $mapConfig['INIT_LAT'] }},
                    lng: {{ $mapConfig['INIT_LNG'] }}
                },
                zoom: {{ $mapConfig['ZOOM'] }}
            });

            directionsService = new google.maps.DirectionsService();
            directionsRenderer = new google.maps.DirectionsRenderer();
            directionsRenderer.setMap(map);

            const options = {
                types: ['{{ $mapConfig['MAP_SEARCH_TYPE'] }}'], // or use ['geocode'] for full addresses
                componentRestrictions: {
                    country: '{{ $mapConfig['COUNTRY'] }}'
                } // restrict to India or remove for global
            };

            // new google.maps.places.Autocomplete(sourceInput, options);
            // new google.maps.places.Autocomplete(destInput, options);
            // new google.maps.places.Autocomplete(locationInput, options);
            // document.getElementById("routeForm").addEventListener("submit", function(e) {
            //     e.preventDefault();
            //     calculateRoute();
            // });

            // Add custom marker
            marker = new google.maps.Marker({
                position: initialPosition,
                map,
                icon: {
                    url: 'images/school_bus_bg.png', // custom icon URL
                    scaledSize: new google.maps.Size(40, 40),
                },
                title: 'School Bus',
            });
        }

        function calculateRoute() {
            const request = {
                origin: source,
                destination: destination,

                waypoints: waypoints,

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

        async function fetchAndUpdateMarkers() {
            try {
                const response = await fetch(
                    '/api/getlivelocation'); // Replace with your real API
                const data = await response.json();

                // Assuming API returns { lat: ..., lng: ... }
                const newPosition = {
                    lat: data.start,
                    lng: data.end
                };

                // Update marker position
                marker.setPosition(newPosition);

                // Optionally center map
                map.panTo(newPosition);
            } catch (error) {
                console.error('Error fetching location:', error);
            }
        }


        function addMarker(id, position, title) {
            const marker = new google.maps.Marker({
                position: position,
                map: map,
                title: title,
                icon: {
                    url: 'images/student_m_bg.png', // custom icon URL
                    scaledSize: new google.maps.Size(40, 40),
                }
            });
            student_markers[id] = marker;
        }

        // Update position of a marker by ID
        function updateMarkerPosition(id, newPosition) {
            if (student_markers[id]) {
                student_markers[id].setPosition(newPosition);
            } else {
                console.warn("Marker ID not found:", id);
            }
        }


        function load_students_of_this_route_by_route_id(route_id) {
            data = {
                'route_id': route_id
            }
            $.ajax({
                url: '/api/load_students_of_this_route_by_route_id',
                method: 'GET',
                contentType: 'application/json',
                data: data,
                success: function(response) {
                    // $("#loading").css('visibility', 'hidden');

                    // $.each(response, function(index, val) {
                    //     // Update marker position
                    //     addMarker(val.student_id, {
                    //         'lat': 23.752125395535945,
                    //         'lng': 90.4140276188548
                    //     }, val.student_name);
                    // });

                    students_in_route = response;
                    console.log(students_in_route);
                    getstudents_markers(students_in_route);

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
        }


        //THis function will update the marker position on MAP depending on the value stored in JSON file
        function getstudents_markers(students_in_route) {


            // if (students_in_route.length > 0) {

            //     $.each(students_in_route, function(index, val) {
            //         console.log(val.student_id);
            //     })


            // }

            // return;


            data = {
                'bus_id': 1
            }
            $.ajax({
                url: '/api/getstudentlocationstatus',
                method: 'GET',
                contentType: 'application/json',
                data: data,
                success: function(response) {
                    $("#loading").css('visibility', 'hidden');

                    $.each(response, function(index, val) {
                        // Update marker position
                        addMarker(val.student_id, {
                            'lat': 23.752125395535945,
                            'lng': 90.4140276188548
                        }, val.student_name);
                    });


                    // markers = new google.maps.Marker({
                    //     position: {
                    //         'lat': 23.752125395535945,
                    //         'lng': 90.4140276188548
                    //     },
                    //     map,
                    //     icon: {
                    //         url: 'images/student_m.jpg', // custom icon URL
                    //         scaledSize: new google.maps.Size(40, 40),
                    //     },
                    //     title: 'Student',
                    // });

                    console.log(student_markers);


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
        }
    </script>

    <!-- Include Google Maps JS with Places Library -->

    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key={{ $mapConfig['MAP_KEY'] }}&libraries=places&callback=initMap">
    </script>

    <script>
        $(document).ready(function() {

            //Load existing route
            $('#load-route').change(function() {
                // $('.route-name-dd').click(function() {
                //clean Waypoint list
                waypoints.length = 0;
                $("#locationList").html('');

                let data = {
                    "_token": "{{ csrf_token() }}",
                    //'route_name': $('.route-name-dd').data('route_name')
                    'route_name': $('#load-route').val()
                };

                $("#loading").css('visibility', 'visible');
                $.ajax({

                    url: '/loadroute',
                    method: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify(data),
                    success: function(response) {
                        $("#loading").css('visibility', 'hidden');

                        // console.log('Success:', response.data);
                        let response_data = JSON.parse(response.data);
                        //console.log('Success:', response_data[0]);
                        // console.log(response_data[0].id);
                        let map_data = response_data[0];

                        source = map_data.route_source;
                        destination = map_data.route_destination;
                        let old_waypoints = JSON.parse(map_data.route_waypoints);

                        $.each(old_waypoints, function(index, val) {

                            waypoints.push(val);
                        })

                        //console.log(waypoints);
                        //renderWaypoints();

                        //load Students who will use this route and update the students marker array;
                        load_students_of_this_route_by_route_id(response_data[0].id);

                        calculateRoute();

                        setInterval(fetchAndUpdateMarkers, 5000);

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
