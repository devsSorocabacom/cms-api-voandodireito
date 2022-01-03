<table>
    <thead>
    <tr>
        <th>Name</th>
        <th>WhatsApp</th>
        <th>Email</th>
        <th>Topicos</th>
    </tr>
    </thead>

    <tbody>

        @foreach($results as $key => $rest){
             
            <tr>
                <td>    {{ $rest->name  }}  </td>
                <td>    {{ $rest->phone }}  </td>
                <td>    {{ $rest->email }}  </td> 
                @foreach($rest->itens()->get() as $item)
                <td>    {!! $item->title !!}  @if(!empty($item->text)) <br/> {!!$item->text!!} @endif </td>  
                @endforeach
            </tr>

        @endforeach 
        
    </tbody>

</table>