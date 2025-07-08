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
                <form action="{{ route('admin.events.update', $event->event_id) }}" method="POST" enctype="multipart/form-data" class="mt-5">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" required value="{{ old('name', $event->name) }}">
                    </div>

                    <div class="mb-3">
                        <label>Description</label>
                        <textarea name="description" class="form-control">{{ old('description', $event->description) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label>Image</label><br>
                        @if($event->image)
                        <img src="{{ asset('storage/'.$event->image) }}" width="100" class="mb-2"><br>
                        @endif
                        <input type="file" name="image" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Start Date</label>
                        <input type="datetime-local" name="start_date" class="form-control" required value="{{ old('start_date', \Carbon\Carbon::parse($event->start_date)->format('Y-m-d\TH:i')) }}">
                    </div>

                    <div class="mb-3">
                        <label>End Date</label>
                        <input type="datetime-local" name="end_date" class="form-control" required value="{{ old('end_date', \Carbon\Carbon::parse($event->end_date)->format('Y-m-d\TH:i')) }}">
                    </div>

                    <div class="mb-3">
                        <label>Price</label>
                        <input type="number" name="price" step="0.01" class="form-control" required value="{{ old('price', $event->price) }}">
                    </div>

                    <button class="btn btn-primary">Update Event</button>
                    <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">Cancel</a>
                </form>


            </main>
        </div>
    </div>

    @include('admin.components.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>