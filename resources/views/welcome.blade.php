{{-- @extends('layouts.app_minimal')

@section('style')
    <style>
        .bg-body-tertiary {
            /* background-color: #242830 !important; */
        }

        .custom-contain {
            width: 80%;
            margin: auto;

            margin-top: 100px;
        }
    </style>
@endsection

@section('content')
    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
                <div class="custom-contain">
                    <div class="row">
                        <div class="col-md-5">
                            <img src="images/sbt_landing.png" width="100%">
                        </div>
                        <div class="col-md-7">
                            <h1 class="mb-0 text-white">School Bus Tracker</h1>
                            <small>A smart tracking solution that allows students to view real-time bus
                                locations and
                                estimated arrival times, ensuring timely pickups. Parents can monitor their child's journey
                                for enhanced safety and peace of mind, receiving instant alerts on boarding, drop-offs, and
                                route changes.</small>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #fff;
            color: #343a40;



        }

        body::before {
            content: "";
            background: url('images/sbt_landing_gray.png') no-repeat center center fixed;
            background-size: cover;
            position: fixed;
            background-blend-mode: luminosity;
            top: 0;
            left: 0;
            height: 100vh;
            width: 100vw;
            filter: blur(8px);
            z-index: -1;
        }

        .navbar-brand {
            color: #0056d2;
            font-weight: 600;
        }

        .hero {
            padding: 60px 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .hero h1 {
            font-size: 2.5rem;
            font-weight: bold;
            color: #E8C174;
            text-shadow: 1px 0px 8px #000;
        }

        .hero p {
            color: #000000;
            margin: 20px 0;
        }

        .btn-primary {
            background-color: #0056d2;
            border-color: #0056d2;
        }

        .btn-light {
            background-color: #f1f4ff;
            color: #0056d2;
        }

        .hero-img {
            max-width: 500px;
            width: 100%;
            border: solid 1px gray;
            box-shadow: -4px 5px 41px #000;
            border-radius: 11px;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-white border-bottom">
        <div class="container">

            <a class="navbar-brand" href="/"><img src="images/trackora_logo_s.png"
                    style="height: 50px; border-radius:5px;">
                {{ config('app.name') }}</a>
            <div class="d-flex">

                <a href="{{ route('login') }}" class="btn btn-outline-primary">Login</a> &nbsp;
                <a href="{{ route('register') }}" class="btn btn-outline-success">Register</a>
            </div>
        </div>
    </nav>

    <section class="hero container">
        <div class="col-md-6">
            <h1>School Bus Tracking System</h1>
            <p>A smart tracking solution that allows students to view real-time bus locations and estimated arrival
                times, ensuring timely pickups. Parents can monitor their child's journey for enhanced safety and peace
                of mind, receiving instant alerts on boarding, drop-offs, and route changes.</p>
            <div>
                <a href="#" class="btn btn-primary me-2">View Demo</a>
                <a href="#" class="btn btn-dark">Get in touch</a>
            </div>
        </div>
        <div class="col-md-6" style="text-align: right">
            <img src="images/trackora.png" alt="School Bus tracker" class="hero-img">
        </div>
    </section>

</body>

</html>
