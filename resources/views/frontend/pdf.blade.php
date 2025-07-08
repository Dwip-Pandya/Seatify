<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Booking Confirmation</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            color: #333;
            line-height: 1.5;
            margin: 0;
            padding: 20px;
        }

        h2 {
            color: #4CAF50;
            border-bottom: 2px solid #4CAF50;
            padding-bottom: 8px;
            margin-bottom: 20px;
        }

        .section-title {
            margin-top: 30px;
            font-size: 18px;
            color: #555;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 8px 12px;
            text-align: left;
        }

        table th {
            background-color: #f2f2f2;
        }

        .total {
            font-size: 16px;
            font-weight: bold;
            color: #000;
        }
    </style>
</head>

<body>
    <h2>🎟 Booking Confirmation</h2>

    <p><strong>Booking ID:</strong> {{ $booking->booking_id }}</p>

    <p class="section-title">Event Details</p>
    <table>
        <tr>
            <th>Event Name</th>
            <td>{{ $booking->event->name ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th>Event Start</th>
            <td>{{ \Carbon\Carbon::parse($booking->event->start_date)->format('d M Y, H:i') }}</td>
        </tr>
        <tr>
            <th>Event End</th>
            <td>{{ \Carbon\Carbon::parse($booking->event->end_date)->format('d M Y, H:i') }}</td>
        </tr>
    </table>

    <p class="section-title">Booking Details</p>
    <table>
        <tr>
            <th>Booking Date</th>
            <td>{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y, H:i') }}</td>
        </tr>
        <tr>
            <th>Selected Seats</th>
            <td>{{ implode(', ', $booking->seats->map(fn($seat) => $seat->row . $seat->number)->toArray()) }}</td>
        </tr>
        <tr>
            <th class="total">Total Amount</th>
            <td class="total">₹{{ number_format($booking->total_amount, 2) }}</td>
        </tr>
    </table>

    <p style="margin-top: 40px; font-size: 12px; color: #777;">
        Thank you for your booking! Enjoy your event.
    </p>
</body>

</html>