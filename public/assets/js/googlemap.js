

        //Waypoint Manage

        const waypoints = [];

        function addLocation() {
            const input = document.getElementById("locationInput");
            const location = input.value.trim();

            if (location) {
                const waypoint = {
                    location: location,
                    stopover: true
                };
                waypoints.push(waypoint);
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
                types: ['geocode'], // or use ['geocode'] for full addresses
                componentRestrictions: {
                    country: 'bd'
                } // restrict to India or remove for global
            };

            new google.maps.places.Autocomplete(sourceInput, options);
            new google.maps.places.Autocomplete(destInput, options);
            new google.maps.places.Autocomplete(locationInput, options);
            document.getElementById("routeForm").addEventListener("submit", function(e) {
                e.preventDefault();
                calculateRoute();
            });
        }

        function calculateRoute() {
            const source = document.getElementById("source").value;
            const destination = document.getElementById("destination").value;

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
    </script>

    <!-- Include Google Maps JS with Places Library -->

    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key={{ env('MAP_KEY') }}&libraries=places&callback=initMap"></script>

    <script>
        $(document).ready(function() {
            $("#save-route").click(function() {

                data = {
                    "_token": "{{ csrf_token() }}",
                    'old_route_name': $("#load-route").val(),
                    'new_route_name': $("#routename").val(),
                    'source': $("#source").val(),
                    'destination': $("#destination").val(),
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
