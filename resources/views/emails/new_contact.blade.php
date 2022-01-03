@component('mail::message')
# Olá,

Você recebeu um novo contato do site {{env('APP_NAME')}}
  
<br/>

Os dados são:

Nome: {{ $data['name'] }}

WhatsApp: {{ $data['phone'] }}

Email: {{ $data['email'] }}

<br/>

Acesse o painel para verificar todos detalhes

@component('mail::button', ['url' => route('dashboard')])
Acessar painel
@endcomponent


@endcomponent
