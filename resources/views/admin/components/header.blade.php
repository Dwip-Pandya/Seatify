<!-- resources/views/admin/components/header.blade.php -->
<header class="admin-header">
    <div class="container-fluid">
        <div class="d-flex align-items-center justify-content-between h-100">
            <!-- Logo -->
            <div class="header-logo">
                <h4 class="mb-0 text-white fw-bold">EventAdmin</h4>
            </div>
            
            <!-- Mobile Menu Toggle -->
            <button class="btn btn-outline-light d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#adminSidebar">
                <i class="bi bi-list"></i>
            </button>
            
            <!-- Right Side -->
            <div class="header-right d-flex align-items-center">
                <!-- Admin Info -->
                <div class="dropdown">
                    <button class="btn btn-outline-light dropdown-toggle d-flex align-items-center" type="button" data-bs-toggle="dropdown">
                        <i class="bi bi-person-circle me-2"></i>
                        <span class="d-none d-md-inline">Admin User</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i>Profile</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i>Settings</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>