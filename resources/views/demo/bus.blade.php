@extends('layouts.app')
@section('content')
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Bus Demo</h3>
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
                        <!--begin::Header-->
                        <div class="card-header">
                            <div class="card-title">
                                <div class="com-sm-4">
                                    Update bus postion

                                </div>
                            </div>
                        </div>
                        <!--end::Header-->

                        <div class="card-body ">
                            <p> Click start button to update the bus locaiton in every 2 seconds</p>

                            <p>
                                <button class="btn btn-primary" id="start-demo">Start Demo</button>
                            </p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        let index = 0;

        function updatebus() {
            let pos = [{
                'lat': 45.46329,
                'lng': -73.42729
            } {
                'lat': 45.46273,
                'lng': -73.42648000000001
            } {
                'lat': 45.46273,
                'lng': -73.42648000000001
            } {
                'lat': 45.46229,
                'lng': -73.42704
            } {
                'lat': 45.46229,
                'lng': -73.42704
            } {
                'lat': 45.462390000000006,
                'lng': -73.42721
            } {
                'lat': 45.462390000000006,
                'lng': -73.42721
            } {
                'lat': 45.46197,
                'lng': -73.42782000000001
            } {
                'lat': 45.461920000000006,
                'lng': -73.42789
            } {
                'lat': 45.46155,
                'lng': -73.42845000000001
            } {
                'lat': 45.46132,
                'lng': -73.42875000000001
            } {
                'lat': 45.46106,
                'lng': -73.42911000000001
            } {
                'lat': 45.46067,
                'lng': -73.42969000000001
            } {
                'lat': 45.46058,
                'lng': -73.42983000000001
            } {
                'lat': 45.460330000000006,
                'lng': -73.43033000000001
            } {
                'lat': 45.46009,
                'lng': -73.43083
            } {
                'lat': 45.45989,
                'lng': -73.43115
            } {
                'lat': 45.459140000000005,
                'lng': -73.43223
            } {
                'lat': 45.459070000000004,
                'lng': -73.43233000000001
            } {
                'lat': 45.45902,
                'lng': -73.43241
            } {
                'lat': 45.45890000000001,
                'lng': -73.43258
            } {
                'lat': 45.45862,
                'lng': -73.43298
            } {
                'lat': 45.458130000000004,
                'lng': -73.43365
            } {
                'lat': 45.45765,
                'lng': -73.43437
            } {
                'lat': 45.45727,
                'lng': -73.43492
            } {
                'lat': 45.45718,
                'lng': -73.43505
            } {
                'lat': 45.45712,
                'lng': -73.43514
            } {
                'lat': 45.45694,
                'lng': -73.43537
            } {
                'lat': 45.456880000000005,
                'lng': -73.43546
            } {
                'lat': 45.4564,
                'lng': -73.43615000000001
            } {
                'lat': 45.45638,
                'lng': -73.43618000000001
            } {
                'lat': 45.456300000000006,
                'lng': -73.43629
            } {
                'lat': 45.45622,
                'lng': -73.43641000000001
            } {
                'lat': 45.45618,
                'lng': -73.43648
            } {
                'lat': 45.456160000000004,
                'lng': -73.43654000000001
            } {
                'lat': 45.456140000000005,
                'lng': -73.43659000000001
            } {
                'lat': 45.45611,
                'lng': -73.43667
            } {
                'lat': 45.45609,
                'lng': -73.43677000000001
            } {
                'lat': 45.456070000000004,
                'lng': -73.43685
            } {
                'lat': 45.456,
                'lng': -73.43719
            } {
                'lat': 45.456,
                'lng': -73.43719
            } {
                'lat': 45.455960000000005,
                'lng': -73.43719
            } {
                'lat': 45.455920000000006,
                'lng': -73.43719
            } {
                'lat': 45.45588,
                'lng': -73.43719
            } {
                'lat': 45.45584,
                'lng': -73.43719
            } {
                'lat': 45.45579,
                'lng': -73.4372
            } {
                'lat': 45.455740000000006,
                'lng': -73.43721000000001
            } {
                'lat': 45.455690000000004,
                'lng': -73.43723
            } {
                'lat': 45.455650000000006,
                'lng': -73.43725
            } {
                'lat': 45.455600000000004,
                'lng': -73.43727000000001
            } {
                'lat': 45.455560000000006,
                'lng': -73.43730000000001
            } {
                'lat': 45.45552000000001,
                'lng': -73.43734
            } {
                'lat': 45.45544,
                'lng': -73.43743
            } {
                'lat': 45.455180000000006,
                'lng': -73.43776000000001
            } {
                'lat': 45.45468,
                'lng': -73.43849
            } {
                'lat': 45.454190000000004,
                'lng': -73.43921
            } {
                'lat': 45.454130000000006,
                'lng': -73.43931
            } {
                'lat': 45.45375000000001,
                'lng': -73.43986000000001
            } {
                'lat': 45.45369,
                'lng': -73.43995000000001
            } {
                'lat': 45.45369,
                'lng': -73.43995000000001
            } {
                'lat': 45.45362,
                'lng': -73.44004000000001
            } {
                'lat': 45.45347,
                'lng': -73.43984
            } {
                'lat': 45.45338,
                'lng': -73.4397
            } {
                'lat': 45.45327,
                'lng': -73.43955000000001
            } {
                'lat': 45.452510000000004,
                'lng': -73.43851000000001
            } {
                'lat': 45.452510000000004,
                'lng': -73.43851000000001
            } {
                'lat': 45.45257,
                'lng': -73.43842000000001
            } {
                'lat': 45.452630000000006,
                'lng': -73.43834000000001
            } {
                'lat': 45.45268,
                'lng': -73.43827
            } {
                'lat': 45.453570000000006,
                'lng': -73.43703000000001
            } {
                'lat': 45.45391,
                'lng': -73.43646000000001
            } {
                'lat': 45.454280000000004,
                'lng': -73.43589
            } {
                'lat': 45.454370000000004,
                'lng': -73.43575000000001
            } {
                'lat': 45.454910000000005,
                'lng': -73.43489000000001
            } {
                'lat': 45.45499,
                'lng': -73.43476000000001
            } {
                'lat': 45.45515,
                'lng': -73.43452
            } {
                'lat': 45.455220000000004,
                'lng': -73.43439000000001
            } {
                'lat': 45.45534000000001,
                'lng': -73.43415
            } {
                'lat': 45.455450000000006,
                'lng': -73.43387000000001
            } {
                'lat': 45.455540000000006,
                'lng': -73.43359000000001
            } {
                'lat': 45.45559,
                'lng': -73.43338
            } {
                'lat': 45.45561000000001,
                'lng': -73.4333
            } {
                'lat': 45.455690000000004,
                'lng': -73.43289
            } {
                'lat': 45.45572000000001,
                'lng': -73.43254
            } {
                'lat': 45.45572000000001,
                'lng': -73.43238000000001
            } {
                'lat': 45.45572000000001,
                'lng': -73.43227
            } {
                'lat': 45.45573,
                'lng': -73.43204
            } {
                'lat': 45.45573,
                'lng': -73.43195
            } {
                'lat': 45.455740000000006,
                'lng': -73.43180000000001
            } {
                'lat': 45.45575,
                'lng': -73.43167000000001
            } {
                'lat': 45.455760000000005,
                'lng': -73.43159
            } {
                'lat': 45.45584,
                'lng': -73.4312
            } {
                'lat': 45.45590000000001,
                'lng': -73.43101
            } {
                'lat': 45.45591,
                'lng': -73.43099000000001
            } {
                'lat': 45.45609,
                'lng': -73.43049
            } {
                'lat': 45.45609,
                'lng': -73.43047
            } {
                'lat': 45.456100000000006,
                'lng': -73.43044
            } {
                'lat': 45.45611,
                'lng': -73.43042000000001
            } {
                'lat': 45.456120000000006,
                'lng': -73.4304
            } {
                'lat': 45.45613,
                'lng': -73.4304
            } {
                'lat': 45.456140000000005,
                'lng': -73.4304
            } {
                'lat': 45.45618,
                'lng': -73.43029
            }];
            let data = {
                "_token": "{{ csrf_token() }}",
                "user_id": 1,
                "id": "bus1",
                "lat": pos[index].lat,
                "lng": pos[index].lng,
                "latitude": pos[index].lat,
                "longitude": pos[index].lng,
                "name": '',
                "date": ''
            };

            let param = "data=" + JSON.stringify(data);

            index++; //increase

            // $("#loading").css('visibility', 'visible');
            $.ajax({

                //url: '/api/setlivelocation',

                url: '/api/saveuserlocation',
                method: 'GET',
                contentType: 'application/json',
                data: param,
                success: function(response) {

                },
                error: function(xhr) {

                }
            });
        }



        $(document).ready(function() {
            let intervalId = null;

            $("#start-demo").click(function() {

                if (intervalId === null) {
                    // Start the interval
                    intervalId = setInterval(updatebus, 2000);
                    $("#start-demo").html('Updating Bus position...');
                } else {
                    // Stop the interval
                    clearInterval(intervalId);
                    intervalId = null;
                    $("#start-demo").html('Start');
                }

            });
        });
    </script>
@endsection
