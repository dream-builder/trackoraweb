@extends('layouts.app')
@section('content')
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Student Management</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item">Add New</li>
                        <li class="breadcrumb-item" aria-current="page"><a href="{{ route('student.show') }}">Show All</a>
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
                        <form class="needs-validation" novalidate="" action="/student/add_new" method="POST"
                            id="student-reg">
                            @csrf
                            <!--begin::Body-->
                            <div class="card-body">
                                <!--begin::Row-->
                                <div class="row g-3">
                                    <!--begin::Col-->
                                    <div class="col-md-6">
                                        <label for="validationCustom01" class="form-label">First name</label>
                                        <input type="text" class="form-control" id="validationCustom01" name="first_name"
                                            required="">
                                        <div class="valid-feedback">Looks good!</div>
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-6">
                                        <label for="validationCustom02" class="form-label">Last name</label>
                                        <input type="text" class="form-control" id="validationCustom02" name="last_name"
                                            required="">
                                        <div class="valid-feedback">Looks good!</div>
                                    </div>
                                    <!--end::Col-->

                                    <!--begin::Col-->
                                    <div class="col-md-6">
                                        <label for="validationCustom04" class="form-label">Gender</label>
                                        <select class="form-select" id="validationCustom04" name="gender" required="">
                                            <option selected="" disabled="">Choose...</option>
                                            <option>Male</option>
                                            <option>Female</option>
                                        </select>
                                        <div class="invalid-feedback">Please select a gender.</div>
                                    </div>
                                    <!--end::Col-->

                                    <!--begin::Col-->
                                    <div class="col-md-6">
                                        <label for="validationCustomUsername" class="form-label">Date of Birth</label>
                                        <div class="input-group has-validation">
                                            <input type="date" class="form-control" id="validationCustomUsername"
                                                aria-describedby="inputGroupPrepend" required="" name="dob">
                                            <div class="invalid-feedback">Please choose a Date.</div>
                                        </div>
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-md-6">
                                        <label for="validationCustom03" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="validationCustom03" name="email"
                                            required="">
                                        <div class="invalid-feedback">Please provide a valid email.</div>
                                    </div>
                                    <!--end::Col-->

                                    <!--begin::Col-->
                                    <div class="col-md-6">
                                        <label for="validationCustom05" class="form-label">Phone</label>
                                        <input type="text" class="form-control" id="validationCustom05"
                                            name="phone_number" required="">
                                        <div class="invalid-feedback">Please provide a phone.</div>
                                    </div>
                                    <!--end::Col-->

                                    <!--begin::Col-->
                                    <div class="col-md-6">
                                        <label for="validationCustom05" class="form-label">Address</label>
                                        <input type="text" class="form-control" id="validationCustom05" name="address"
                                            required="">
                                        <div class="invalid-feedback">Please provide an address.</div>
                                    </div>
                                    <!--end::Col-->


                                    <!--begin::Col-->
                                    <div class="col-md-6">
                                        <label for="validationCustom05" class="form-label">Class</label>
                                        <input type="text" class="form-control" id="validationCustom05" name="class"
                                            required="">
                                        <div class="invalid-feedback">Please provide class information.</div>
                                    </div>
                                    <!--end::Col-->


                                    <!--begin::Col-->
                                    <div class="col-md-6">
                                        <label for="validationCustom05" class="form-label">Roll Number</label>
                                        <input type="text" class="form-control" id="validationCustom05"
                                            name="roll_number" required="">
                                        <div class="invalid-feedback">Please provide a roll number.</div>
                                    </div>
                                    <!--end::Col-->

                                    <!--begin::Col-->
                                    <div class="col-md-6">
                                        <label for="pickup_location" class="form-label">Pickup Location</label>
                                        <input type="text" class="form-control" id="pickup_location"
                                            name="pickup_location" required="">
                                        <div class="invalid-feedback">Pickup Location</div>
                                    </div>
                                    <!--end::Col-->


                                </div>
                                <!--end::Row-->
                            </div>
                            <!--end::Body-->
                            <!--begin::Footer-->
                            <div class="card-footer">
                                <button class="btn btn-primary" type="submit"><i class="bi bi-floppy-fill"></i>
                                    Save Student Information</button>
                            </div>
                            <!--end::Footer-->
                        </form>
                        <!--end::Form-->

                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="card card-info card-outline mb-4">
                        <!--begin::Header-->
                        <div class="card-header">
                            <div class="card-title">Student Pickup Location</div>
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body">
                            <div id="map" style="width: 100%; height:400px; background-color:#FF0">
                            </div>

                            <script>
                                let map;
                                let marker;

                                function initMap() {
                                    // Default location (Dhaka)
                                    const defaultLocation = {
                                        lat: 23.8103,
                                        lng: 90.4125
                                    };

                                    map = new google.maps.Map(document.getElementById("map"), {
                                        zoom: 10,
                                        center: defaultLocation,
                                    });

                                    // Map Click Event
                                    map.addListener("click", (e) => {
                                        const clickedLocation = e.latLng;



                                        // Set textbox values
                                        document.getElementById("pickup_location").value = clickedLocation;
                                        //document.getElementById("lng").value = clickedLocation.lng();

                                        // Place/Move marker
                                        placeMarker(clickedLocation);
                                    });
                                }

                                function placeMarker(location) {
                                    if (marker) {
                                        marker.setPosition(location);
                                    } else {
                                        marker = new google.maps.Marker({
                                            position: location,
                                            map: map,
                                        });
                                    }
                                }
                            </script>

                            <!-- Load Google Maps JS API -->
                            <script src="https://maps.googleapis.com/maps/api/js?key={{ $mapConfig['MAP_KEY'] }}&callback=initMap" async defer
                                loading="async"></script>
                        </div>
                    </div>

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


        document.getElementById('student-reg').addEventListener('submit', function(e) {

            e.preventDefault(); // prevent actual submit
            const form = this;
            const formData = new FormData(form);
            const token = $('input[name="_token"]').val();
            const isValid = validateBootstrapForm('student-reg');



            if (isValid) {
                $("#loading").css('visibility', 'visible');
                $.ajax({
                    url: '/student/add_new',
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



                            //messageBox.html(`<p style="color: green;">${}</p>`);
                            form.reset();
                        } else {
                            $("#loading").css('visibility', 'hidden');
                            alert(data.message);
                        }
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
            } else {
                console.log('Form is not valid');
            }
        });


        // $('#student-reg').on('submit', function(e) {
        //     e.preventDefault();

        //     // Fetch all the forms we want to apply custom Bootstrap validation styles to
        //     const forms = document.querySelectorAll('.needs-validation');

        //     // Loop over them and prevent submission
        //     Array.from(forms).forEach((form) => {
        //         form.addEventListener(
        //             'submit',
        //             async (event) => {
        //                     event.preventDefault(); // Always prevent default first

        //                     if (!form.checkValidity()) {
        //                         event.stopPropagation();
        //                         form.classList.add('was-validated');
        //                         return; // Exit if form is invalid
        //                     }

        //                     form.classList.add('was-validated');

        //                 },
        //                 false,
        //         );
        //     });


















        // const form = this;
        // const formData = new FormData(form);
        // const token = $('input[name="_token"]').val();

        // $("#loading").css('visibility', 'visible');


        // $.ajax({
        // url: '/student/add_new',
        // method: 'POST',
        // headers: {
        //     'X-CSRF-TOKEN': token
        // },
        // data: formData,
        // processData: false,
        // contentType: false,
        // success: function(data) {
        //     const messageBox = $('#responseMessage');

        //     if (data.status === 'success') {


        //         $("#loading").css('visibility', 'hidden');

        //         Swal.fire({
        //             icon: 'success',
        //             title: 'Success',
        //             text: data.message,
        //             timer: 2500,
        //             showConfirmButton: false,
        //         });



        //         //messageBox.html(`<p style="color: green;">${}</p>`);
        //         form.reset();
        //     } else {
        //         $("#loading").css('visibility', 'hidden');
        //         alert(data.message);
        //     }
        // },
        // error: function(xhr) {
        //     $("#loading").css('visibility', 'hidden');
        //     Swal.fire({
        //         icon: 'error',
        //         title: 'Error',
        //         text: xhr.responseText,
        //     });
        // }
        // });
        // });
    </script>

    {{-- <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: "{{ session('success') }}",
                timer: 2500,
                showConfirmButton: false,
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: "{{ session('error') }}",
            });
        @endif
    </script> --}}
    <!--end::JavaScript-->


    {{-- <script>
        document.getElementById('student-reg').addEventListener('submit', async function(e) {
            e.preventDefault();

            const form = e.target;
            const formData = new FormData(form);
            const token = document.querySelector('input[name="_token"]').value;


            // Example starter JavaScript for disabling form submissions if there are invalid fields
            (() => {
                'use strict';

                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                const forms = document.querySelectorAll('.needs-validation');

                // Loop over them and prevent submission
                Array.from(forms).forEach((form) => {
                    form.addEventListener(
                        'submit',
                        async (event) => {
                                event.preventDefault(); // Always prevent default first

                                if (!form.checkValidity()) {
                                    event.stopPropagation();
                                    form.classList.add('was-validated');
                                    return; // Exit if form is invalid
                                }

                                form.classList.add('was-validated');

                            },
                            false,
                    );
                });
            })();



            //const form = this;

            $.ajax({
                url: '/student/add_new',
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
                        messageBox.html(`<p style="color: green;">${data.message}</p>`);
                        form.reset();
                    } else {
                        alert(data.message);
                    }
                },
                error: function(xhr) {
                    alert('Wrong');
                    // Optional: log error details
                    // console.error(xhr.responseText);
                }
            });






        });
    </script> --}}
@endsection
