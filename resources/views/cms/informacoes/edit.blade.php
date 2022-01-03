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
                            <li class="breadcrumb-item active">Informações</li>
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
	                    	<form action="{{route('informacoes.update', $info->id)}}" method="POST">
	                    		{{ csrf_field() }}
                                <input type="hidden" name="_method" value="PUT" />

                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs nav-tabs-custom" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#tab1" role="tab">Configurações</a>
                                    </li>
                                    {{--<li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#tab2" role="tab">Localização</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#tab3" role="tab">Redes Sociais</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#tab4" role="tab">Scripts</a>
                                    </li>--}}
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active p-3" id="tab1" role="tabpanel">
                                        <div class="form-group row">
                                            <div class="col-md-6">  
                                                <label for="link_politica">Link para politica de privacidade externa</label>
                                                <input class="form-control" type="text" name="link_politica" value="{{$info->link_politica}}" />
                                            </div>
                                            <div class="col-md-6">  
                                                <label for="email">E-mail para receber notificação de contato</label>
                                                <input class="form-control" type="text" name="email" value="{{$info->email}}" />
                                            </div>
                                        </div>
                                    </div>
                                    
                                    {{-- Commented not used tabs --}}
                                    {{--<div class="tab-pane p-3" id="tab2" role="tabpanel">
                                        <div class="form-group row">
                                            <div class="col-md-12"> <!-- <title> -->
                                                <label for="endereco">Endereço</label>
                                                <input class="form-control" type="text" name="endereco" value="{{$info->endereco}}" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane p-3" id="tab3" role="tabpanel">
                                        <div class="form-group row">
                                            <div class="col-md-6"> <!-- <facebook> -->
                                                <label for="facebook">Facebook</label>
                                                <input class="form-control" type="text" name="facebook" value="{{$info->facebook}}" />
                                            </div>
                                            <div class="col-md-6"> <!-- <Twitter> -->
                                                <label for="twitter">Twitter</label>
                                                <input class="form-control" type="text" name="twitter" value="{{$info->twitter}}" />
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-6"> <!-- <Instagram> -->
                                                <label for="instagram">Instagram</label>
                                                <input class="form-control" type="text" name="instagram" value="{{$info->instagram}}" />
                                            </div>
                                            <div class="col-md-6"> <!-- <Youtube> -->
                                                <label for="youtube">Youtube</label>
                                                <input class="form-control" type="text" name="youtube" value="{{$info->youtube}}" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane p-3" id="tab4" role="tabpanel">
                                        <div class="form-group row">
                                            <div class="col-md-12"> <!-- <googlemaps> -->
                                                <label for="googlemaps">Google Maps</label>
                                                <textarea name="googlemaps" class="form-control" cols="30" rows="7">{{$info->googlemaps}}</textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-12"> <!-- <scriptshead> -->
                                                <label for="scriptshead">Scripts do Cabeçalho</label>
                                                <textarea name="scriptshead" class="form-control" cols="30" rows="7">{{$info->scriptshead}}</textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-12"> <!-- <scriptsfoot> -->
                                                <label for="scriptsfoot">Scripts do Rodapé</label>
                                                <textarea name="scriptsfoot" class="form-control" cols="30" rows="7">{{$info->scriptsfoot}}</textarea>
                                            </div>
                                        </div>
                                    </div>--}}
                                </div>

		                        <hr>

		                        <div class="form-group row">
                                    <div class="col-md-12 text-right">
                                        <button class="btn btn-primary btn-lg"><i class="fas fa-save"></i> Salvar alterações</button>
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