@extends('layouts.app')
@section('content')
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Live Student</h3>
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
                <div class="col-sm-8">
                    <div class="card card-outline mb-4">
                        {{-- <!--begin::Header-->
                        <div class="card-header">
                            <div class="card-title">
                                <div class="com-sm-4">


                                </div>
                            </div>
                        </div>
                        <!--end::Header--> --}}

                        <div class="card-body p-0">

                            <div id="map" style="height: 500px"></div>


                        </div>

                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card card-info card-outline mb-4">
                                <!--begin::Header-->
                                <div class="card-header">
                                    <div class="card-title">
                                        <div class="com-sm-4">
                                            BUS is on the way to pick up <span class="badge text-bg-warning"
                                                id="travel-time">5 Min</span>
                                            <span class="badge text-bg-primary" id="travel-distance">5 Min</span>

                                        </div>
                                    </div>
                                </div>
                                <!--end::Header-->
                                <div class="card-body ">

                                    <table class="table">
                                        <tr>

                                            <td><small><i class="bi bi-person-video"></i><span class="text-muted">
                                                        Driver</span></small><br>
                                                <strong>{{ @$data[0]->driver_name }}</strong>
                                            </td>
                                        </tr>
                                        <tr>

                                            <td><small><span class="text-muted"><i class="bi bi-telephone-inbound-fill"></i>
                                                        Phone </span></small><br>
                                                <strong>{{ @$data[0]->driver_phone }}</strong>
                                            </td>
                                        </tr>

                                        <tr>

                                            <td><small><span class="text-muted"><i class="bi bi-bus-front-fill"></i> Bus
                                                        Name</span></small><br>
                                                <strong>{{ @$data[0]->bus_name }}</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><small><span class="text-muted"><i class="bi bi-window-sidebar"></i> Bus
                                                        Registration Number</span></small><br>
                                                <strong>{{ @$data[0]->bus_registration_number }}</strong>
                                            </td>
                                        </tr>

                                    </table>

                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="card direct-chat direct-chat-primary mb-4">
                                <div class="card-header" style="cursor: move;">
                                    <h3 class="card-title">Direct Chat</h3>

                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <!-- Conversations are loaded here -->
                                    <div class="direct-chat-messages">
                                        <!-- Message. Default to the start -->
                                        <div class="direct-chat-msg">
                                            <div class="direct-chat-infos clearfix">
                                                <span class="direct-chat-name float-start"> Alexander Pierce </span>
                                                <span class="direct-chat-timestamp float-end"> 23 Jan 2:00 pm </span>
                                            </div>
                                            <!-- /.direct-chat-infos -->
                                            <img class="direct-chat-img" src="/images/driver.png" alt="">
                                            <!-- /.direct-chat-img -->
                                            <div class="direct-chat-text">
                                                Is this template really for free? That's unbelievable!
                                            </div>
                                            <!-- /.direct-chat-text -->
                                        </div>
                                        <!-- /.direct-chat-msg -->
                                        <!-- Message to the end -->
                                        <div class="direct-chat-msg end">
                                            <div class="direct-chat-infos clearfix">
                                                <span class="direct-chat-name float-end"> Sarah Bullock </span>
                                                <span class="direct-chat-timestamp float-start"> 23 Jan 2:05 pm </span>
                                            </div>
                                            <!-- /.direct-chat-infos -->
                                            <img class="direct-chat-img" src="/images/student_m.png" alt="">
                                            <!-- /.direct-chat-img -->
                                            <div class="direct-chat-text">You better believe it!</div>
                                            <!-- /.direct-chat-text -->
                                        </div>
                                        <!-- /.direct-chat-msg -->


                                    </div>
                                    <!-- /.direct-chat-messages-->

                                    <!-- /.direct-chat-pane -->
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <form action="#" method="post">
                                        <div class="input-group">
                                            <input type="text" name="message" placeholder="Type Message ..."
                                                class="form-control">
                                            <span class="input-group-append">
                                                <button type="button" class="btn btn-primary">Send</button>
                                            </span>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.card-footer-->
                            </div>
                        </div>

                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const waypoints = {!! html_entity_decode($data[0]->route_waypoints) !!};
        let map, directionsService, directionsRenderer;
        let source = '{{ $data[0]->route_source }}';
        let destination = '{{ $data[0]->route_destination }}';
        let students_in_route = {};
        let student_markers = {};
        let student_id = 'std{{ $data[0]->student_id }}';
        let student_name = '{{ $data[0]->student_name }}'
        let bus_id = 'bus{{ $data[0]->bus_id }}';
        let school_bus_marker;


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
                }

            );

            directionsService = new google.maps.DirectionsService();
            directionsRenderer = new google.maps.DirectionsRenderer();
            directionsRenderer.setMap(map);

            const options = {
                types: ['{{ $mapConfig['MAP_SEARCH_TYPE'] }}'], // or use ['geocode'] for full addresses
                componentRestrictions: {
                    country: '{{ $mapConfig['COUNTRY'] }}'
                } // restrict to India or remove for global
            };

            //load route
            calculateRoute();

            // Add custom marker
            marker = new google.maps.Marker({
                position: initialPosition,
                map,
                icon: {
                    url: 'images/school_bus_bg_top.png', // custom icon URL
                    scaledSize: new google.maps.Size(40, 40),
                },
                title: 'School Bus',
            });

            school_bus_marker = marker;

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

        function getBearing(startLatLng, endLatLng) {
            const startLat = startLatLng.lat() * Math.PI / 180;
            const startLng = startLatLng.lng() * Math.PI / 180;
            const endLat = endLatLng.lat() * Math.PI / 180;
            const endLng = endLatLng.lng() * Math.PI / 180;

            const dLng = endLng - startLng;

            const y = Math.sin(dLng) * Math.cos(endLat);
            const x = Math.cos(startLat) * Math.sin(endLat) -
                Math.sin(startLat) * Math.cos(endLat) * Math.cos(dLng);

            const bearing = Math.atan2(y, x);
            return (bearing * 180 / Math.PI + 360) % 360; // Normalize to 0-360 degrees
        }


        function fetchAndUpdateMarkers() {
            let data = {
                "_token": "{{ csrf_token() }}",
                //'route_name': $('.route-name-dd').data('route_name')
                'student_id': student_id,
                'bus_id': bus_id
            };

            // $("#loading").css('visibility', 'visible');
            $.ajax({

                url: '/get_bus_and_student_location',
                method: 'GET',
                contentType: 'application/json',
                data: data,
                success: function(response) {


                    console.log(response[1][bus_id]);
                    console.log(response[0]);

                    newBusPosition = {
                        lat: parseFloat(response[1][bus_id].lat),
                        lng: parseFloat(response[1][bus_id].lng)
                    };

                    newStudentPosition = {
                        lat: parseFloat(response[0][student_id].lat),
                        lng: parseFloat(response[0][student_id].lng)
                    };

                    const nextLatLng = new google.maps.LatLng(newBusPosition);
                    const currentPosition = school_bus_marker.getPosition();
                    const heading = getBearing(currentPosition, nextLatLng);


                    //Update student loacation
                    updateMarkerPosition(student_id, newStudentPosition);

                    // upate school bus marker posoition
                    updateBusMarkerPosition(school_bus_marker, parseFloat(response[1][bus_id].lat), parseFloat(
                        response[1][bus_id].lng));

                    school_bus_marker.setIcon({
                        // ...school_bus_marker.getIcon(),
                        rotation: heading
                    });

                    console.log(student_markers);

                    getRouteInfo(newBusPosition, newStudentPosition, (info) => {
                        //console.log("From:", info.start_address);
                        //console.log("To:", info.end_address);
                        //console.log("Distance:", info.distance);
                        console.log("Duration:", info.duration);

                        $("#travel-time").html(info.duration);
                        $("#travel-distance").html(info.distance);
                        //alert(`Duration: ${info.duration} | Distance: ${info.distance}`);
                    });


                    //school_bus_marker.setPosition(newPosition);


                    // setInterval(fetchAndUpdateMarkers, 5000);

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

        function updateBusMarkerPosition(id, lat, lng) {

            const newPosition = new google.maps.LatLng(lat, lng);
            id.setPosition(newPosition);


            //map.panTo(newPosition);

            //id.setPosition(newPosition);

        }

        // Reusable function to get travel time using DirectionsService
        function getRouteInfo(origin, destination, callback) {
            if (!directionsService) {
                console.error("Google Maps API not initialized yet.");
                return;
            }

            const request = {
                origin: origin,
                destination: destination,
                travelMode: google.maps.TravelMode.DRIVING,
            };

            directionsService.route(request, (result, status) => {
                if (status === "OK") {
                    const leg = result.routes[0].legs[0];
                    callback({
                        distance: leg.distance.text,
                        duration: leg.duration.text,
                        start_address: leg.start_address,
                        end_address: leg.end_address,
                    });
                } else {
                    console.error("Directions request failed due to " + status);
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

            //Add student Marker
            addMarker(student_id, {
                'lat': 23.752125395535945,
                'lng': 90.4140276188548
            }, student_name);

            console.log(school_bus_marker);

            //updateBusMarkerPosition(school_bus_marker, 23.752125395535945, 90.4140276188548);
            setInterval(fetchAndUpdateMarkers, 5000);






        });
    </script>
@endsection
