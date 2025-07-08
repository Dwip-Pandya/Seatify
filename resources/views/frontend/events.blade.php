<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Event Listing</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #f8f9fa;
    }

    .event-card img {
      height: 300px;
      object-fit: cover;
    }
  </style>
</head>

<body>
  <div class="container py-4">
    <h2 class="mb-4">All Events</h2>

    <!-- Filter form -->
    <form method="GET" action="{{ route('frontend.events.index') }}" class="row g-3 mb-4">
      <div class="col-md-4">
        <input type="text" name="name" value="{{ request('name') }}" class="form-control" placeholder="Search by name">
      </div>
      <div class="col-md-3">
        <input type="date" name="start_date" value="{{ request('start_date') }}" class="form-control">
      </div>
      <div class="col-md-3">
        <input type="date" name="end_date" value="{{ request('end_date') }}" class="form-control">
      </div>
      <div class="col-md-2">
        <button class="btn btn-primary w-100">Filter</button>
      </div>
    </form>


    <!-- Event cards -->
    <div class="row">
      @forelse($events as $event)
      <div class="col-md-4 mb-4">
        <div class="card event-card shadow-sm">
          <img src="{{ asset($event->image) }}" class="card-img-top" alt="{{ $event->name }}">
          <div class="card-body">
            <h5 class="card-title d-flex justify-content-between">
              <span>{{ $event->name }}</span>
              <span class="text-success">${{ number_format($event->price,2) }}</span>
            </h5>
            <p class="card-text">{{ Str::limit($event->description, 80) }}</p>
            <a href="{{ route('frontend.events.show', $event->event_id) }}" class="btn btn-primary btn-sm">View Details</a>
          </div>
        </div>
      </div>
      @empty
      <p class="text-muted">No events found.</p>
      @endforelse
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>