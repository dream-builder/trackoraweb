@extends('layouts.app')
@section('content')
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">School Buses</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('bus.addnew') }}">Add New</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="{{ route('bus.show') }}">Show All</a>
                        </li>
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
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Reg. Number</th>
                                        <th>Bus Name</th>
                                        <th>Route</th>
                                        <th>Owner</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    {{-- {{ var_dump($students) }} --}}

                                    @if (sizeof($buses) > 0)
                                        @foreach ($buses as $bus)
                                            <tr class="align-middle">
                                                <td>{{ $bus->id }}</td>
                                                <td>{{ $bus->bus_registration_number }}</td>
                                                <td> {{ $bus->bus_name }}</td>
                                                <td>{{ $bus->route_name }}</td>
                                                <td>{{ $bus->bus_owner }}</td>
                                                <td>
                                                    <a href="#" class="text-info" title="Detail"><i
                                                            class="bi bi-eye-fill"></i></a>
                                                    <a href="#" class="text-primary" title="Edit"><i
                                                            class="bi bi-pencil-square"></i></a>
                                                    <a href="#" class="text-danger" title="Remove"><i
                                                            class="bi bi-trash-fill"></i></a>

                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif



                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection
