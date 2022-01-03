@extends('layouts.cms_app')

@section('content')

<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <h4 class="page-title">{{$title}}</h4>
                        <!-- breadcrumb -->
		                <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Painel</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Usuários</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">{{$usuario->role->label}}</a></li>
                            <li class="breadcrumb-item active">{{$usuario->name}}</li>
		                </ol>
		                <!-- breadcrumb -->
                    </div>
                </div>
            </div> <!-- end row -->
            
            <!-- Verifica e mostra erros dos campos obrigatórios -->
            @include('cms.includes.error_messages')

            <div class="row">
                <!-- Verifica e mostra mensagem de sucesso -->
                @include('cms.includes.alert_messages')
                <div class="col-12">
                    <div class="card m-b-20">
	                    <div class="card-body">
	                    	<form action="{{route('usuarios.update', $usuario->id)}}" method="POST" enctype="multipart/form-data">
	                    		{{ csrf_field() }}
                                <input type="hidden" name="_method" value="PUT" />

                                <div class="form-group row">
                                    <div class="col-md-6"> <!-- <name> do usuário -->
                                        <label for="name">Nome</label>
                                        <input class="form-control" type="text" name="name" value="{{old('name',$usuario->name)}}" />
                                    </div>

                                    <div class="col-md-6"> <!-- <email> do usuário -->
                                        <label for="email">E-mail</label>
                                        <input class="form-control" type="text" name="email" value="{{old('email',$usuario->email)}}" />
                                    </div>
		                        </div>
                                
                                @if($auth->role->id == 1 || $auth->role->id == 2) 
                                <div class="form-group row">
                                    <div class="col-md-6"> <!-- <tipo> do usuário -->
                                        <label for="role_id">Tipo de usuário</label><br/>
                                        <select name="role_id" id="" class="form-control">
                                            @foreach($roles as $role)
                                            @if($auth->role->id == 1 || $role->id != 1)
                                            <option value="{{$role->id}}" @if(old('role_id',$usuario->role_id) == $role->id) selected @endif>{{$role->label}}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6"> <!-- <status> do usuário -->
                                        <label for="status">Status</label><br/>
                                        <select name="status" class="form-control">
                                            <option value="0" @if(old('status',$usuario->status) == 0) selected @endif>Inativo</option>
                                            <option value="1" @if(old('status',$usuario->status) == 1) selected @endif>Ativo</option> 
                                        </select>
                                    </div> 
                                </div>
                                @endif

                                <div class="form-group row">
                                    <div class="col-md-3"> <!-- <image> do perfil do usuário -->
                                        <img src="{{$usuario->image ? $usuario->image : 'https://via.placeholder.com/350x350'}}" alt="" class="mb-3" width="100%" />
                                    </div>

                                    <div class="col-md-9"> <!-- <image> do perfil do usuário -->
                                        <label for="image">Imagem destaque <small class="badge badge-primary">Cabeçalho</small></label>
                                        <input type="file" name="image" class="form-control" />
                                    </div>
                                </div>

                                <hr>

		                        <div class="form-group row">
                                    <div class="col-md-4"> <!-- <email> do usuário -->
                                        <label for="username">Nome de usuário</label>
                                        <input class="form-control" type="text" name="username" value="{{old('username',$usuario->username)}}"/>
                                    </div>

                                    <div class="col-md-4"> <!-- <meta> keywords do post -->
                                        <label for="password">Nova senha</label>
                                        <input class="form-control" type="password" name="password">
                                    </div>

                                    <div class="col-md-4"> <!-- <meta> keywords do post -->
                                        <label for="password_confirmation">Confirmar nova senha</label>
                                        <input class="form-control" type="password" name="password_confirmation"/>
                                    </div>
                                </div>

		                        <hr>

		                        <div class="form-group row">
                                    <div class="col-md-12 text-right">
                                        <button class="btn btn-primary btn-lg"><i class="fas fa-save"></i> Salvar alterações</button>
                                        <a href="{{route('usuarios.index')}}" class="btn btn-danger btn-lg"><i class="fas fa-window-close"></i> Cancelar</a>
                                    </div>
		                        </div>
	                        </form>
	                    </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->        
        </div> <!-- container-fluid -->
    </div> <!-- content -->
</div>
@endsection

@section('scripts')
    @include('cms.includes.tinymce')
@endsection