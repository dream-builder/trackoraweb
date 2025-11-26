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
