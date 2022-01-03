<!-- ========== Left Sidebar Start ========== -->
<div class="left side-menu">
    <div class="slimscroll-menu" id="remove-scroll">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu" id="side-menu">
                <li class="menu-title">Acesso geral</li>
                <li @if(Route::is('dashboard')) class="active" @endif>
                    <a href="{{route('dashboard')}}" class="waves-effect">
                        <i class="mdi mdi-view-dashboard"></i><span> Dashboard </span>
                    </a>
                </li>
                
                @if($auth->role->id == 1) 
                {{--<li @if(Route::is('pages.edit')) class="active" @endif>
                    <a href="{{route('pages.index')}}" class="waves-effect"><i class="mdi mdi-file-document"></i> <span> Ver Páginas</span> </a>
                </li>--}}
                
                <li @if(Route::is('informacoes.edit')) class="active" @endif>
                    <a href="{{route('informacoes.edit', 1)}}" class="waves-effect"><i class="mdi mdi-information"></i> <span> Informações</span> </a>
                </li>

                <li @if(Route::is('topics.index') || Route::is('topics.create') || Route::is('topics.edit')) class="active" @endif>
                    <a href="javascript:void(0)" class="waves-effect"><i class="mdi mdi-newspaper"></i> <span> Topicos <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span></span> </a>
                    <ul class="submenu">
                        <li><a href="{{route('topics.index')}}">Listar topicos</a></li>
                        <li><a href="{{route('topics.create')}}">Adicionar topico</a></li>
                    </ul>
                </li>   

                <li @if(Route::is('results.index')) class="active" @endif>
                    <a href="{{route('results.index')}}" class="waves-effect"><i class="mdi mdi-account-multiple-outline"></i> <span> Resultados</span> </a>
                </li>   

                <li class="menu-title">Acesso de administrador</li>

                <li @if(Route::is('usuarios.index') || Route::is('usuarios.create') || Route::is('usuarios.edit')) class="active" @endif>
                    <a href="javascript:void(0)" class="waves-effect"><i class="mdi mdi-account-multiple"></i> <span> Usuários <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span></span> </a>
                    <ul class="submenu">
                        <li><a href="{{route('usuarios.index')}}">Listar usuários</a></li>
                        <li><a href="{{route('usuarios.create')}}">Adicionar novo usuário</a></li>
                    </ul>
                </li>
                @endif
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
    <!-- Sidebar -left -->
</div>
<!-- Left Sidebar End -->