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
                <style>
                   .menu {
  list-style: none;
  padding: 0;
  margin: 0;
  background: #ffffff;
}

.menu > li {
  position: relative;
 
 
  cursor: pointer;
}

.menu > li:hover {
  background: #c3c2c2;
}

.menu li ul {
  list-style: none;
  padding: 0;
  margin: 0;
  background: #c3c2c2;
  position: absolute;
  top: 100%;
  left: 0;
  width: 150px;

  display: none; /* hide by default */
}

.menu li:hover > ul {
  display: block; /* show on hover */
}

.menu li ul li {
  padding: 10px 15px;
  color: #fff;
}

.menu li ul li:hover {
  background: #c3c2c2;
}


                </style>

                <ul class="menu">
                    <li class="btn btn-outline-primary"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-translate" viewBox="0 0 16 16">
  <path d="M4.545 6.714 4.11 8H3l1.862-5h1.284L8 8H6.833l-.435-1.286zm1.634-.736L5.5 3.956h-.049l-.679 2.022z"/>
  <path d="M0 2a2 2 0 0 1 2-2h7a2 2 0 0 1 2 2v3h3a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-3H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h7a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zm7.138 9.995q.289.451.63.846c-.748.575-1.673 1.001-2.768 1.292.178.217.451.635.555.867 1.125-.359 2.08-.844 2.886-1.494.777.665 1.739 1.165 2.93 1.472.133-.254.414-.673.629-.89-1.125-.253-2.057-.694-2.82-1.284.681-.747 1.222-1.651 1.621-2.757H14V8h-3v1.047h.765c-.318.844-.74 1.546-1.272 2.13a6 6 0 0 1-.415-.492 2 2 0 0 1-.94.31"/>
</svg>

                        <ul>

                            @foreach (config('locales.supported') as $locale)
                                <li><a href="/{{ $locale }}">{{$locale}}</a></li>
                            @endforeach
                        </ul>

                    </li>

                </ul>&nbsp;
                <a href="{{ route('login') }}" class="btn btn-outline-primary">Login</a> &nbsp;
                <a href="{{ route('register') }}" class="btn btn-outline-success">Register</a>
            </div>
        </div>
    </nav>

    <section class="hero container">
        <div class="col-md-6">
            <h1>School Bus Tracking System {{ __('messages.welcome') }}</h1>
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
