@extends('layouts.app')
@section('content')
    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row" style="margin-top: 20px">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon text-bg-primary shadow-sm">
                            <i class="bi bi-sign-intersection-y-fill"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Assigned Routes</span>
                            <span class="info-box-number">10

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
                            <span class="info-box-text">Assigned Buses</span>
                            <span class="info-box-number">{{ $assigned_bus[0]->bus_count }}</span>
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
                            <span class="info-box-text">Assigned Students</span>
                            <span class="info-box-number">90</span>
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
                            <span class="info-box-text">Travel Today</span>
                            <span class="info-box-number">2</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->


            <!--begin::Row Monthl recape-->
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-title">Assigned Buses</h5>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <!--begin::Row-->
                            <div class="row">
                                <div class="col-md-8">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Bus Name</th>
                                                <th>Registration Numner</th>
                                                <th>Route</th>
                                                <th>Total Student</th>
                                                <th>...</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                        <tbody>

                                            @if (@isset($buses) && count($buses) > 0)
                                                @foreach ($buses as $bus)
                                                    <tr>
                                                        <td>{{ $bus->bus_name }}</td>
                                                        <td>{{ $bus->bus_registration_number }}</td>
                                                        <td>{{ $bus->route_name }}</td>
                                                        <td>{{ $bus->student_count }}</td>
                                                        <td><a href="{{ route('driver.starttravel') }}?bus_id={{ $bus->bus_id }}&driver_id={{ $bus->driver_id }}&route_id={{ $bus->bus_route }}"
                                                                class="btn btn-sm btn-primary">Start Travel</a>
                                                        </td>

                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                        </tbody>

                                    </table>
                                </div>

                            </div>
                            <!--end::Row-->
                        </div>
                        <!-- ./card-body -->
                        <div class="card-footer">
                            <!--begin::Row-->
                            <div class="row">
                                <div class="col-md-3 col-6">

                                </div>
                            </div>
                            <!--end::Row-->
                        </div>
                        <!-- /.card-footer -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!--end::Row-->




        </div>
        <!--end::Container-->
    </div>
@endsection
