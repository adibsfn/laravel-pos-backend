<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ url('/home') }}">Puding Kelapa</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ url('/home') }}">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="nav-item dropdown">
                <a href="#"
                    class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                <ul class="dropdown-menu">
                    <li class='{{ Request::is('/') ? 'active' : '' }}'>
                        <a class="nav-link"
                            href="{{ url('/home') }}">General Dashboard</a>
                    </li>
                </ul>
            </li>

            <li class="menu-header">User</li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>User</span></a>
                <ul class="dropdown-menu">
                    <li class='{{ Request::is('user') ? 'active' : '' }}'>
                        <a class="nav-link"
                            href="{{ route('user.index') }}">All User</a>
                    </li>
                </ul>
            </li>

            <li class="menu-header">Master</li>
            {{-- <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Category</span></a>
                <ul class="dropdown-menu">
                    <li class='{{ Request::is('category') ? 'active' : '' }}'>
                        <a class="nav-link"
                            href="{{ route('category.index') }}">All Category</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Product</span></a>
                <ul class="dropdown-menu">
                    <li class='{{ Request::is('product') ? 'active' : '' }}'>
                        <a class="nav-link"
                            href="{{ route('product.index') }}">All Product</a>
                    </li>
                </ul>
            </li> --}}

            <li class="{{ Request::is('category') ? 'active' : '' }}">
                <a class="nav-link"
                    href="{{ route('category.index') }}"><i class="fas fa-fire"></i> <span>Category</span></a>
            </li>

            <li class="{{ Request::is('product') ? 'active' : '' }}">
                <a class="nav-link"
                    href="{{ route('product.index') }}"><i class="fas fa-fire"></i> <span>Product</span></a>
            </li>

        </ul>
    </aside>
</div>
