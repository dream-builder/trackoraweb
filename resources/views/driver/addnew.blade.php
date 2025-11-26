@extends('layouts.app')
@section('content')
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Add New</h3>
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
                <div class="col-sm-6">
                    <div class="card card-info card-outline mb-4">
                        <!--begin::Header-->
                        <div class="card-header">
                            <div class="card-title">Add New</div>
                        </div>
                        <!--end::Header-->
                        <!--begin::Form-->
                        <form class="needs-validation" novalidate="" action="/drivers/save" method="POST" id="driver-reg">
                            @csrf
                            <!--begin::Body-->
                            <div class="card-body">
                                <!--begin::Row-->
                                <div class="row g-3">
                                    <!--begin::Col-->
                                    <div class="col-md-6">
                                        <label for="validationCustom01" class="form-label">Driving License Number</label>
                                        <input type="text" class="form-control" id="validationCustom01" name="license_no"
                                            required="">
                                        <div class="invalid-feedback">This field is required.</div>
                                        <div class="valid-feedback">Looks good!</div>
                                    </div>
                                    <!--end::Col-->

                                    <!--begin::Col-->
                                    <div class="col-md-6">

                                        <label for="licesne_class" class="form-label">License Class</label>

                                        <select class="form-select" id="licesne_class" name="licesne_class">
                                            <option>Choose...</option>
                                            <option value="1">Class 1 – Semi-trailer trucks</option>
                                            <option value="2">Class 2 – Buses (including school buses)</option>
                                            <option value="3">Class 3 – Large trucks</option>
                                            <option value="4">Class 4 – Taxis, limousines, ambulances</option>
                                            <option value="5">Class 5 – Standard cars and light trucks</option>
                                            <option value="6">Class 6 – Motorcycles</option>
                                            <option value="7">Class 7 – Learner’s permit</option>
                                            <option value="8">Class 8 – Motorcycle learner’s permit</option>
                                        </select>

                                        <div class="invalid-feedback">This field is required.</div>
                                    </div>
                                    <!--end::Col-->


                                    <!--begin::Col-->
                                    <div class="col-md-6">
                                        <label for="driver_name" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="driver_name" name="driver_name"
                                            required="">
                                        <div class="invalid-feedback">This field is required.</div>
                                        <div class="valid-feedback">Looks good!</div>
                                    </div>
                                    <!--end::Col-->

                                    <!--begin::Col-->
                                    <div class="col-md-6">

                                        <label for="gender" class="form-label">Gender</label>

                                        <select class="form-select" id="gender" name="gender">
                                            <option>Choose...</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                            <option value="other">Other</option>
                                        </select>

                                        <div class="invalid-feedback">This field is required.</div>
                                    </div>
                                    <!--end::Col-->


                                    <!--begin::Col-->
                                    <div class="col-md-6">
                                        <label for="dob" class="form-label">Date of Birth</label>
                                        <div class="input-group has-validation">
                                            <input type="date" class="form-control" id="dob"
                                                aria-describedby="inputGroupPrepend" required="" name="dob">
                                            <div class="invalid-feedback">This field is required.</div>
                                        </div>
                                    </div>
                                    <!--end::Col-->

                                    <!--begin::Col-->
                                    <div class="col-md-6">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            required="">
                                        <div class="invalid-feedback">Email is not valid.</div>
                                    </div>
                                    <!--end::Col-->

                                    <!--begin::Col-->
                                    <div class="col-md-6">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input type="text" class="form-control" id="phone" name="phone_number"
                                            required="">
                                        <div class="invalid-feedback">This field is required.</div>
                                    </div>
                                    <!--end::Col-->

                                    <!--begin::Col-->
                                    <div class="col-md-6">
                                        <label for="address" class="form-label">Address</label>
                                        <input type="text" class="form-control" id="address" name="address"
                                            required="">
                                        <div class="invalid-feedback">This field is required.</div>
                                    </div>
                                    <!--end::Col-->


                                    <!--begin::Col-->
                                    {{-- <div class="col-md-6">

                                        <label for="validationCustom04" class="form-label">Route</label>
                                        <select class="form-select" id="validationCustom04" name="route" required="">
                                            <option>Choose...</option>
                                            @if (isset($bus_routes) && count($bus_routes) > 0)
                                                @foreach ($bus_routes as $route)
                                                    <option value="{{ $route->id }}">{{ $route->route_name }}</option>
                                                @endforeach
                                            @endif

                                        </select>
                                        <div class="invalid-feedback">Please select a route.</div>
                                    </div> --}}
                                    <!--end::Col-->

                                    {{-- <!--begin::Col-->
                                    <div class="col-md-6">
                                        <label for="validationCustom04" class="form-label">Driver</label>
                                        <select class="form-select" id="validationCustom04" name="driver" required="">
                                            <option>Choose ...</option>
                                            @if (isset($drivers) && count($drivers) > 0)
                                                @foreach ($drivers as $driver)
                                                    <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                                @endforeach
                                            @endif

                                        </select>
                                        <div class="invalid-feedback">Please select a driver.</div>
                                    </div>
                                    <!--end::Col--> --}}



                                </div>
                                <!--end::Row-->
                            </div>
                            <!--end::Body-->
                            <!--begin::Footer-->
                            <div class="card-footer">
                                <button class="btn btn-primary" type="submit"><i class="bi bi-floppy-fill"></i>
                                    Save</button>
                            </div>
                            <!--end::Footer-->
                        </form>
                        <!--end::Form-->

                    </div>
                </div>

                <div class="col-sm-6">
                    <img src="images/school_bus_driver.png" style="width: 100%; height:100vh" />
                </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!--begin::JavaScript-->
    <script>
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


        document.getElementById('driver-reg').addEventListener('submit', function(e) {

            e.preventDefault(); // prevent actual submit
            const form = this;
            const formData = new FormData(form);
            const token = $('input[name="_token"]').val();
            const isValid = validateBootstrapForm('driver-reg');



            if (isValid) {
                $("#loading").css('visibility', 'visible');
                $.ajax({
                    url: '/drivers/save',
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
