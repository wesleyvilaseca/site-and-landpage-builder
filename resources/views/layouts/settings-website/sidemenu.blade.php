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
                            <i class="fas fa-chart-bar"></i>
                            <span>Home</span>
                        </a>
                    </li>
                    @can('website')
                        <li class="{{ @$pag ? 'ativo' : '' }}">
                            <a href="{{ route('pages', session()->get('website_id')) }}">
                                <i class="fas fa-chart-bar"></i>
                                <span>Páginas</span>
                            </a>
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
