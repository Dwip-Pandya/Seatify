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
                
                <form action="{{ route('admin.seats.store') }}" method="POST" class="mt-5">
                    <h2>Add Multiple Seats for Event</h2>
                    @csrf

                    <!-- Select Event -->
                    <div class="mb-3">
                        <label>Select Event</label>
                        <select name="event_id" class="form-control" required>
                            @foreach($events as $event) <!-- Loop through events -->
                            <option value="{{ $event->event_id }}">{{ $event->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Seat Row -->
                    <div class="mb-3">
                        <label>Row</label>
                        <input type="text" name="row" class="form-control @error('row') is-invalid @enderror" value="{{ old('row') }}">
                        @error('row')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div class="mb-3">
                        <label>Category</label>
                        <input type="text" name="category" class="form-control @error('category') is-invalid @enderror" value="{{ old('category') }}">
                        @error('category')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Price per Seat -->
                    <div class="mb-3">
                        <label>Price</label>
                        <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" step="0.01">
                        @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Number of Seats -->
                    <div class="mb-3">
                        <label>Number of Seats</label>
                        <input type="number" name="number_of_seats" class="form-control @error('number_of_seats') is-invalid @enderror" value="{{ old('number_of_seats') }}">
                        @error('number_of_seats')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Add Seats</button>
                    <a href="{{ route('admin.seats.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </main>
        </div>
    </div>

    @include('admin.components.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>