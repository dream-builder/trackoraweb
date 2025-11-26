@extends('layouts.app')
@section('content')
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Drivers</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('driver.addnew') }}">Add New</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="{{ route('driver.show') }}">Show All</a>
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
                                        <th>Name</th>
                                        <th>Age (Years)</th>
                                        <th>Gender</th>
                                        <th>Driving License No.</th>
                                        <th>Phone</th>
                                        <th>Assigned Bus</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    {{-- {{ var_dump($students) }} --}}

                                    @if (isset($drivers) && count($drivers) > 0)
                                        @foreach ($drivers as $driver)
                                            <tr class="align-middle">
                                                <td>{{ $driver->id }}</td>
                                                <td>{{ $driver->name }}</td>
                                                <td>{{ $driver->age }}</td>
                                                <td>{{ Str::ucfirst($driver->gender) }}</td>
                                                <td> {{ $driver->license_no }}</td>
                                                <td>{{ $driver->phone }}</td>
                                                <td>{{ $driver->bus_name }}</td>

                                                <td>
                                                    <button type="button" class="btn btn-default"
                                                        data-driver_id="{{ $driver->id }}"
                                                        data-bus_id="{{ $driver->bus_id }}"
                                                        data-driver_name="{{ $driver->name }}">
                                                        <i class="bi bi-send-plus-fill"></i>
                                                    </button>

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
        <div id="assing-modal">
            <form class="needs-validation" novalidate="" action="/drivers/assignvehicle" method="POST"
                id="driver-assignbus">
                <div class="modal fade" id="modal-default">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Assign Vehicle</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">


                                <input type="text" id="driver-id" name="driver_id">
                                <div class="form-group">
                                    <label class="form-label">Driver</label>
                                    <input type="text" class="form-control" id="driver-name" disabled="">
                                </div>



                                <div class="form-group">
                                    <label class="form-label">Assigned vehicle</label>
                                    <select id="assigned_bus_id" class="form-control" name="bus_id">
                                        <option value="0">Select</option>
                                        @if (@isset($buses) && count($buses) > 0)
                                            @foreach ($buses as $bus)
                                                <option value="{{ $bus->id }}">{{ $bus->bus_name }}</option>
                                            @endforeach
                                        @endif

                                    </select>

                                </div>

                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default modal-close"
                                    data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" id="modal-save">Save</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->

            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <!--begin::JavaScript-->
    <script>
        $(document).ready(function() {
            $(".btn-default").click(function() {

                $("#driver-name").val($(this).data("driver_name"));
                $("#driver-id").val($(this).data("driver_id"));
                $("#modal-default").modal('show');

            });

            $(".modal-close").click(function() {
                $("#modal-default").modal('hide');
            });

            $("#modal-save").click(function() {

                //$("#driver-assignbus").submit();

                //$("#modal-default").modal('hide');
            });
        });


        function validateBootstrapForm(formId) {
            const form = document.getElementById(formId);
            if (!form) return false;

            if (form.checkValidity()) {
                form.classList.remove('was-validated');
                return true;
            } else {
                form.classList.add('was-validated');
                return false;
            }
        }

        document.getElementById('driver-assignbus').addEventListener('submit', function(e) {

            e.preventDefault(); // prevent actual submit
            const form = this;
            const formData = new FormData(form);
            const token = $('input[name="_token"]').val();
            const isValid = validateBootstrapForm('driver-assignbus');

            if (isValid) {
                $("#loading").css('visibility', 'visible');
                $.ajax({
                    url: '/drivers/assignvehicle',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': token
                    },
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        const messageBox = $('#responseMessage');

                        if (data.status === 'success') {


                            $("#loading").css('visibility', 'hidden');

                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: data.message,
                                timer: 2500,
                                showConfirmButton: false,
                            });

                            form.reset();
                        } else {
                            $("#loading").css('visibility', 'hidden');
                            alert(data.message);
                        }
                    },
                    error: function(xhr) {
                        json = JSON.parse(xhr.responseText);
                        $("#loading").css('visibility', 'hidden');
                        Swal.fire({
                            icon: 'info',
                            title: 'Already Registered',
                            text: json.message,
                        });
                    }
                });
            } else {
                console.log('Form is not valid');
            }
        });
    </script>
@endsection
