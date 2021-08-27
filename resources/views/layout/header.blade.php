<nav class="navbar">
    <a href="#" class="sidebar-toggler">
        <i data-feather="menu"></i>
    </a>
    <div class="navbar-content">
        <ul class="navbar-nav">
            <li class="nav-item dropdown nav-profile">
                <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    @auth
                        <img src="{{ 'https://www.gravatar.com/avatar/' . md5(auth()->user()->email) . '?d=mm' }}" alt="profile">
                    @elseauth
                        <img src="{{ url('https://via.placeholder.com/30x30') }}" alt="profile">
                    @endauth
                </a>
                <div class="dropdown-menu" aria-labelledby="profileDropdown">
                    <div class="dropdown-header d-flex flex-column align-items-center">
                        <div class="figure mb-3">
                            @auth
                                <img src="{{ 'https://www.gravatar.com/avatar/' . md5(auth()->user()->email) . '?d=mm' }}" alt="profile">
                            @elseauth
                                <img src="{{ url('https://via.placeholder.com/80x80') }}" alt="profile">
                            @endauth
                        </div>
                        <div class="info text-center">
                            @auth
                            <p class="name font-weight-bold mb-0">{{ auth()->user()->name }}</p>
                            <p class="email text-muted mb-3">{{ auth()->user()->email }}</p>
                            @endauth
                        </div>
                    </div>
                    <div class="dropdown-body">
                        <ul class="profile-nav p-0 pt-3">
                            <li class="nav-item">
                                <a href="{{ route('admin.profile') }}" class="nav-link">
                                    <i data-feather="user"></i>
                                    <span>Profile</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="javascript:;" class="nav-link">
                                    <i data-feather="edit"></i>
                                    <span>Edit Profile</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="javascript:;" class="nav-link">
                                    <i data-feather="log-out"></i>
                                    <span>Sair</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</nav>
