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
                <form action="{{ route('admin.seats.update', $seat->seat_id) }}" method="POST" class="mt-5">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label>Select Event</label>
                        <select name="event_id" class="form-control" required>
                            @foreach($events as $event)
                            <option value="{{ $event->event_id }}" {{ $event->event_id == $seat->event_id ? 'selected' : '' }}>
                                {{ $event->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Row</label>
                        <input type="text" name="row" class="form-control" required value="{{ old('row', $seat->row) }}">
                    </div>
                    <div class="mb-3">
                        <label>Number</label>
                        <input type="text" name="number" class="form-control" required value="{{ old('number', $seat->number) }}">
                    </div>
                    <div class="mb-3">
                        <label>Category</label>
                        <input type="text" name="category" class="form-control" value="{{ old('category', $seat->category) }}">
                    </div>
                    <div class="mb-3">
                        <label>Price</label>
                        <input type="number" name="price" step="0.01" class="form-control" required value="{{ old('price', $seat->price) }}">
                    </div>
                    <button class="btn btn-primary">Update Seat</button>
                    <a href="{{ route('admin.seats.index') }}" class="btn btn-secondary">Cancel</a>
                </form>

            </main>
        </div>
    </div>

    @include('admin.components.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>