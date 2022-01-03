<table class="table table-bordered">
    <tr>
        <th>Tópicos</th> 
    </tr>
    @foreach($itens as $item)
    <tr>
        <th>{{$item->title}} @if(!empty($item->text)) <br/> {!! $item->text !!} @endif </th> 
    </tr>
    @endforeach
</table>