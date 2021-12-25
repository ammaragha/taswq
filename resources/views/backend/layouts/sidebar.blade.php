<!-- partial -->
<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="index.html">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>

        {{-- nav users --}}
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#users" aria-expanded="false"
                aria-controls="ui-basic">
                <i class="icon-head menu-icon"></i>
                <span class="menu-title">Users</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="users">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ Route('users.index') }}">show
                            all</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ Route('users.create') }}">Add
                            new</a></li>
                </ul>
            </div>
        </li>
        {{-- end nav users --}}

        {{-- nav categories --}}
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#categories" aria-expanded="false"
                aria-controls="ui-basic">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">Categories</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="categories">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ Route('categories.index') }}">show
                            all</a></li>
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ Route('subcategories.index') }}">Sub-Categories</a></li>
                </ul>
            </div>
        </li>
        {{-- end nav categories --}}

        {{-- nav products --}}
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#products" aria-expanded="false"
                aria-controls="ui-basic">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">products</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="products">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ Route('products.index') }}">show
                            all</a></li>
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ Route('brands.index') }}">Brands</a></li>

                </ul>
            </div>
        </li>
        {{-- end nav products --}}

    </ul>
</nav>
