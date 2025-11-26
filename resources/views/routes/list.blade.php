@extends('layouts.app')
@section('content')
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Students</h3>
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
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Guardian</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    {{-- {{ var_dump($students) }} --}}

                                    @if (sizeof($students) > 0)
                                        @foreach ($students as $student)
                                            <tr class="align-middle">
                                                <td>{{ $student->id }}</td>
                                                <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                                                <td> {{ $student->email }}</td>
                                                <td>{{ $student->phone_number }}</td>
                                                <td>Gurdian</td>
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
