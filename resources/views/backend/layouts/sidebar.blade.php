<!-- partial -->
<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ url('dashboard') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>

        {{-- nav users --}}
        <li class="nav-item">
            <a class="nav-link" href="{{ Route('users.index') }}">
                <i class="icon-head menu-icon"></i>
                <span class="menu-title">Users</span>
            </a>
        </li>
        {{-- end nav users --}}

        {{-- nav categories --}}
        <li class="nav-item">
            <a class="nav-link" href="{{ Route('categories.index') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Categories</span>
            </a>
        </li>
        {{-- end nav categories --}}

        {{-- nav categories --}}
        <li class="nav-item">
            <a class="nav-link" href="{{ Route('subcategories.index') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Subs</span>
            </a>
        </li>
        {{-- end nav categories --}}

        {{-- nav brands --}}
        <li class="nav-item">
            <a class="nav-link" href="{{ Route('brands.index') }}">
                <i class="icon-tag menu-icon"></i>
                <span class="menu-title">Brands</span>
            </a>
        </li>
        {{-- end nav brands --}}

        {{-- nav products --}}
        <li class="nav-item">
            <a class="nav-link" href="{{ Route('products.index') }}">
                <i class="icon-server menu-icon"></i>
                <span class="menu-title">Products</span>
            </a>
        </li>
        {{-- end nav products --}}

        {{-- nav orders --}}
        <li class="nav-item">
            <a class="nav-link" href="{{ Route('orders.index') }}">
                <i class="icon-clipboard menu-icon"></i>
                <span class="menu-title">Orders</span>
            </a>
        </li>
        {{-- end nav orders --}}

    </ul>
</nav>
