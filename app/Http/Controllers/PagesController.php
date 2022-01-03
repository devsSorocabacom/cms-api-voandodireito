<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PagesRequest;
use Illuminate\Support\Facades\Session;

use App\Page;

class PagesController extends Controller
{
    public function index(Request $request)
    {
        if(!$request->user()->authorizeRoles(['1'])) {
            $title = "Acesso não autorizado";
            return view('cms.errors.401', compact('title'));
        }
        
        $pages = Page::all();
        $title = 'Listagem de Páginas';

        return view('cms.pages.index', compact('title', 'pages'));
    }

    public function edit(Request $request, $id)
    { 
        if(!$request->user()->authorizeRoles(['1'])) {
            $title = "Acesso não autorizado";
            return view('cms.errors.401', compact('title'));
        }
        
        $page = Page::findOrFail($id);
        $title = 'Editando: '.$page->title;
        return view('cms.pages.edit', compact('title', 'page'));
    }

    public function update(PagesRequest $request, $id)
    {
        $page = Page::findOrFail($id);
        $up = $request->all();

        $file_path = 'uploads/pages/';

        if ($request->hasFile('imghead')){
            //REMOVER imghead ANTIGA SE HOUVER
            if (!empty($page->imghead) && file_exists($file_path.$page->getOriginal('imghead'))){
                unlink( $file_path.$page->getOriginal('imghead') ); 
            }

            $file = $request->file('imghead');
            $file_name = time().'-'.str_replace(' ','',$file->getClientOriginalName());

            $file->move($file_path, $file_name);
            $up['imghead'] = $file_name;
        }

        if ($request->hasFile('imgfix')){
            //REMOVER imgfix ANTIGA SE HOUVER
            if (!empty($page->imgfix) && file_exists($file_path.$page->getOriginal('imgfix'))){
                unlink( $file_path.$page->getOriginal('imgfix') ); 
            }

            $file = $request->file('imgfix');
            $file_name = time().'-'.str_replace(' ','',$file->getClientOriginalName());

            $file->move($file_path, $file_name);
            $up['imgfix'] = $file_name;
        }

        $page->update($up);

        Session::flash('message', 'Editado com sucesso!');
        Session::flash('class', 'success');
        return redirect()->route('pages.edit', $id);
    }
}