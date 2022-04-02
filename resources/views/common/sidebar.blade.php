<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center mt-3" href="{{route('home')}}">
        <div class="sidebar-brand-icon">
            <img src="https://khaber.sa/assets/images/logo.png" width="120px" alt="">
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider mt-5">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a style="color: #d0ad54" class="nav-link" href="{{route('home')}}">
            <i style="color: #d0ad54" class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>



    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Settings
    </div>



    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a style="color: #d0ad54" class="nav-link" href="{{route('appointment.index')}}">
            <i style="color: #d0ad54" class="fas fa-fw fa-table"></i>
            <span>Appointment</span></a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a style="color: #d0ad54" class="nav-link" href="{{route('work-time.index')}}">
            <i style="color: #d0ad54" class="fas fa-fw fa-clock"></i>
            <span>Work Time</span></a>
    </li>
    <li class="nav-item">
        <a style="color: #d0ad54" class="nav-link" href="{{route('reservation')}}">
            <i style="color: #d0ad54" class="fas fa-fw fa-table"></i>
            <span>Reservations</span></a>
    </li>
    <li class="nav-item">
        <a style="color: #d0ad54" class="nav-link" href="{{route('finish.reservation')}}">
            <i style="color: #d0ad54" class="fas fa-fw fa-table"></i>
            <span>Finish Reservations</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>



</ul>
<!-- End of Sidebar -->
