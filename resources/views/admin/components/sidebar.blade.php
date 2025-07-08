<!-- resources/views/admin/components/sidebar.blade.php -->
<div class="admin-sidebar d-none d-lg-block">
    <div class="sidebar-content">
        <!-- Optional Search Box -->
        <div class="sidebar-search p-3">
            <div class="input-group input-group-sm">
                <input type="text" class="form-control" placeholder="Search...">
                <button class="btn btn-outline-secondary" type="button">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </div>
        
        <!-- Navigation Menu -->
        <nav class="sidebar-nav">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin') ? 'active' : '' }}" href="/admin">
                        <i class="bi bi-house-door me-2"></i>
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/events*') ? 'active' : '' }}" href="{{ route('admin.events.index') }}">
                        <i class="bi bi-calendar-event me-2"></i>
                        Events
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/seats*') ? 'active' : '' }}" href="{{ route('admin.seats.index') }}">
                        <i class="bi bi-grid-3x3-gap me-2"></i>
                        Seats
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/settings*') ? 'active' : '' }}" href="#">
                        <i class="bi bi-gear me-2"></i>
                        Settings
                    </a>
                </li>
                <li class="nav-item mt-auto">
                    <a class="nav-link text-danger" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="bi bi-box-arrow-right me-2"></i>
                        Logout
                    </a>
                    <form id="logout-form" action="/admin/logout" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
    </div>
</div>

<!-- Mobile Offcanvas Sidebar -->
<div class="offcanvas offcanvas-start admin-sidebar-mobile" tabindex="-1" id="adminSidebar">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title text-white">EventAdmin</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body p-0">
        <div class="sidebar-content">
            <!-- Mobile Search -->
            <div class="sidebar-search p-3">
                <div class="input-group input-group-sm">
                    <input type="text" class="form-control" placeholder="Search...">
                    <button class="btn btn-outline-secondary" type="button">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </div>
            
            <!-- Mobile Navigation -->
            <nav class="sidebar-nav">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin') ? 'active' : '' }}" href="/admin">
                            <i class="bi bi-house-door me-2"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/events*') ? 'active' : '' }}" href="/admin/events">
                            <i class="bi bi-calendar-event me-2"></i>
                            Events
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/seats*') ? 'active' : '' }}" href="/admin/seats">
                            <i class="bi bi-grid-3x3-gap me-2"></i>
                            Seats
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/settings*') ? 'active' : '' }}" href="#">
                            <i class="bi bi-gear me-2"></i>
                            Settings
                        </a>
                    </li>
                    <li class="nav-item mt-auto">
                        <a class="nav-link text-danger" href="#" onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();">
                            <i class="bi bi-box-arrow-right me-2"></i>
                            Logout
                        </a>
                        <form id="logout-form-mobile" action="/admin/logout" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>