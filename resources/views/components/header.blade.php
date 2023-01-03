<header>
    <div class="topbar d-flex align-items-center">
        <nav class="navbar navbar-expand">
            <div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
            </div>
            <div class="top-menu ms-auto">

            </div>
            <div class="user-box dropdown">
                <a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#"
                   role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img
                        src="{{ asset("assets/images/avatars/".(( $user->photo == "" || $user->photo == null)? "blank.png" : $user->photo)) }}"
                        class="user-img" alt="user avatar">
                    <div class="user-info ps-3">
                        @if(Auth::guard('admin')->check())
                            <p class="user-name mb-0">{{ Auth::user()->name }}</p>
                        @else
                            <p class="user-name mb-0">{{ Auth::user()->first_name . " " . Auth::user()->last_name }}</p>

                        @endif
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    @php
                        $routeProfile = "user.update.profile";
                        if (Auth::guard('admin')->check()) {
                            $routeProfile = "admin.update.profile";
                        }
                    @endphp
                    <li><a class="dropdown-item" href="{{ route($routeProfile) }}"><i class="bx bx-user"></i><span>Profile</span></a>
                    </li>
                    <li><a class="dropdown-item" href="#" onclick="document.getElementById('form-logout').submit()"><i
                                class='bx bx-log-out-circle'></i><span>Déconnexion</span></a>
                    </li>

                    @php
                        $route = "logout";
                        if (Auth::guard('admin')->check()) {
                            $route = "admin.logout";
                        }
                    @endphp
                    <form action="{{ route($route) }}" method="POST" class="d-none" id="form-logout">@csrf</form>
                </ul>
            </div>
        </nav>
    </div>
</header>
