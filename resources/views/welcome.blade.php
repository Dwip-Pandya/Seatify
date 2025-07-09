<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Event Booking System</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <!-- Hero Section -->
    <section id="hero" class="hero-section">
        <div class="hero-overlay"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h1 class="hero-title">Welcome to Event Booking System</h1>
                    <p class="hero-subtitle">Discover and book your favorite events easily</p>
                    <div class="hero-buttons">
                        <a href="{{ url('admin') }}" class="btn btn-outline-light btn-lg">Admin Dashboard</a>
                        <a href="{{ url('frontend') }}" class="btn btn-primary btn-lg me-3">View Events</a>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mx-auto text-center mb-5">
                    <h2 class="section-title">About Our Platform</h2>
                    <p class="lead">Your one-stop solution for discovering and booking amazing events. From concerts to conferences, we make event booking simple and seamless.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="feature-card text-center">
                        <div class="feature-icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <h4>Browse Events</h4>
                        <p>Explore a wide variety of events happening in your area. Filter by category, date, and location.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="feature-card text-center">
                        <div class="feature-icon">
                            <i class="fas fa-bolt"></i>
                        </div>
                        <h4>Book Seats Instantly</h4>
                        <p>Select your preferred seats and book them instantly with our fast and secure booking system.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="feature-card text-center">
                        <div class="feature-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <h4>Get Booking Confirmation</h4>
                        <p>Receive instant confirmation and digital tickets delivered straight to your email.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Events Section -->
    <section id="events" class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-5">
                    <h2 class="section-title">Featured Events</h2>
                    <p class="lead">Don't miss out on these amazing upcoming events</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div id="eventCarousel" class="carousel slide" data-bs-ride="carousel">

                        {{-- Carousel indicators --}}
                        <div class="carousel-indicators">
                            @foreach($events as $index => $event)
                            <button type="button"
                                data-bs-target="#eventCarousel"
                                data-bs-slide-to="{{ $index }}"
                                @if($index===0) class="active" @endif>
                            </button>
                            @endforeach
                        </div>

                        <div class="carousel-inner">
                            @foreach($events as $index => $event)
                            <div class="carousel-item @if($index === 0) active @endif">
                                <div class="event-card">
                                    <img src="{{ $event->image ?? 'https://via.placeholder.com/1000x600?text=Event+Image' }}"
                                        class="event-image"
                                        alt="{{ $event->name }}">
                                    <div class="event-content">
                                        <h3>{{ $event->name }}</h3>
                                        <p>{{ $event->description }}</p>
                                        <div class="event-meta">
                                            <span><i class="fas fa-calendar"></i> {{ \Carbon\Carbon::parse($event->start_date)->format('F d, Y') }}</span>
                                        </div>
                                        <a href="{{ route('frontend.events.show', $event->event_id) }}" class="btn btn-primary">View Details</a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <button class="carousel-control-prev" type="button" data-bs-target="#eventCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#eventCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- How It Works Section -->
    <section id="how-it-works" class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-5">
                    <h2 class="section-title">How It Works</h2>
                    <p class="lead">Book your tickets in just a few simple steps</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 mb-4">
                    <div class="step-card text-center">
                        <div class="step-number">1</div>
                        <div class="step-icon">
                            <i class="fas fa-search"></i>
                        </div>
                        <h4>Select Event</h4>
                        <p>Browse through our curated list of events and choose the one that interests you.</p>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="step-card text-center">
                        <div class="step-number">2</div>
                        <div class="step-icon">
                            <i class="fas fa-chair"></i>
                        </div>
                        <h4>Choose Seat</h4>
                        <p>Select your preferred seats from our interactive seating chart.</p>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="step-card text-center">
                        <div class="step-number">3</div>
                        <div class="step-icon">
                            <i class="fas fa-credit-card"></i>
                        </div>
                        <h4>Make Payment</h4>
                        <p>Complete your booking with our secure payment system.</p>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="step-card text-center">
                        <div class="step-number">4</div>
                        <div class="step-icon">
                            <i class="fas fa-ticket-alt"></i>
                        </div>
                        <h4>Get Confirmation</h4>
                        <p>Receive your digital tickets and booking confirmation instantly.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p>&copy; 2025 Event Booking System. All rights reserved.</p>
                </div>
                <div class="col-md-6">
                    <ul class="list-inline text-md-end mb-0">
                        <li class="list-inline-item"><a href="#hero" class="text-white">Home</a></li>
                        <li class="list-inline-item"><a href="#events" class="text-white">Events</a></li>
                        <li class="list-inline-item"><a href="#contact" class="text-white">Contact</a></li>
                        <li class="list-inline-item"><a href="#admin" class="text-white">Admin Login</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top Button -->
    <button id="scrollToTop" class="scroll-to-top" title="Go to top">
        <i class="fas fa-chevron-up"></i>
    </button>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/script.css') }}"></script>
</body>

</html>