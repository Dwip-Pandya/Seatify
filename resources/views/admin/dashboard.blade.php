<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <!-- Optional icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>

    </style>

</head>

<body>

    @include('admin.components.header')

    <div class="container-fluid">
        <div class="row">
            @include('admin.components.sidebar')

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
                <h2 class="mb-4" style="margin-top: 40px;">Admin Dashboard</h2>

                <!-- Total Events Card -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="card text-white bg-primary mb-3">
                            <div class="card-header">Total Events</div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $totalEvents }}</h5>
                                <p class="card-text">Total number of events in the system.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Latest 4 Events -->
                    @foreach($latestEvents as $event)
                    <div class="col-md-3">
                        <div class="card mb-3">
                            <img src="{{ asset($event->image) }}" class="card-img-top" alt="{{ $event->name }}" style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title">{{ $event->name }}</h5>
                                <p class="card-text"><strong>Start Date:</strong> {{ \Carbon\Carbon::parse($event->start_date)->format('d M, Y H:i') }}</p>
                                <p class="card-text"><strong>Price:</strong> ₹{{ number_format($event->price, 2) }}</p>
                                <p class="card-text"><strong>Total Seats:</strong> {{ $event->seats_count }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

            </main>
        </div>
    </div>


    @include('admin.components.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>