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
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($event->seats as $seat)
                                <tr>
                                    <td>{{ $seat->row }}</td>
                                    <td>{{ $seat->number }}</td>
                                    <td>{{ $seat->category }}</td>
                                    <td>₹{{ $seat->price }}</td>
                                    <td>
                                        <a href="{{ route('admin.seats.edit', $seat->seat_id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('admin.seats.destroy', $seat->seat_id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</button>
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
</body>

</html>