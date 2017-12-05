<nav id="sidebar-menu" class="navbar">
    <ul class="navbar-nav">
        <li class="nav-item active">
            <a class="nav-link" href="{{ route('admin.todo-status.index') }}">
                @include('icons.projects')
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.users.index') }}">
                @include('icons.users')
            </a>
        </li>
    </ul>
</nav>
