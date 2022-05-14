<nav id="sidebar" class="sidebar-wrapper">
    <div class="sidebar-content">
        <div class="sidebar-brand">
            <img src="" alt="">
            <a href="#">ACL</a>
            <div id="close-sidebar">
                <i class="fas fa-times"></i>
            </div>
        </div>
        <div class="sidebar-header">
            <div class="sidebar-menu">
                <ul id="sitemaps">
                    <li class="header-menu">
                        <span>Navegação</span>
                    </li>
                    <li class="{{ @$home ? 'ativo' : '' }}">
                        <a href="{{ route('painel') }}">
                            <i class="fas fa-chart-bar"></i>
                            <span>Home</span>
                        </a>
                    </li>

                    @can('users')
                        <li class="{{ @$users ? 'ativo' : '' }}">
                            <a href="{{ route('users') }}">
                                <i class="fas fa-chart-bar"></i>
                                <span>Users</span>
                            </a>
                        </li>
                    @endcan

                    @can('qrcode_access')
                        <li class="{{ @$qr ? 'ativo' : '' }}">
                            <a href="{{ route('qrcode') }}">
                                <i class="fas fa-chart-bar"></i>
                                <span>QrCode</span>
                            </a>
                        </li>
                    @endcan

                    @can('permissions')
                        <li class="sidebar-dropdown {{ @$perm ? 'active_side' : '' }}">
                            <a>
                                <i class="fas fa-chart-line"></i>
                                <span>Permissões</span>
                            </a>
                            <div class="sidebar-submenu {{ @$perm ? 'd-block' : '' }}">
                                <ul>
                                    <li class="{{ @$roles ? 'ativo' : '' }}">
                                        <a href="{{ route('roles') }}">Roles</a>
                                    </li>

                                    <li class="{{ @$permissions ? 'ativo' : '' }}">
                                        <a href="{{ route('permissions') }}">Permissões</a>
                                    </li>

                                    {{-- <li class="{{ @$posts ? 'ativo' : '' }}">
                                    <a href="{{ route('posts') }}">Posts</a>
                                </li> --}}
                                </ul>
                            </div>
                        </li>
                    @endcan

                    <li class="">
                        <a href="{{ route('logout') }}">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Logout</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
</nav>

<style>
    .ativo a {
        color: #16c7ff !important;
    }

    .ativo a i {
        color: #16c7ff;
    }

</style>
