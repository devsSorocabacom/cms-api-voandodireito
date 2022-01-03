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
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Tópicos</a></li>
                            <li class="breadcrumb-item active">{{$title}}</li>
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
                            <form action="{{route('topics.update', $topic->id)}}" method="POST" enctype="multipart/form-data">
	                    		{{ csrf_field() }}
                                <input type="hidden" name="_method" value="PUT" />{{ csrf_field() }}
	                    		
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="id_pai">Topico pai</label>
                                        <select name="id_pai" class="form-control">
                                            <option value="">--</option>
                                            @if(!empty($itens))
                                                @foreach($itens as $item)
                                                    <option value="{{$item->id}}" @if(old('id_pai',$topic->id_pai)==$item->id) selected @endif>{{$item->id}} - {{$item->title}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>                                     
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="title">Titulo</label>
                                        <input type="text" name="title" value="{{old('title',$topic->title)}}" class="form-control" />
                                    </div> 
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="subtitle">Sub-Titulo</label>
                                        <input type="text" name="subtitle" value="{{old('subtitle',$topic->subtitle)}}" class="form-control" />
                                    </div> 
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label for="text">Texto</label> 
                                        <textarea class="editor_texto" name="text">{{old('text',$topic->text)}}</textarea> 
                                    </div> 
                                </div>

                                <div class="form-group row">
                                    @if(!empty($topic->image))
                                    <div class="col-md-3">
                                        <img src="{{$topic->image}}" alt="" class="mb-3" width="100%" />
                                    </div>
                                    @endif
                                    <div class="col-md-12"> 
                                        <label for="image">Imagem</label>
                                        <input type="file" name="image" class="form-control" />
                                    </div>
                                </div>

		                        <hr>

		                        <div class="form-group row">
                                    <div class="col-md-12 text-right">
                                        <button class="btn btn-primary btn-lg"><i class="fas fa-save"></i> Salvar alterações</button>
                                        <a href="{{route('topics.index')}}" class="btn btn-danger btn-lg"><i class="fas fa-window-close"></i> Cancelar</a>
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