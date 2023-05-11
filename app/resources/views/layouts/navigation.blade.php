<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="{{ route('home') }}" class="logo d-flex align-items-center">
            <img src="/assets/img/logo.png" alt="">
            <span class="d-none d-lg-block">Budget Tracker</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">
            <li class="nav-item d-block d-lg-none">
                <a class="nav-link nav-icon search-bar-toggle " href="#">
                    <i class="bi bi-search"></i>
                </a>
            </li><!-- End Search Icon-->

            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <img src="/assets/img/ameen-img.jpg" alt="Profile" class="rounded-circle">
                    <span class="d-none d-md-block dropdown-toggle ps-2">{{ auth()->user()->name }}</span>
                </a><!-- End Profile Iamge Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6>{{ auth()->user()->name }}</h6>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{ route('profile.show') }}">
                            <i class="bi bi-person"></i>
                            <span>My Profile</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{ route('profile.show') }}">
                            <i class="bi bi-gear"></i>
                            <span>Account Settings</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                            <i class="bi bi-question-circle"></i>
                            <span>Need Help?</span>
                        </a>
                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <form method="POST" action="{{ route('logout') }}" id="logout">@csrf
                            <button type="submit" class="dropdown-item d-flex align-items-center">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </button>
                        </form>
                    </li>

                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->

        </ul>
    </nav><!-- End Icons Navigation -->

</header><!-- End Header -->

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="{{ route('home') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->


          <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#tickets-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-question-circle"></i><span>Tickets</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="tickets-nav" class="nav-content collapse {{ request()->routeIs('tickets.*') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('tickets.overall') }}" class="{{ request()->routeIs('tickets.overall') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Overall</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('tickets.index') }}" class="{{ request()->routeIs('tickets.index') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Track Mines</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('tickets.assigned') }}" class="{{ request()->routeIs('tickets.assigned') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Assigned to Me</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('tickets.create') }}" class="{{ request()->routeIs('tickets.create') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Raise New</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Components Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-gem"></i><span>Features</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('features.index') }}" class="{{ request()->routeIs('features.index') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>View All</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-heading">Pages</li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('profile.show') }}">
                <i class="bi bi-person"></i>
                <span>Profile</span>
            </a>
        </li><!-- End Profile Page Nav -->
    </ul>

</aside><!-- End Sidebar-->
