<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            {{-- <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('dashboard') ? 'active' : '' }}" aria-current="page"
                    href="{{ route('dashboard') }}">
                    <span data-feather="home" class="align-text-bottom"></span>
                    Dashboard
                </a>
            </li> --}}
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('articles.index') || Request::routeIs('articles.create') || Request::routeIs('articles.show') ? 'active' : '' }}"
                    href="{{ route('articles.index') }}">
                    <span data-feather="file-text" class="align-text-bottom"></span>
                    Articles
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('events.index') || Request::routeIs('events.create') || Request::routeIs('events.show') || Request::routeIs('events.edit') ? 'active' : '' }}"
                    href="{{ route('events.index') }}">
                    <span data-feather="calendar" class="align-text-bottom"></span>
                    Events
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('locations.index') || Request::routeIs('locations.create') || Request::routeIs('locations.show') || Request::routeIs('locations.edit') ? 'active' : '' }}"
                    href="{{ route('locations.index') }}">
                    <span data-feather="map" class="align-text-bottom"></span>
                    Locations
                </a>
            </li>
        </ul>
    </div>
</nav>
