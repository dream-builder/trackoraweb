@extends('layouts.app')
@section('content')
    <style>
        #map {
            height: 90vh;
            width: 100%;
        }

        #info {
            padding: 10px;
            font-family: Arial, sans-serif;
        }
    </style>

    <div class="mdc-layout-grid">
        <div class="mdc-layout-grid__inner">
            <div
                class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-3-desktop mdc-layout-grid__cell--span-4-tablet">
                <div class="mdc-card info-card info-card--success">
                    <div class="card-inner">
                        <h5 class="card-title">Routes</h5>
                        <h5 class="font-weight-light pb-2 mb-1 border-bottom">{{ $card_data->route_count }}</h5>
                        <p class="tx-12 text-muted">10 traveling</p>

                        <div class="card-icon-wrapper">
                            <img class="material-icons" style="width: 30px; height:30px;" src="assets/images/icons/road.svg">
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-3-desktop mdc-layout-grid__cell--span-4-tablet">
                <div class="mdc-card info-card info-card--danger">
                    <div class="card-inner">
                        <h5 class="card-title">Total Person on Bus</h5>
                        <h5 class="font-weight-light pb-2 mb-1 border-bottom">$1,958,104.00</h5>
                        <p class="tx-12 text-muted">55% target reached</p>
                        <div class="card-icon-wrapper">
                            <i class="material-icons">attach_money</i>
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-3-desktop mdc-layout-grid__cell--span-4-tablet">
                <div class="mdc-card info-card info-card--primary">
                    <div class="card-inner">
                        <h5 class="card-title">Total Person Waitig for Bus</h5>
                        <h5 class="font-weight-light pb-2 mb-1 border-bottom">$234,769.00</h5>
                        <p class="tx-12 text-muted">87% target reached</p>
                        <div class="card-icon-wrapper">
                            <i class="material-icons">trending_up</i>
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-3-desktop mdc-layout-grid__cell--span-4-tablet">
                <div class="mdc-card info-card info-card--info">
                    <div class="card-inner">
                        <h5 class="card-title">Average Income</h5>
                        <h5 class="font-weight-light pb-2 mb-1 border-bottom">$1,200.00</h5>
                        <p class="tx-12 text-muted">87% target reached</p>
                        <div class="card-icon-wrapper">
                            <i class="material-icons">credit_card</i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                <div class="mdc-card">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mb-0">Revenue by location</h4>
                        <div>
                            <i class="material-icons refresh-icon">refresh</i>
                            <i class="material-icons options-icon ml-2">more_vert</i>
                        </div>
                    </div>
                    <div class="d-block d-sm-flex justify-content-between align-items-center">
                        <h5 class="card-sub-title mb-2 mb-sm-0">&nbsp;</h5>

                    </div>
                    <div id="map"></div>
                    <div id="info"></div>
                </div>
            </div>


            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">


                <div class="mdc-card">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mb-0">Revenue by location</h4>
                        <div>
                            <i class="material-icons refresh-icon">refresh</i>
                            <i class="material-icons options-icon ml-2">more_vert</i>
                        </div>
                    </div>
                    <div class="d-block d-sm-flex justify-content-between align-items-center">
                        <h5 class="card-sub-title mb-2 mb-sm-0">Sales performance revenue based by
                            country</h5>
                        <div class="menu-button-container">
                            <button
                                class="mdc-button mdc-menu-button mdc-button--raised button-box-shadow tx-12 text-dark bg-white font-weight-light">
                                Last 7 days
                                <i class="material-icons">arrow_drop_down</i>
                            </button>
                            <div class="mdc-menu mdc-menu-surface" tabindex="-1">
                                <ul class="mdc-list" role="menu" aria-hidden="true" aria-orientation="vertical">
                                    <li class="mdc-list-item" role="menuitem">
                                        <h6 class="item-subject font-weight-normal">Back</h6>
                                    </li>
                                    <li class="mdc-list-item" role="menuitem">
                                        <h6 class="item-subject font-weight-normal">Forward</h6>
                                    </li>
                                    <li class="mdc-list-item" role="menuitem">
                                        <h6 class="item-subject font-weight-normal">Reload</h6>
                                    </li>
                                    <li class="mdc-list-divider"></li>
                                    <li class="mdc-list-item" role="menuitem">
                                        <h6 class="item-subject font-weight-normal">Save As..</h6>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="mdc-layout-grid__inner mt-2">
                        <div
                            class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6 mdc-layout-grid__cell--span-8-tablet">
                            <div class="table-responsive">
                                <table class="table dashboard-table">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <span class="flag-icon-container"><i
                                                        class="flag-icon flag-icon-us mr-2"></i></span>United
                                                States
                                            </td>
                                            <td>$1,671.10</td>
                                            <td class=" font-weight-medium"> 39% </td>
                                        </tr>
                                        <tr>
                                            <td> <span class="flag-icon-container"><i
                                                        class="flag-icon flag-icon-ph mr-2"></i></span>Philippines
                                            </td>
                                            <td>$1,064.75</td>
                                            <td class=" font-weight-medium"> 30% </td>
                                        </tr>
                                        <tr>
                                            <td> <span class="flag-icon-container"><i
                                                        class="flag-icon flag-icon-gb mr-2"></i></span>United
                                                Kingdom</td>
                                            <td>$1,055.98</td>
                                            <td class=" font-weight-medium"> 45% </td>
                                        </tr>
                                        <tr>
                                            <td> <span class="flag-icon-container"><i
                                                        class="flag-icon flag-icon-ca mr-2"></i></span>Canada
                                            </td>
                                            <td>$1,045.49</td>
                                            <td class=" font-weight-medium"> 80% </td>
                                        </tr>
                                        <tr>
                                            <td> <span class="flag-icon-container"><i
                                                        class="flag-icon flag-icon-fr mr-2"></i></span>France
                                            </td>
                                            <td>$2,050.93</td>
                                            <td class=" font-weight-medium"> 10% </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div
                            class="mdc-layout-grid__cell mdc-layout-grid__cell--span-6 mdc-layout-grid__cell--span-8-tablet">
                            <div id="revenue-map" class="revenue-world-map"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop mdc-layout-grid__cell--span-4-tablet">
                <div class="mdc-card bg-success text-white">
                    <div class="d-flex justify-content-between">
                        <h3 class="font-weight-normal">Impressions</h3>
                        <i class="material-icons options-icon text-white">more_vert</i>
                    </div>
                    <div class="mdc-layout-grid__inner align-items-center">
                        <div
                            class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-4-desktop mdc-layout-grid__cell--span-3-tablet mdc-layout-grid__cell--span-2-phone">
                            <div>
                                <h5 class="font-weight-normal mt-2">Customers 58.39k</h5>
                                <h2 class="font-weight-normal mt-3 mb-0">636,757K</h2>
                            </div>
                        </div>
                        <div
                            class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-8-desktop mdc-layout-grid__cell--span-5-tablet mdc-layout-grid__cell--span-2-phone">
                            <canvas id="impressions-chart" height="80"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop mdc-layout-grid__cell--span-4-tablet">
                <div class="mdc-card bg-info text-white">
                    <div class="d-flex justify-content-between">
                        <h3 class="font-weight-normal">Traffic</h3>
                        <i class="material-icons options-icon text-white">more_vert</i>
                    </div>
                    <div class="mdc-layout-grid__inner align-items-center">
                        <div
                            class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-4-desktop mdc-layout-grid__cell--span-3-tablet mdc-layout-grid__cell--span-2-phone">
                            <div>
                                <h5 class="font-weight-normal mt-2">Customers 58.39k</h5>
                                <h2 class="font-weight-normal mt-3 mb-0">636,757K</h2>
                            </div>
                        </div>
                        <div
                            class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-8-desktop mdc-layout-grid__cell--span-5-tablet mdc-layout-grid__cell--span-2-phone">
                            <canvas id="traffic-chart" height="80"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-8">
                <div class="mdc-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-2 mb-sm-0">Revenue by location</h4>
                        <div class="d-flex justtify-content-between align-items-center">
                            <p class="d-none d-sm-block text-muted tx-12 mb-0 mr-2">Goal reached</p>
                            <i class="material-icons options-icon">more_vert</i>
                        </div>
                    </div>
                    <div class="d-block d-sm-flex justify-content-between align-items-center">
                        <h6 class="card-sub-title mb-0">Sales performance revenue based by country</h6>
                        <div class="mdc-tab-wrapper revenue-tab mdc-tab--secondary">
                            <div class="mdc-tab-bar" role="tablist">
                                <div class="mdc-tab-scroller">
                                    <div class="mdc-tab-scroller__scroll-area">
                                        <div class="mdc-tab-scroller__scroll-content">
                                            <button class="mdc-tab mdc-tab--active" role="tab" aria-selected="true"
                                                tabindex="0">
                                                <span class="mdc-tab__content">
                                                    <span class="mdc-tab__text-label">1W</span>
                                                </span>
                                                <span class="mdc-tab-indicator mdc-tab-indicator--active">
                                                    <span
                                                        class="mdc-tab-indicator__content mdc-tab-indicator__content--underline"></span>
                                                </span>
                                                <span class="mdc-tab__ripple"></span>
                                            </button>
                                            <button class="mdc-tab mdc-tab" role="tab" aria-selected="true"
                                                tabindex="0">
                                                <span class="mdc-tab__content">
                                                    <span class="mdc-tab__text-label">1M</span>
                                                </span>
                                                <span class="mdc-tab-indicator mdc-tab-indicator">
                                                    <span
                                                        class="mdc-tab-indicator__content mdc-tab-indicator__content--underline"></span>
                                                </span>
                                                <span class="mdc-tab__ripple"></span>
                                            </button>
                                            <button class="mdc-tab mdc-tab" role="tab" aria-selected="true"
                                                tabindex="0">
                                                <span class="mdc-tab__content">
                                                    <span class="mdc-tab__text-label">3M</span>
                                                </span>
                                                <span class="mdc-tab-indicator mdc-tab-indicator">
                                                    <span
                                                        class="mdc-tab-indicator__content mdc-tab-indicator__content--underline"></span>
                                                </span>
                                                <span class="mdc-tab__ripple"></span>
                                            </button>
                                            <button class="mdc-tab mdc-tab" role="tab" aria-selected="true"
                                                tabindex="0">
                                                <span class="mdc-tab__content">
                                                    <span class="mdc-tab__text-label">1Y</span>
                                                </span>
                                                <span class="mdc-tab-indicator mdc-tab-indicator">
                                                    <span
                                                        class="mdc-tab-indicator__content mdc-tab-indicator__content--underline"></span>
                                                </span>
                                                <span class="mdc-tab__ripple"></span>
                                            </button>
                                            <button class="mdc-tab mdc-tab" role="tab" aria-selected="true"
                                                tabindex="0">
                                                <span class="mdc-tab__content">
                                                    <span class="mdc-tab__text-label">ALL</span>
                                                </span>
                                                <span class="mdc-tab-indicator mdc-tab-indicator">
                                                    <span
                                                        class="mdc-tab-indicator__content mdc-tab-indicator__content--underline"></span>
                                                </span>
                                                <span class="mdc-tab__ripple"></span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="content content--active">
                            </div>
                            <div class="content">
                            </div>
                            <div class="content">
                            </div>
                            <div class="content">
                            </div>
                            <div class="content">
                            </div>
                        </div>
                    </div>
                    <div class="chart-container mt-4">
                        <canvas id="revenue-chart" height="260"></canvas>
                    </div>
                </div>
            </div>
            <div
                class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-4 mdc-layout-grid__cell--span-8-tablet">
                <div class="mdc-card">
                    <div class="d-flex d-lg-block d-xl-flex justify-content-between">
                        <div>
                            <h4 class="card-title">Order Statistics</h4>
                            <h6 class="card-sub-title">Customers 58.39k</h6>
                        </div>
                        <div id="sales-legend" class="d-flex flex-wrap"></div>
                    </div>
                    <div class="chart-container mt-4">
                        <canvas id="chart-sales" height="260"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
{{--
<script>
    let map, marker, watchId;

    function initMap() {
        // Default center (will update with actual location)
        const defaultPos = {
            lat: 0,
            lng: 0
        };

        // Create the map centered on defaultPos
        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 15,
            center: defaultPos,
        });

        // Create a marker at defaultPos
        marker = new google.maps.Marker({
            position: defaultPos,
            map: map,
            title: "You are here",
            icon: {
                path: google.maps.SymbolPath.CIRCLE,
                scale: 8,
                fillColor: "#4285F4",
                fillOpacity: 1,
                strokeWeight: 2,
            },
        });

        // Watch for user's location
        if (navigator.geolocation) {
            watchId = navigator.geolocation.watchPosition(
                position => {
                    const pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };

                    // Update marker and map center
                    marker.setPosition(pos);
                    map.setCenter(pos);
                },
                error => {
                    console.error("Error getting location: ", error);
                    alert("Unable to retrieve location.");
                }, {
                    enableHighAccuracy: true,
                    maximumAge: 0,
                    timeout: 5000
                }
            );
        } else {
            alert("Geolocation is not supported by your browser.");
        }
    }
</script> --}}


{{-- <script>
    let map, directionsService, directionsRenderer;

    function initMap() {
        // Initialize the map
        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 7,
            center: {
                lat: 1.3521,
                lng: 103.8198
            } // Example: Singapore
        });

        directionsService = new google.maps.DirectionsService();
        directionsRenderer = new google.maps.DirectionsRenderer({
            map: map
        });

        // Set origin and destination (example)
        const origin = "Rampura, Dhaka, Bangladesh";
        const destination = "Mirpur 1, Dhaka, Bangladesh";

        calculateRoute(origin, destination);
    }

    function calculateRoute(origin, destination) {
        const request = {
            origin: origin,
            destination: destination,
            travelMode: google.maps.TravelMode.DRIVING
        };

        directionsService.route(request, (result, status) => {
            if (status === google.maps.DirectionsStatus.OK) {
                directionsRenderer.setDirections(result);

                // Extract duration and distance info
                const leg = result.routes[0].legs[0];
                const infoDiv = document.getElementById('info');
                infoDiv.innerHTML = `
            <strong>Route Info:</strong><br>
            From: ${leg.start_address}<br>
            To: ${leg.end_address}<br>
            Duration: ${leg.duration.text}<br>
            Distance: ${leg.distance.text}<br>
            Estimated Arrival: ${getArrivalTime(leg.duration.value)}
          `;
            } else {
                alert("Directions request failed due to " + status);
            }
        });
    }

    function getArrivalTime(durationSeconds) {
        const arrival = new Date(Date.now() + durationSeconds * 1000);
        return arrival.toLocaleTimeString([], {
            hour: '2-digit',
            minute: '2-digit'
        });
    }
</script> --}}
