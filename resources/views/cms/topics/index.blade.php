@extends('layouts.cms_app')

@section('content')
<style>
    th{ 
        text-align: center;   
    }
    td {  
        text-align: center;
        table-layout: fixed;
        height: 64px; 
        max-width: 100px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap; 
    } 
</style>

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
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Tópicos</a></li>
                            <li class="breadcrumb-item active">{{$title}}</li>
		                </ol>
		                <!-- breadcrumb -->
                    </div>
                </div>
            </div> <!-- end row -->

            <!-- Filtrar Registro -->
            <div class="row">
                <div class="col-4">
                    <form action="{{route('topics.filtro')}}" method="GET" class="row">
                        <div class="col-8">
                            <div class="form-group">
                                <select name="filtro" class="form-control">
                                    <option value="">Filtrar por: (tópico pai)</option>
                                    @if(!empty($itens_filtros))
                                        @foreach($itens_filtros as $itf)
                                            <option value="{{$itf->id}}">{{$itf->id}} - {{$itf->title}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Filtrar" />
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-4">
                    <form action="{{route('topics.busca')}}" method="GET" class="row">
                        <div class="col-8">
                            <div class="form-group">
                                <input type="text" name="busca" placeholder="Buscar por: (descrição)" class="form-control">
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Buscar" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row">
                <!-- Verifica e mostra mensagem de sucesso -->
                @include('cms.includes.alert_messages')
                <div class="col-12">
                    <div class="card m-b-20">
                        <div class="card-body">
                        	<table class="table table-striped mb-0">
	                        	<thead>
									<tr>
			                            <th>ID</th>
                                        <th>ID PAI</th>
                                        <th>TITULO</th> 
			                            <th>AÇÕES</th>
		                            </tr>
	                        	</thead>
							
								<tbody>
                                @if(count($itens)>0)
    								@foreach($itens as $item)
    	                        	<tr>
    		                            <td>{{$item->id}}</td>
    		                            <td>{{$item->id_pai}}</td>
                                        <td>{{$item->title}}</td>
                                        <td>
                                            <form action="{{route('topics.destroy', $item->id)}}" method="POST">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method" value="DELETE"/>
    										<div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{route('topics.edit', $item->id)}}" class="btn btn-primary"><i class="fas fa-edit"></i> Editar</a>
                                                <button class="btn btn-danger"><i class="fas fa-trash"></i> Deletar</button>                                                
    										</div>
                                            </form>
    		                            </td>
    		                        </tr>
    		                        @endforeach
                                @else
                                    <tr>
                                        <td colspan="6">Não há tópicos cadastrados!</td>
                                    </tr>
                                @endif
		                        </tbody>
	                        </table>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->

            <div class="row">
                <div class="col-md-12">
                    {{$itens->appends(Request::except('page'))->links()}}
                </div>
            </div>
        </div> <!-- container-fluid -->
    </div> <!-- content -->
</div>
@endsection