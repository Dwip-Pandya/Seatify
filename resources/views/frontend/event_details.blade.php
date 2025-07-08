<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $event->name }} - Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
        }

        .event-img {
            width: 100%;
            height: 350px;
            object-fit: cover;
            border-radius: 8px;
        }

        .other-event-img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <div class="container py-4">
        <a href="{{ route('frontend.events.index') }}" class="btn btn-secondary mb-4">← Back to Events</a>

        <div class="card shadow-sm p-4 mb-5">
            <div class="row">
                <div class="col-md-5 mb-3 mb-md-0">
                    <img src="{{ asset($event->image) }}" alt="{{ $event->name }}" class="event-img">
                </div>
                <div class="col-md-7">
                    <h3>{{ $event->name }}</h3>
                    <p>{{ $event->description }}</p>

                    <ul class="list-group list-group-flush mb-3">
                        <li class="list-group-item">
                            <strong>Start Date:</strong> {{ \Carbon\Carbon::parse($event->start_date)->format('d M Y, H:i') }}
                        </li>
                        <li class="list-group-item">
                            <strong>End Date:</strong> {{ \Carbon\Carbon::parse($event->end_date)->format('d M Y, H:i') }}
                        </li>
                        <li class="list-group-item">
                            <strong>Price:</strong> ${{ number_format($event->price, 2) }}
                        </li>
                    </ul>

                    <a href="{{ route('frontend.booking.select', $event->event_id) }}" class="btn btn-success">🎟 Book Now</a>
                </div>
            </div>
        </div>

        {{-- Other Events --}}
        <h4 class="mb-3">Other Events</h4>
        <div class="row">
            @forelse($otherEvents as $other)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <img src="{{ asset($other->image) }}" alt="{{ $other->name }}" class="other-event-img">
                    <div class="card-body">
                        <h5 class="card-title">{{ $other->name }}</h5>
                        <p class="card-text">${{ number_format($other->price, 2) }}</p>
                        <a href="{{ route('frontend.events.show', $other->event_id) }}" class="btn btn-primary btn-sm">View Details</a>
                    </div>
                </div>
            </div>
            @empty
            <p class="text-muted">No other events found.</p>
            @endforelse
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>