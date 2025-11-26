@extends('layouts.app')
@section('content')
    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">


            <!--begin::Row Monthl recape-->
            <div class="row" style="margin-top: 20px;">
                <div class="col-md-8">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-title">Travelling...</h5>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <img src="images/travel_demo.jpg" style="width: 100%">

                        </div>
                        <!-- ./card-body -->

                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->

                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-title">Student on Bus</h5>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <table class="table table-hover">
                                <tbody>

                                    @if (isset($students_on_bus) && count($students_on_bus))
                                        @foreach ($students_on_bus as $student)
                                            <tr>
                                                <td style="width: 50px"><img src="images/student_f.png" style="width: 40px">
                                                </td>
                                                <td>
                                                    <div><strong>{{ $student->full_name }}</strong></div>

                                                    <small>
                                                        <div><i class="bi bi-telephone-fill"></i>
                                                            {{ $student->phone_number }}</div>
                                                    </small>

                                                </td>
                                                <td>
                                                    <i class="bi bi-chat-right-text"></i>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                <tbody>
                            </table>

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
