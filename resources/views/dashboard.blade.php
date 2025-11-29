@extends('layouts.app')
@section('style')
    <style>
        #map {
            height: 500px;
            width: 100%;
        }

        #info {
            padding: 10px;
            font-family: Arial, sans-serif;
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
                    <h3 class="mb-0">Dashboard</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
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
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon text-bg-primary shadow-sm">
                            <i class="bi bi-sign-intersection-y-fill"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Active Routes</span>
                            <span class="info-box-number">
                                {{ $card_data->route_count }}
                                {{-- <small>%</small> --}}
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon text-bg-info shadow-sm">
                            <i class="bi bi-bus-front-fill" style="color: white"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Buses</span>
                            <span class="info-box-number">{{ $card_data->bus_count }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <!-- fix for small devices only -->
                <!-- <div class="clearfix hidden-md-up"></div> -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon text-bg-warning shadow-sm">
                            <i class="bi bi-person-vcard-fill" style="color: white"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Students Traveling</span>
                            <span class="info-box-number">100</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon text-bg-success shadow-sm">
                            <i class="bi bi-people-fill" style="color: white"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Travel Completed</span>
                            <span class="info-box-number">20</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!--begin::Row Studnet report-->
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-title">Student Status</h5>
                            {{-- <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                                    <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                                    <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                                </button>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-tool dropdown-toggle" data-bs-toggle="dropdown">
                                        <i class="bi bi-wrench"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" role="menu">
                                        <a href="#" class="dropdown-item">Action</a>
                                        <a href="#" class="dropdown-item">Another action</a>
                                        <a href="#" class="dropdown-item"> Something else here </a>
                                        <a class="dropdown-divider"></a>
                                        <a href="#" class="dropdown-item">Separated link</a>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-tool" data-lte-toggle="card-remove">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            </div> --}}
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <!--begin::Row-->
                            <div class="row">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Status</th>
                                            <th>Status Update Time</th>
                                            <th></th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        @if (isset($student_status) && is_array($student_status))
                                            @foreach ($student_status as $ss)
                                                <?php
                                                $dt = new DateTime($ss->status_time);
                                                
                                                $date = $dt->format('d-m-Y'); // Date: 07-10-2025
                                                $time = $dt->format('H:i:s'); // Time: 13:45:30
                                                
                                                $badge = 'bg-primary';
                                                
                                                switch ($ss->status) {
                                                    case 'Check in':
                                                        $badge = 'bg-success';
                                                        break;
                                                    case 'Check out to School':
                                                        $badge = 'bg-primary';
                                                        break;
                                                
                                                    case 'Check out to home ':
                                                        $badge = 'bg-secondary';
                                                        break;
                                                
                                                    default:
                                                        $badge = 'bg-light';
                                                        break;
                                                }
                                                
                                                ?>

                                                <tr>
                                                    <td>{{ $ss->name }}</td>
                                                    <td> <span
                                                            class="badge rounded-pill {{ $badge }}">{{ $ss->status }}</span>
                                                    </td>
                                                    <td>
                                                        <label>
                                                            <span class="material-symbols-outlined"
                                                                style="font-size: 16px">calendar_month</span>
                                                            {{ $date }}
                                                        </label>
                                                        &nbsp;&nbsp;
                                                        <label>
                                                            <span class="material-symbols-outlined" style="font-size: 16px">
                                                                nest_clock_farsight_analog
                                                            </span>
                                                            {{ $time }}
                                                        </label>

                                                    </td>
                                                    <td><a href="#" class="btn btn-sm btn-primary">Detail</a></td>
                                                </tr>
                                            @endforeach
                                        @endif

                                    </tbody>


                                </table>
                            </div>
                            <!--end::Row-->
                        </div>
                        <!-- ./card-body -->

                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!--end::Row-->


            <!--begin::Row Live tracking-->
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-title">Live Bus Routes</h5>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                                    <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                                    <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                                </button>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-tool dropdown-toggle" data-bs-toggle="dropdown">
                                        <i class="bi bi-wrench"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" role="menu">
                                        <a href="#" class="dropdown-item">Action</a>
                                        <a href="#" class="dropdown-item">Another action</a>
                                        <a href="#" class="dropdown-item"> Something else here </a>
                                        <a class="dropdown-divider"></a>
                                        <a href="#" class="dropdown-item">Separated link</a>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-tool" data-lte-toggle="card-remove">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div id="map" style="height: 500px"></div>

                            </div>
                        </div>
                        <!-- ./card-body -->
                        <div class="card-footer">
                            <div id="info"></div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!--end::Row-->






        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content-->
@endsection

@section('scripts')
    <script>
        let map, directionsService, directionsRenderer;
        let destination = {
            lat: {{ config('map.INIT_LAT') }},
            lng: {{ config('map.INIT_LNG') }}
        }; // Changi Airport (example)

        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 13,
                center: destination
            });

            directionsService = new google.maps.DirectionsService();
            directionsRenderer = new google.maps.DirectionsRenderer({
                polylineOptions: {
                    strokeColor: '#0000FF', // ← your custom color
                    strokeOpacity: 0.8, // optional
                    strokeWeight: 6 // optional
                },
                suppressMarkers: false, // keep default markers
                preserveViewport: true, // don’t recenter/zoom the map
                map: map
            });

            // Start polling for live location every 10 seconds
            updateRoute();
            //setInterval(updateRoute, 10000); // 10 seconds
        }

        async function updateRoute() {
            try {
                const origin = await fetchCurrentLocation();

                const request = {
                    origin: origin,
                    destination: destination,
                    travelMode: google.maps.TravelMode.DRIVING
                };

                directionsService.route(request, (result, status) => {
                    if (status === google.maps.DirectionsStatus.OK) {
                        directionsRenderer.setDirections(result);

                        const leg = result.routes[0].legs[0];
                        document.getElementById("info").innerHTML = `
              <strong>Live Tracking Info:</strong><br>
              From: ${leg.start_address}<br>
              To: ${leg.end_address}<br>
              Duration: ${leg.duration.text}<br>
              Distance: ${leg.distance.text}<br>
              ETA: ${getArrivalTime(leg.duration.value)}
            `;
                    } else {
                        console.error("Directions request failed:", status);
                    }
                });
            } catch (error) {
                console.error("Error fetching location:", error);
            }
        }

        // Simulated API call — replace with your real API call
        async function fetchCurrentLocation() {
            // Example: Replace with your real API call
            const response = await fetch(
                "api/getlivelocation"); // Replace with your endpoint
            const data = await response.json();

            console.log(data);

            return {
                lat: data.start,
                lng: data.end
            };
        }

        function getArrivalTime(durationSeconds) {
            const arrival = new Date(Date.now() + durationSeconds * 1000);
            return arrival.toLocaleTimeString([], {
                hour: '2-digit',
                minute: '2-digit'
            });
        }
    </script>



    <!-- Load the Google Maps API (replace YOUR_API_KEY with your actual key) -->
    <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ $mapConfig['MAP_KEY'] }}&callback=initMap">
    </script>
@endsection
