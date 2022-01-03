<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\InformacoesRequest;
use Illuminate\Support\Facades\Session;

use App\Info;

class InformacoesController extends Controller
{
    public function edit(Request $request, $id)
    {
        if(!$request->user()->authorizeRoles(['1'])) {
            $title = "Acesso não autorizado";
            return view('cms.errors.401', compact('title'));
        }

        $info = Info::findOrFail($id);
        $title = 'Editando: Informações ';

        return view('cms.informacoes.edit', compact('title', 'info'));
    }

    public function update(InformacoesRequest $request, $id)
    {
        $info = Info::findOrFail($id);
        $up = $request->all();

        $info->update($up);

        Session::flash('message', 'Editado com sucesso!');
        Session::flash('class', 'success');
        return redirect()->route('informacoes.edit', $id);
    }
}