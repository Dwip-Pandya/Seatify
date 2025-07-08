<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>{{ $event->name }} - Book Seats</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .seat {
      width: 40px;
      height: 40px;
      margin: 5px;
      border-radius: 5px;
      cursor: pointer;
      display: inline-block;
      text-align: center;
      line-height: 40px;
      font-size: 14px;
      color: white;
      background: #ccc;
    }

    .seat.booked {
      background-color: red;
      cursor: not-allowed;
    }

    .seat.blocked {
      background-color: blue;
      cursor: not-allowed;
    }

    .seat.available {
      background-color: #ccc;
    }

    .seat.selected {
      background-color: green;
    }

    .seat:hover:not(.booked):not(.blocked):not(.selected) {
      background-color: #888;
    }
  </style>
</head>

<body class="p-4">

  <div class="mb-3">
    <span class="seat booked me-2"></span> Booked
    <span class="seat blocked ms-3 me-2"></span> Temporarily Blocked
    <span class="seat available ms-3 me-2"></span> Available
  </div>

  <h2>{{ $event->name }}</h2>

  @php $groupedSeats = $seats->groupBy('category'); @endphp

  <form method="POST" action="{{ route('frontend.booking.confirm', $event->event_id) }}" id="bookingForm">
    @csrf
    <input type="hidden" name="seats" id="selectedSeats">

    @foreach($groupedSeats as $category => $categorySeats)
    <div class="mb-4">
      <h5>{{ ucfirst($category) }} - ₹{{ $categorySeats->first()->price }}</h5>
      <div class="d-flex flex-wrap">
        @foreach($categorySeats as $seat)
        @php
        $isBooked = in_array($seat->seat_id, $bookedSeats);
        $isBlocked = in_array($seat->seat_id, $blockedSeats);
        @endphp
        <div class="seat 
    {{ $isBooked ? 'booked' : ($isBlocked ? 'blocked' : 'available') }}"
          data-seat-id="{{ $seat->seat_id }}"
          data-price="{{ $seat->price }}">
          {{ $seat->row }}{{ $seat->number }}
        </div>

        @endforeach
      </div>
    </div>
    @endforeach

    <p>Selected Seats: <span id="selectedCount">0</span></p>
    <p>Total Price: ₹<span id="totalPrice">0.00</span></p>

    <button type="submit" class="btn btn-success">Confirm Booking</button>
    <a href="{{ route('frontend.events.index') }}" class="btn btn-secondary">Cancel</a>
  </form>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      let selected = [],
        total = 0;
      document.querySelectorAll('.seat').forEach(seat => {
        seat.addEventListener('click', () => {
          if (seat.classList.contains('booked')) return;
          const id = seat.dataset.seatId;
          const price = parseFloat(seat.dataset.price);
          if (seat.classList.contains('selected')) {
            seat.classList.remove('selected');
            selected = selected.filter(s => s != id);
            total -= price;
          } else {
            seat.classList.add('selected');
            selected.push(id);
            total += price;
          }
          document.getElementById('selectedSeats').value = selected.join(',');
          document.getElementById('selectedCount').innerText = selected.length;
          document.getElementById('totalPrice').innerText = total.toFixed(2);
        });
      });
    });
  </script>
</body>

</html>