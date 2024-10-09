<nav class="sidebar close">
    <header>
        <div class="image-text">
            @if (Auth::user()->role == 'peserta')
                @php
                    $path = Storage::url($user_profile->image_profile);
                @endphp
                <span class="image">
                    <img src="{{ $path }}" alt="avatar">
                </span>
            @else
                <img src="{{ asset('img/default-avatar.png') }}" alt="default avatar">
            @endif
            <div class="text logo-text">
                <span class="name">{{ Auth::user()->name }}</span>
                <span class="profession">{{ Auth::user()->division }}</span>
            </div>
        </div>
        <i class='bx bx-chevron-right toggle'></i>
    </header>
    <div class="menu-bar">
        <div class="menu">
            <ul class="menu-links">
                @if (auth()->user()->role == 'peserta')
                    <li class="nav-link">
                        <a class="nav {{ Request::is('dashboard') ? 'active' : '' }}" href="/dashboard">
                            <i class='bx bx-home-alt icon'></i>
                            <span class="text nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a class="nav {{ Request::is('dashboard/show') ? 'active' : '' }}" href="/dashboard/show">
                            <i class='bx bx-history icon'></i>
                            <span class="text nav-text">Histori</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a class="nav {{ Request::is('dashboard/editprofile') ? 'active' : '' }}"
                            href="/dashboard/editprofile">
                            <i class='bx bxs-user-circle icon'></i>
                            <span class="text nav-text">profile</span>
                        </a>
                    </li>
                @endif
                <!-- Tambahkan link ini jika user adalah superadmin -->
                @if (auth()->user()->role == 'superadmin')
                    <li class="nav-link">
                        <a class="nav {{ Request::is('admin') ? 'active' : '' }}" href="/admin">
                            <i class='bx bxs-dashboard icon'></i>
                            <span class="text nav-text">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a class="nav {{ Request::is('admin/userall') ? 'active' : '' }}" href="/admin/userall">
                            <i class='bx bx-user icon'></i>
                            <span class="text nav-text">User All</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a class="nav {{ Request::is('admin/recap') ? 'active' : '' }}" href="/admin/recap">
                            <i class='bx bx-spreadsheet icon'></i>
                            <span class="text nav-text">Recap All</span>
                        </a>
                    </li>
                @endif

                <li class="nav-link">
                    <form id="logoutForm" action="{{ route('logout') }}" method="POST">
                        @csrf
                    </form>
                    <a class="nav" href="#"
                        onclick="event.preventDefault(); document.getElementById('logoutForm').submit();">
                        <i class='bx bx-log-out icon'></i>
                        <span class="text nav-text">Logout</span>
                    </a>
                </li>
            </ul>
        </div>
        </ul>
    </div>

</nav>
