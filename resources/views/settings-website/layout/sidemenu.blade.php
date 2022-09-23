<nav id="sidebar" class="sidebar-wrapper">
    <div class="sidebar-content">
        <div class="sidebar-brand">
            <img src="" alt="">
            <a href="#">Settings - {{ session()->get('sitename') }}</a>
            <div id="close-sidebar">
                <i class="fas fa-times"></i>
            </div>
        </div>
        <div class="sidebar-header">
            <div class="sidebar-menu">
                <a href="{{ route('websites') }}" class="btn btn-sm btn-success"><i class="fas fa-chevron-left"></i>
                    Voltar Dashboard principal</a>
                <ul id="sitemaps">
                    <li class="header-menu">
                        <span>Navegação</span>
                    </li>
                    <li class="{{ @$h_settings ? 'ativo' : '' }}">
                        <a href="{{ route('websites.settings') }}">
                            <i class="fas fa-tachometer-alt"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    @can('menu_access')
                        <li class="{{ @$men ? 'ativo' : '' }}">
                            <a href="{{ route('menus') }}">
                                <i class="fas fa-project-diagram"></i>
                                <span>Menu</span>
                            </a>
                        </li>
                    @endcan

                    @can('pages_access')
                        <li class="{{ @$pag ? 'ativo' : '' }}">
                            <a href="{{ route('pages', session()->get('website_id')) }}">
                                <i class="far fa-file-alt"></i>
                                <span>Páginas</span>
                            </a>
                        </li>
                    @endcan

                    @can('layout_access')
                        <li class="sidebar-dropdown {{ @$lay ? 'active_side' : '' }}">
                            <a>
                                <i class="fas fa-object-group"></i>
                                <span>Layout</span>
                            </a>
                            <div class="sidebar-submenu {{ @$lay ? 'd-block' : '' }}">
                                <ul>
                                    <li class="{{ @$them ? 'ativo' : '' }}">
                                        <a href="#">Tema</a>
                                    </li>

                                    <li class="{{ @$wid ? 'ativo' : '' }}">
                                        <a href="#">Meus Widgets</a>
                                    </li>

                                    <li class="{{ @$nov_lay ? 'ativo' : '' }}">
                                        <a href="#">Adicionar novo</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @endcan

                    @can('modules_access')
                        <li class="sidebar-dropdown {{ @$mod ? 'active_side' : '' }}">
                            <a>
                                <i class="fab fa-buromobelexperte"></i>
                                <span>Modulos</span>
                            </a>
                            <div class="sidebar-submenu {{ @$mod ? 'd-block' : '' }}">
                                <ul>
                                    <li class="{{ @$meu ? 'ativo' : '' }}">
                                        <a href="#">Modulos Ativos</a>
                                    </li>

                                    <li class="{{ @$nov ? 'ativo' : '' }}">
                                        <a href="#">Adicionar novo</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @endcan
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
