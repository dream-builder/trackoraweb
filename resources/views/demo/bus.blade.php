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
                    "lat": 23.76018,
                    "lng": 90.42227
                },
                {
                    "lat": 23.7605,
                    "lng": 90.42213
                },
                {
                    "lat": 23.76052,
                    "lng": 90.42212
                },
                {
                    "lat": 23.76051,
                    "lng": 90.4219
                },
                {
                    "lat": 23.76045,
                    "lng": 90.42166
                },
                {
                    "lat": 23.76075,
                    "lng": 90.4215
                },
                {
                    "lat": 23.76066,
                    "lng": 90.42107
                },
                {
                    "lat": 23.76045,
                    "lng": 90.42014
                },
                {
                    "lat": 23.76033,
                    "lng": 90.41933
                },
                {
                    "lat": 23.76033,
                    "lng": 90.41921
                },
                {
                    "lat": 23.76037,
                    "lng": 90.41893
                },
                {
                    "lat": 23.75945,
                    "lng": 90.4184
                },
                {
                    "lat": 23.75929,
                    "lng": 90.41831
                },
                {
                    "lat": 23.75934,
                    "lng": 90.4182
                },
                {
                    "lat": 23.76011,
                    "lng": 90.4186
                },
                {
                    "lat": 23.76079,
                    "lng": 90.419
                },
                {
                    "lat": 23.76264,
                    "lng": 90.42007
                },
                {
                    "lat": 23.76386,
                    "lng": 90.42076
                },
                {
                    "lat": 23.7655,
                    "lng": 90.4217
                },
                {
                    "lat": 23.76615,
                    "lng": 90.42205
                },
                {
                    "lat": 23.76621,
                    "lng": 90.422
                },
                {
                    "lat": 23.76644,
                    "lng": 90.42188
                },
                {
                    "lat": 23.76649,
                    "lng": 90.42187
                },
                {
                    "lat": 23.76658,
                    "lng": 90.42187
                },
                {
                    "lat": 23.76669,
                    "lng": 90.42192
                },
                {
                    "lat": 23.76692,
                    "lng": 90.42207
                },
                {
                    "lat": 23.76716,
                    "lng": 90.42224
                },
                {
                    "lat": 23.76746,
                    "lng": 90.4224
                },
                {
                    "lat": 23.76762,
                    "lng": 90.42247
                },
                {
                    "lat": 23.76769,
                    "lng": 90.42246
                },
                {
                    "lat": 23.76774,
                    "lng": 90.42243
                },
                {
                    "lat": 23.76782,
                    "lng": 90.42235
                },
                {
                    "lat": 23.76788,
                    "lng": 90.42226
                },
                {
                    "lat": 23.76794,
                    "lng": 90.4221
                },
                {
                    "lat": 23.76806,
                    "lng": 90.42202
                },
                {
                    "lat": 23.76805,
                    "lng": 90.42196
                },
                {
                    "lat": 23.76809,
                    "lng": 90.42172
                },
                {
                    "lat": 23.76812,
                    "lng": 90.42153
                },
                {
                    "lat": 23.76815,
                    "lng": 90.42015
                },
                {
                    "lat": 23.76813,
                    "lng": 90.41991
                },
                {
                    "lat": 23.76814,
                    "lng": 90.41967
                },
                {
                    "lat": 23.76823,
                    "lng": 90.41909
                },
                {
                    "lat": 23.76832,
                    "lng": 90.41854
                },
                {
                    "lat": 23.76828,
                    "lng": 90.41852
                },
                {
                    "lat": 23.76844,
                    "lng": 90.41768
                },
                {
                    "lat": 23.76852,
                    "lng": 90.4171
                },
                {
                    "lat": 23.76854,
                    "lng": 90.41693
                },
                {
                    "lat": 23.76854,
                    "lng": 90.41647
                },
                {
                    "lat": 23.76847,
                    "lng": 90.4161
                },
                {
                    "lat": 23.7684,
                    "lng": 90.41589
                },
                {
                    "lat": 23.76817,
                    "lng": 90.41545
                },
                {
                    "lat": 23.76765,
                    "lng": 90.41473
                },
                {
                    "lat": 23.76723,
                    "lng": 90.41428
                },
                {
                    "lat": 23.76692,
                    "lng": 90.41392
                },
                {
                    "lat": 23.76673,
                    "lng": 90.41373
                },
                {
                    "lat": 23.76553,
                    "lng": 90.41255
                },
                {
                    "lat": 23.76539,
                    "lng": 90.41244
                },
                {
                    "lat": 23.7652,
                    "lng": 90.41231
                },
                {
                    "lat": 23.76485,
                    "lng": 90.41218
                },
                {
                    "lat": 23.76415,
                    "lng": 90.41189
                },
                {
                    "lat": 23.76299,
                    "lng": 90.41148
                },
                {
                    "lat": 23.76271,
                    "lng": 90.41136
                },
                {
                    "lat": 23.76205,
                    "lng": 90.41104
                },
                {
                    "lat": 23.76177,
                    "lng": 90.41088
                },
                {
                    "lat": 23.76166,
                    "lng": 90.41083
                },
                {
                    "lat": 23.76143,
                    "lng": 90.41075
                },
                {
                    "lat": 23.76089,
                    "lng": 90.41062
                },
                {
                    "lat": 23.76062,
                    "lng": 90.41057
                },
                {
                    "lat": 23.76056,
                    "lng": 90.41049
                },
                {
                    "lat": 23.76047,
                    "lng": 90.41031
                },
                {
                    "lat": 23.76044,
                    "lng": 90.41014
                },
                {
                    "lat": 23.76044,
                    "lng": 90.41004
                },
                {
                    "lat": 23.7605,
                    "lng": 90.40991
                },
                {
                    "lat": 23.76095,
                    "lng": 90.40904
                },
                {
                    "lat": 23.76139,
                    "lng": 90.40819
                },
                {
                    "lat": 23.76157,
                    "lng": 90.40787
                },
                {
                    "lat": 23.7614,
                    "lng": 90.40772
                },
                {
                    "lat": 23.76126,
                    "lng": 90.40756
                },
                {
                    "lat": 23.76141,
                    "lng": 90.40743
                },
                {
                    "lat": 23.76158,
                    "lng": 90.40716
                },
                {
                    "lat": 23.76166,
                    "lng": 90.40704
                },
                {
                    "lat": 23.76189,
                    "lng": 90.40685
                },
                {
                    "lat": 23.76216,
                    "lng": 90.40659
                },
                {
                    "lat": 23.76201,
                    "lng": 90.40632
                },
                {
                    "lat": 23.76184,
                    "lng": 90.40592
                },
                {
                    "lat": 23.76178,
                    "lng": 90.40567
                },
                {
                    "lat": 23.76171,
                    "lng": 90.40533
                },
                {
                    "lat": 23.76173,
                    "lng": 90.40449
                },
                {
                    "lat": 23.76181,
                    "lng": 90.40391
                },
                {
                    "lat": 23.76197,
                    "lng": 90.40294
                },
                {
                    "lat": 23.76205,
                    "lng": 90.40244
                },
                {
                    "lat": 23.76214,
                    "lng": 90.40185
                },
                {
                    "lat": 23.76341,
                    "lng": 90.4021
                },
                {
                    "lat": 23.76353,
                    "lng": 90.40124
                },
                {
                    "lat": 23.76355,
                    "lng": 90.40105
                },
                {
                    "lat": 23.76366,
                    "lng": 90.40022
                },
                {
                    "lat": 23.76362,
                    "lng": 90.40011
                },
                {
                    "lat": 23.76363,
                    "lng": 90.4
                },
                {
                    "lat": 23.7637,
                    "lng": 90.39949
                },
                {
                    "lat": 23.76375,
                    "lng": 90.3991
                },
                {
                    "lat": 23.76389,
                    "lng": 90.39813
                },
                {
                    "lat": 23.76416,
                    "lng": 90.39635
                },
                {
                    "lat": 23.76418,
                    "lng": 90.39586
                },
                {
                    "lat": 23.76415,
                    "lng": 90.39551
                },
                {
                    "lat": 23.76403,
                    "lng": 90.3946
                },
                {
                    "lat": 23.76402,
                    "lng": 90.39419
                },
                {
                    "lat": 23.76403,
                    "lng": 90.39399
                },
                {
                    "lat": 23.76404,
                    "lng": 90.39377
                },
                {
                    "lat": 23.76411,
                    "lng": 90.39338
                },
                {
                    "lat": 23.76428,
                    "lng": 90.39263
                },
                {
                    "lat": 23.7644,
                    "lng": 90.39206
                },
                {
                    "lat": 23.76447,
                    "lng": 90.39145
                },
                {
                    "lat": 23.7645,
                    "lng": 90.39102
                },
                {
                    "lat": 23.76449,
                    "lng": 90.39066
                },
                {
                    "lat": 23.76446,
                    "lng": 90.39019
                },
                {
                    "lat": 23.76435,
                    "lng": 90.3894
                },
                {
                    "lat": 23.76428,
                    "lng": 90.3889
                },
                {
                    "lat": 23.76428,
                    "lng": 90.38878
                },
                {
                    "lat": 23.76438,
                    "lng": 90.38799
                },
                {
                    "lat": 23.76464,
                    "lng": 90.3865
                },
                {
                    "lat": 23.7648,
                    "lng": 90.3855
                },
                {
                    "lat": 23.76466,
                    "lng": 90.38548
                },
                {
                    "lat": 23.76457,
                    "lng": 90.38546
                }
            ];
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
