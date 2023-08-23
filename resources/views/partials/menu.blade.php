<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            @can('category_access')
            <li class="nav-item">
                <a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->is('admin/categories') || request()->is('admin/categories/*') ? 'active' : '' }}">
                    <i class="fas fa-gift nav-icon"></i>
                    Categories
                </a>
            </li>
            @endcan

            @can('user_access')
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-gift nav-icon"></i>
                    Learn
                </a>
                 <ul class="nav-item">
                    <li>
                        <a href="{{ route('admin.learn.index') }}" class="nav-link {{ request()->is('admin/learn') || request()->is('admin/users/*') ? 'active' : '' }}">
                            <i class="fas fa-gift nav-icon"></i>
                            Category
                        </a>
                    </li>
                    <li>
                        <a href="/admin/learn/product/view"  class="nav-link">
                            <i class="fas fa-gift nav-icon"></i>
                            Product
                        </a>
                    </li>
                </ul>
            </li>
            @endcan

            {{-- @can('faq_access') --}}
            <li class="nav-item">
                <a href="{{ route('admin.faqs.index') }}" class="nav-link {{ request()->is('admin/faqs') || request()->is('admin/faqs/*') ? 'active' : '' }}">
                    <i class="fas fa-gift nav-icon"></i>
                    FAQ
                </a>
            </li>
            {{-- @endcan --}}

            @can('user_access')
            <li class="nav-item">
                <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                    <i class="fas fa-gift nav-icon"></i>
                    User
                </a>
            </li>
            @endcan

            <li class="nav-item">
                <a href="#" onclick="getElementById('logout-form').submit()" class="nav-link">
                    <i class="nav-icon fas fa-fw fa-sign-out-alt">

                    </i>
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="post">
                    @csrf
                </form>
            </li>
        </ul>

    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
