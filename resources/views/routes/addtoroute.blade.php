@extends('layouts.app')

@section('style')
    <style>
        .list-body {
            height: 250px;
            overflow: scroll;
        }

        .list-radio {
            list-style: none;
            padding-left: 0px;

        }

        .list-radio li {
            padding: 5px;
        }

        .list-radio li:hover {
            background-color: #eeee;
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
                    <h3 class="mb-0">Register to Route</h3>
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
                <div class="col-sm-6">
                    <div class="card card-info card-outline mb-4">
                        <!--begin::Header-->
                        <div class="card-header">
                            <div class="card-title">Register</div>
                        </div>
                        <!--end::Header-->
                        <!--begin::Form-->

                        @csrf
                        <!--begin::Body-->
                        <div class="card-body">
                            <!--begin::Row-->
                            <div class="row g-3">
                                <!--begin::Col-->
                                <div class="col-md-6">
                                    <form action="" method="POST" id="bus-form">
                                        <label for="bus" class="form-label">Available Routes</label>
                                        <select class="form-select" id="bus" name="bus" required="">
                                            <option>Please select </option>
                                            @if (isset($routes) && count($routes) > 0)
                                                @foreach ($routes as $route)
                                                    <option value="{{ $route->route_id }}">{{ $route->route_name }}
                                                        [{{ $route->route_name }}]</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <div class="invalid-feedback">This field is required.</div>
                                    </form>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Row-->

                            <!--begin::Row-->
                            <div class="row g-3" style="margin-top: 20px">
                                <!--begin::Col-->
                                <div class="col-md-6">
                                    <!-- List -->
                                    <div class="card">
                                        <div class="card-header ui-sortable-handle" style="cursor: move;">
                                            <h3 class="card-title">
                                                <i class="ion ion-clipboard mr-1"></i>
                                                Available Students
                                            </h3>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body list-body">
                                            <ul class="todo-list ui-sortable list-radio" data-widget="todo-list"
                                                id="available-student">


                                            </ul>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                    <!-- end::List -->
                                </div>
                                <!--end::Col-->

                                <!--begin::Col-->
                                <div class="col-md-6">
                                    <!-- List -->
                                    <div class="card">
                                        <div class="card-header ui-sortable-handle" style="cursor: move;">
                                            <h3 class="card-title">
                                                <i class="ion ion-clipboard mr-1"></i>
                                                Students in Route
                                            </h3>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body list-body">
                                            <ul class="todo-list ui-sortable list-radio" data-widget="todo-list"
                                                id="student-on-bus">
                                            </ul>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                    <!-- end::List -->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Row-->



                        </div>
                        <!--end::Body-->
                        <!--begin::Footer-->
                        <div class="card-footer">
                            <button class="btn btn-primary" type="button" id="register-to-bus"><i
                                    class="bi bi-floppy-fill"></i>
                                Register to bus</button>
                        </div>
                        <!--end::Footer-->


                    </div>
                </div>

                <div class="col-sm-6">
                    <img src="images/school_bus_seat_top_view.jpg" style="width: auto;" />
                </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!--begin::JavaScript-->
    <script>
        function add_item_to_list(list_element, item) {

            let studentName = item.name; // Replace this dynamically if looping
            let studentId = item.id; // Optional: use as value or data-id

            let $item = $("<li></li>").append(
                $("<label></label>").append(
                    $("<input>", {
                        type: "checkbox",
                        class: "form-radio",
                        name: "available_student[]", // Use array if selecting multiple
                        value: studentId
                    }),
                    " " + studentName
                )
            );

            $(list_element).append($item);


        }

        function get_available_students() {

            const token = $('input[name="_token"]').val();

            $("#loading").css('visibility', 'visible');
            $.ajax({
                url: '/bus/get_available_students',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token
                },
                data: JSON.stringify({
                    bus_id: $("#bus").val()
                }),
                contentType: 'application/json',
                processData: false,
                contentType: false,
                success: function(data) {

                    if (Array.isArray(data) && data.length > 0) {

                        $.each(data, function(key, value) {
                            add_item_to_list("#available-student", value);
                        });

                    }
                    $("#loading").css('visibility', 'hidden');
                },
                // error: function(xhr) {
                //     json = JSON.parse(xhr.responseText);
                //     $("#loading").css('visibility', 'hidden');
                //     Swal.fire({
                //         icon: 'info',
                //         title: 'Already Registered',
                //         text: json.message,
                //     });
                // }
            });
        }

        function get_students_on_bus() {

            const token = $('input[name="_token"]').val();

            $("#loading").css('visibility', 'visible');
            $.ajax({
                url: '/route/get_students_on_route',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token
                },
                data: JSON.stringify({
                    route_id: $("#bus").val()
                }),
                contentType: 'application/json',
                processData: false,
                contentType: false,
                success: function(data) {

                    if (Array.isArray(data) && data.length > 0) {

                        $.each(data, function(key, value) {
                            add_item_to_list("#student-on-bus", value);
                        });

                    }

                    $("#loading").css('visibility', 'hidden');
                },
                // error: function(xhr) {
                //     json = JSON.parse(xhr.responseText);
                //     $("#loading").css('visibility', 'hidden');
                //     Swal.fire({
                //         icon: 'info',
                //         title: 'Already Registered',
                //         text: json.message,
                //     });
                // }
            });
        }

        $(document).ready(function() {

            $("#bus").change(function() {

                $("#available-student").empty();
                $("#student-on-bus").empty();

                get_available_students();
                get_students_on_bus();
            });


            $("#register-to-bus").click(function() {

                let selectedStudents = [];
                const token = $('input[name="_token"]').val();


                $("#available-student input[name='available_student[]']:checked").each(function() {
                    selectedStudents.push($(this).val());
                });

                console.log(JSON.stringify(selectedStudents)); // Convert to JSON string if needed


                $("#loading").css('visibility', 'visible');
                
                $.ajax({
                    url: '/bus/register_student_on_bus',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': token
                    },
                    data: JSON.stringify({
                        bus_id: $("#bus").val(),
                        students: selectedStudents
                    }),
                    contentType: 'application/json',
                    processData: false,
                    contentType: false,
                    success: function(data) {

                        $("#student-on-bus").empty();
                        get_students_on_bus();

                        $("#loading").css('visibility', 'hidden');

                    },
                    // error: function(xhr) {
                    //     json = JSON.parse(xhr.responseText);
                    //     $("#loading").css('visibility', 'hidden');
                    //     Swal.fire({
                    //         icon: 'info',
                    //         title: 'Already Registered',
                    //         text: json.message,
                    //     });
                    // }
                });


            });


        });
    </script>
@endsection
