<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Booking Confirmation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container py-4">
        <div class="alert alert-success">
            @if($isRetry)
            <div class="alert alert-info">Payment successful on second attempt! 🎉</div>
            @else
            <div class="alert alert-success">Payment successful! 🎉</div>
            @endif

        </div>

        <h3 class="mb-3">Booking Confirmation</h3>

        <ul class="list-group mb-4">
            <li class="list-group-item"><strong>Booking ID:</strong> {{ $booking->booking_id }}</li>
            <li class="list-group-item">
                <strong>Event:</strong> {{ $booking->event->name ?? 'N/A' }}
                (Price: ${{ number_format($booking->event->price ?? 0, 2) }})
            </li>
            <li class="list-group-item">
                <strong>Event Date:</strong>
                {{ \Carbon\Carbon::parse($booking->event->start_date)->format('d M Y, H:i') }}
                - {{ \Carbon\Carbon::parse($booking->event->end_date)->format('d M Y, H:i') }}
            </li>
            <li class="list-group-item">
                <strong>Selected Seats:</strong>
                {{ implode(', ', $booking->seats->map(fn($seat) => $seat->row . $seat->number)->toArray()) }}
            </li>
            <li class="list-group-item">
                <strong>Booking Date & Time:</strong> {{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y, H:i') }}
            </li>
            <li class="list-group-item">
                <strong>Total Amount:</strong> ${{ number_format($booking->total_amount, 2) }}
            </li>
        </ul>

        <a href="{{ asset($booking->pdf_path) }}" class="btn btn-primary">📄 Download PDF</a>
        <a href="{{ route('frontend.events.index') }}" class="btn btn-secondary">Back to Events</a>
    </div>
</body>

</html>