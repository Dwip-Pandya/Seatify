<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <!-- Optional icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body>

    @include('admin.components.header')

    <div class="container-fluid">
        <div class="row">
            @include('admin.components.sidebar')

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
                @foreach($events as $event)
                <div class="card mb-4 mt-5">
                    <div class="card-header">
                        <h5>{{ $event->name }}</h5>
                        <img src="{{ asset('events/'.$event->image) }}" alt="" style="width:150px;">
                    </div>
                    <div class="card-body">
                        @if($event->seats->count())
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Row</th>
                                    <th>Number</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Status</th> {{-- NEW COLUMN --}}
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($event->seats as $seat)
                                @php
                                // Check if seat is booked
                                $isBooked = DB::table('tbl_booking_seats')
                                ->where('seat_id', $seat->seat_id)
                                ->exists();

                                // Check if temporarily blocked within last 5 min
                                $isBlocked = DB::table('tbl_blocked_seats')
                                ->where('seat_id', $seat->seat_id)
                                ->where('blocked_at', '>', now()->subMinutes(5))
                                ->exists();

                                if ($isBooked) {
                                $status = 'Booked';
                                $badge = 'danger'; // red
                                } elseif ($isBlocked) {
                                $status = 'Temporarily Blocked';
                                $badge = 'primary'; // blue
                                } else {
                                $status = 'Available';
                                $badge = 'success'; // green
                                }
                                @endphp
                                <tr>
                                    <td>{{ $seat->row }}</td>
                                    <td>{{ $seat->number }}</td>
                                    <td>{{ $seat->category }}</td>
                                    <td>₹{{ $seat->price }}</td>
                                    <td>
                                        <span class="badge bg-{{ $badge }}">{{ $status }}</span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.seats.edit', $seat->seat_id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('admin.seats.destroy', $seat->seat_id) }}" method="POST" style="display:inline;" class="delete-seat-form" data-status="{{ $status }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <p>No seats assigned yet.</p>
                        @endif
                        <a href="{{ route('admin.seats.create') }}" class="btn btn-primary btn-sm">+ Add Seat</a>
                    </div>
                </div>
                @endforeach
            </main>
        </div>
    </div>

    @include('admin.components.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteForms = document.querySelectorAll('.delete-seat-form');
            deleteForms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    const status = form.getAttribute('data-status');
                    if (status !== 'Available') {
                        e.preventDefault(); // stop form submit
                        alert('Seat Cannot be deleted: this seat is ' + status.toLowerCase() + '.');
                    } else {
                        if (!confirm('Are you sure you want to delete this seat?')) {
                            e.preventDefault();
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>