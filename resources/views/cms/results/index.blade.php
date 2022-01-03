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
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Resultados</a></li>
                            <li class="breadcrumb-item active">{{$title}}</li>
		                </ol>
		                <!-- breadcrumb -->
                    </div>
                </div>
            </div> <!-- end row -->

            <!-- Filtrar Registro -->
            <div class="row"> 
                <div class="col-12">
                    <form action="{{route('results.busca')}}" method="GET" class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <input type="text" name="busca" placeholder="Buscar por: (nome,email,phone)" class="form-control">
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Buscar" />
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="form-group">
                                <a href="{{route('generateResultsToExcel')}}" type="submit" class="btn btn-success">Gerar XLSX</a>
                            </div>
                        </div>

                        <div class="col-2">
                            <div class="form-group">
                                <a style="color: #fff;" class="btn btn-danger" data-toggle="modal" data-target="#modalDeleteAll" >Apagar Tudo</a>
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
                                        <th>NOME</th>
                                        <th>WHATSAPP</th> 
                                        <th>EMAIL</th> 
			                            <th>AÇÕES</th>
		                            </tr>
	                        	</thead>
							
								<tbody>
                                @if(count($itens)>0)
    								@foreach($itens as $item)
    	                        	<tr>
    		                            <th>{{$item->id}}</th>
    		                            <th>{{$item->name}}</th>
    		                            <th>{{$item->phone}}</th>
                                        <td>{{$item->email}}</td>
                                        <td>
                                            <form action="{{route('results.destroy', $item->id)}}" method="POST">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method" value="DELETE"/>
    										<div class="btn-group" role="group" aria-label="Basic example">
                                                <a style="color: #fff;" data-toggle="modal" data-target="#modal" data-value="{{$item->id}}" class="btn btn-info show"><i class="fas fa-search"></i> Detalhes</a>
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

            <!-- Modal Show -->
            <div class="modal fade" id="modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Detalhes do resultado</h5>
                        </div>
                        <div class="modal-body">
                            <div id="content">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Fechar</button>
                        </div>
                    </div>
                </div>
            </div> 
            <!-- ./End Modal -->

            <!-- Modal Delete All -->
            <div class="modal fade" id="modalDeleteAll">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Voce tem certeza?</h5>
                        </div>
                        <div class="modal-body">
                            <h5>Todos resultados serão apagados</h5>
                            <small>Obs: Exporte os dados antes para xlsx</small>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="deleteAll" class="btn btn-sm btn-danger">Apagar</button>
                            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Fechar</button>
                        </div>
                    </div>
                </div>
            </div> 
            <!-- ./End Modal -->

            <div class="row">
                <div class="col-md-12">
                    {{$itens->appends(Request::except('page'))->links()}}
                </div>
            </div>
        </div> <!-- container-fluid -->
    </div> <!-- content -->
</div>
@endsection

@section("scripts")
    <script>
        $(function(){
            $(".show").on('click', function(){
                let id = $(this).attr("data-value");
                $.post(
                    '{{route("results.modal")}}',
                    {
                        _token: "{{ csrf_token() }}",
                        result_id: id
                    },
                    (result)=>{
                        $("#content").html(result);
                    }
                );
            })

            $("#deleteAll").on('click', function(){ 
                $.post(
                    '{{route("results.destroyAll")}}',
                    {
                        _token: "{{ csrf_token() }}"
                    },
                    (result)=>{
                        alert('Resultados foram deletados com sucesso !')
                        if(result.status){
                            window.location.reload()
                        }
                    }
                ); 
            })
        });
    </script>
@endsection