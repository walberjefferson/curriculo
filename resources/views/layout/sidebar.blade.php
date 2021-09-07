<nav class="sidebar">
    <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
            Currículo <span>SIS</span>
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item nav-category">Main</li>
            <li class="nav-item {{ active_class(['/']) }}">
                <a href="{{ url('/') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Painel</span>
                </a>
            </li>

            <li class="nav-item nav-category">Currículos</li>
            <li class="nav-item {{ active_class(['admin.curriculo.*']) }}">
                <a href="{{ route('admin.curriculo.index') }}" class="nav-link">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">Pessoas</span>
                </a>
            </li>

            <li class="nav-item nav-category">Geral</li>
            <li class="nav-item {{ active_class(['admin.sexo.*', 'admin.escolaridade.*', 'admin.habilidade.*', 'admin.estado_civil.*', 'admin.estado.*', 'admin.cidade.*']) }}">
                <a class="nav-link" data-toggle="collapse" href="#cadastros" role="button"
                   aria-expanded="{{ is_active_route(['admin.sexo.*', 'admin.escolaridade.*', 'admin.habilidade.*', 'admin.estado_civil.*', 'admin.estado.*', 'admin.cidade.*']) }}" aria-controls="cadastros">
                    <i class="link-icon" data-feather="layers"></i>
                    <span class="link-title">Cadastros</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ show_class(['admin.sexo.*', 'admin.escolaridade.*', 'admin.habilidade.*', 'admin.estado_civil.*', 'admin.estado.*', 'admin.cidade.*']) }}" id="cadastros">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('admin.sexo.index') }}"
                               class="nav-link {{ active_class(['admin.sexo.*']) }}">Sexo</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.escolaridade.index') }}"
                               class="nav-link {{ active_class(['admin.escolaridade.*']) }}">Escolaridade</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.habilidade.index') }}"
                               class="nav-link {{ active_class(['admin.habilidade.*']) }}">Habilidades</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.estado_civil.index') }}"
                               class="nav-link {{ active_class(['admin.estado_civil.*']) }}">Estado Civil</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.estado.index') }}"
                               class="nav-link {{ active_class(['admin.estado.*']) }}">Estados</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.cidade.index') }}"
                               class="nav-link {{ active_class(['admin.cidade.*']) }}">Cidades</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item nav-category">Configurações</li>
            <li class="nav-item {{ active_class(['admin.user.*', 'admin.role.*']) }}">
                <a class="nav-link" data-toggle="collapse" href="#configuracoes" role="button"
                   aria-expanded="{{ is_active_route(['admin.user.*', 'admin.role.*']) }}" aria-controls="configuracoes">
                    <i data-feather="tool" class="link-icon" ></i>
                    <span class="link-title">Configurações</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse {{ show_class(['admin.user.*', 'admin.role.*']) }}" id="configuracoes">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('admin.user.index') }}"
                               class="nav-link {{ active_class(['admin.user.*']) }}">Usuários</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.role.index') }}"
                               class="nav-link {{ active_class(['admin.role.*']) }}">Perfis</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>
<nav class="d-none settings-sidebar">
    <div class="sidebar-body">
        <a href="#" class="settings-sidebar-toggler">
            <i data-feather="settings"></i>
        </a>
        <h6 class="text-muted">Sidebar:</h6>
        <div class="form-group border-bottom">
            <div class="form-check form-check-inline">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="sidebarThemeSettings" id="sidebarLight"
                           value="sidebar-light" checked>
                    Light
                </label>
            </div>
            <div class="form-check form-check-inline">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="sidebarThemeSettings" id="sidebarDark"
                           value="sidebar-dark">
                    Dark
                </label>
            </div>
        </div>
        <div class="theme-wrapper">
            <h6 class="text-muted mb-2">Light Version:</h6>
            <a class="theme-item active" href="https://www.nobleui.com/laravel/template/light/">
                <img src="{{ url('assets/images/screenshots/light.jpg') }}" alt="light version">
            </a>
            <h6 class="text-muted mb-2">Dark Version:</h6>
            <a class="theme-item" href="https://www.nobleui.com/laravel/template/dark">
                <img src="{{ url('assets/images/screenshots/dark.jpg') }}" alt="light version">
            </a>
        </div>
    </div>
</nav>
