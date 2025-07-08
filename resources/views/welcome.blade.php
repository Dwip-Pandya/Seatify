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
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#eventCarousel" data-bs-slide-to="0" class="active"></button>
                            <button type="button" data-bs-target="#eventCarousel" data-bs-slide-to="1"></button>
                            <button type="button" data-bs-target="#eventCarousel" data-bs-slide-to="2"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="event-card">
                                    <img src="https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" class="event-image" alt="Music Concert">
                                    <div class="event-content">
                                        <h3>Summer Music Festival</h3>
                                        <p>Join us for an unforgettable night of live music featuring top artists from around the world.</p>
                                        <div class="event-meta">
                                            <span><i class="fas fa-calendar"></i> July 15, 2025</span>
                                            <span><i class="fas fa-map-marker-alt"></i> Central Park</span>
                                        </div>
                                        <a href="#" class="btn btn-primary">View Details</a>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="event-card">
                                    <img src="https://images.unsplash.com/photo-1505373877841-8d25f7d46678?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" class="event-image" alt="Tech Conference">
                                    <div class="event-content">
                                        <h3>Tech Innovation Summit</h3>
                                        <p>Discover the latest trends in technology and network with industry leaders and innovators.</p>
                                        <div class="event-meta">
                                            <span><i class="fas fa-calendar"></i> July 22, 2025</span>
                                            <span><i class="fas fa-map-marker-alt"></i> Convention Center</span>
                                        </div>
                                        <a href="#" class="btn btn-primary">View Details</a>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="event-card">
                                    <img src="https://images.unsplash.com/photo-1578662996442-48f60103fc96?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" class="event-image" alt="Art Exhibition">
                                    <div class="event-content">
                                        <h3>Modern Art Exhibition</h3>
                                        <p>Explore contemporary masterpieces from renowned artists in this exclusive exhibition.</p>
                                        <div class="event-meta">
                                            <span><i class="fas fa-calendar"></i> July 30, 2025</span>
                                            <span><i class="fas fa-map-marker-alt"></i> Art Gallery</span>
                                        </div>
                                        <a href="#" class="btn btn-primary">View Details</a>
                                    </div>
                                </div>
                            </div>
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