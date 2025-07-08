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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.min.js"></script>
</head>
<body>

@include('admin.components.header')

<div class="container-fluid">
    <div class="row">
        @include('admin.components.sidebar')

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
            <form id="event-form" action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data" class="mt-5">
                @csrf

                <!-- Validation Error Messages -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Event Name -->
                <div class="mb-3">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Event Description -->
                <div class="mb-3">
                    <label>Description</label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Event Image -->
                <div class="mb-3">
                    <label>Image</label>
                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Start Date -->
                <div class="mb-3">
                    <label>Start Date</label>
                    <input type="datetime-local" name="start_date" class="form-control @error('start_date') is-invalid @enderror" value="{{ old('start_date') }}">
                    @error('start_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- End Date -->
                <div class="mb-3">
                    <label>End Date</label>
                    <input type="datetime-local" name="end_date" class="form-control @error('end_date') is-invalid @enderror" value="{{ old('end_date') }}">
                    @error('end_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Event Price -->
                <div class="mb-3">
                    <label>Price</label>
                    <input type="number" name="price" step="0.01" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}">
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success">Create Event</button>
                <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </main>
    </div>
</div>

@include('admin.components.footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // jQuery Validation
    $(document).ready(function() {
        $("#event-form").validate({
            rules: {
                name: {
                    required: true,
                    maxlength: 255
                },
                description: {
                    maxlength: 500
                },
                image: {
                    extension: "jpg|jpeg|png",
                    filesize: 2048
                },
                start_date: {
                    required: true,
                    date: true
                },
                end_date: {
                    required: true,
                    date: true,
                    greaterThanStartDate: true
                },
                price: {
                    required: true,
                    number: true,
                    min: 0
                }
            },
            messages: {
                name: {
                    required: "Please enter event name",
                    maxlength: "Event name cannot be longer than 255 characters"
                },
                description: {
                    maxlength: "Description cannot be longer than 500 characters"
                },
                image: {
                    extension: "Only JPG, JPEG, PNG files are allowed",
                    filesize: "The file size must be less than 2MB"
                },
                start_date: {
                    required: "Please provide a start date",
                    date: "Please enter a valid date"
                },
                end_date: {
                    required: "Please provide an end date",
                    date: "Please enter a valid date",
                    greaterThanStartDate: "End date must be later than start date"
                },
                price: {
                    required: "Please enter event price",
                    number: "Please enter a valid number",
                    min: "Price must be at least 0"
                }
            },
            errorElement: "div",
            errorClass: "invalid-feedback",
            highlight: function(element) {
                $(element).addClass("is-invalid").removeClass("is-valid");
            },
            unhighlight: function(element) {
                $(element).removeClass("is-invalid").addClass("is-valid");
            }
        });

        // Custom validation method to check if end date is after start date
        $.validator.addMethod("greaterThanStartDate", function(value, element) {
            var startDate = $("input[name='start_date']").val();
            return new Date(value) >= new Date(startDate);
        }, "End date must be later than start date.");
    });
</script>

</body>
</html>
