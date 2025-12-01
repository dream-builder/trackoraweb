@extends('layouts.app')
@section('content')
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Routes</h3>
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
                            <div class="card-title">List</div>
                        </div>
                        <!--end::Header-->

                        <div class="card-body p-0">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Route Name/Number</th>
                                        <th>Source</th>
                                        <th>Destination</th>
                                        <th>Assigned Driver</th>
                                        <th>Assigned Passengers</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>



                                    @foreach ($routes as $route)
                                        <tr data-route_id="{{ $route->id }}" class="route-detail">
                                            <td>{{ $route->route_name }}</td>
                                            <td>{{ $route->route_source }}</td>
                                            <td>{{ $route->route_destination }}</td>
                                            <td style="text-align: center">{{ $route->assigned_drivers }}</td>
                                            <td style="text-align: center">{{ $route->assigned_passengers }}</td>
                                            <td>
                                                <a href="{{ route('route.view') }}?route_id={{ $route->id }}"
                                                    class="text-info" title="Detail"><i class="bi bi-eye-fill"></i></a>
                                                <a href="#" class="text-primary" title="Edit"><i
                                                        class="bi bi-pencil-square"></i></a>
                                                <a href="#" class="text-danger" title="Remove"><i
                                                        class="bi bi-trash-fill"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach




                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>


            </div>
        </div>
    </div>



    <div class="modal fade" id="route-detail-modal" tabindex="-1">
        <div class="modal-dialog modal-lg"> <!-- modal-lg increases width -->
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title">Route Detail</h4>

                    <!-- Correct Bootstrap 4 close button -->
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>

                <div class="modal-body" id="route-detail-modal-body">

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $(".route-detail").click(function() {

                $("#loading").css('visibility', 'visible');

                var route_id = $(this).data('route_id');

                $.ajax({

                    url: '/routes/view?route_id=' + route_id,
                    method: 'GET',
                    contentType: 'application/json',
                    //data: JSON.stringify(data),
                    success: function(response) {

                        $("#route-detail-modal-body").html(response);
                        $("#route-detail-modal").modal("show");
                        $("#loading").css('visibility', 'hidden');

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
