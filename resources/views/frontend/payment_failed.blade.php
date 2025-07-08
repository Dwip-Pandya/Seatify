<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Payment Failed</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container py-4">
        <div class="alert alert-danger">
            Payment failed! 😢
        </div>
        <p>Total Amount: ₹{{ number_format($totalAmount, 2) }}</p>
        <form action="{{ route('frontend.booking.retry', $event_id) }}" method="POST" style="display:inline-block;">
            @csrf
            <input type="hidden" name="seats" value="{{ $seats }}">
            <button type="submit" class="btn btn-warning">🔄 Try Again</button>
        </form>
        <a href="{{ route('frontend.events.index') }}" class="btn btn-secondary">❌ Cancel</a>
        <p class="text-muted mt-3">Your selected seats are blocked for 5 minutes to avoid others booking them immediately.</p>
    </div>
</body>

</html>