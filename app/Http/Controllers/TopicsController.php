<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TopicsRequest;
use Illuminate\Support\Facades\Session;
use App\Topic;

class TopicsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->user()->authorizeRoles(['1'])) {
            $itens = Topic::orderBy('id', 'ASC')->paginate(20);
            $itens_filtros = Topic::all();

            $title = "Listando Tópicos";
            return view('cms.topics.index', compact('title', 'itens', 'itens_filtros'));
        } else {
            $title = "Acesso não autorizado";
            return view('cms.errors.401', compact('title'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if($request->user()->authorizeRoles(['1'])) { 
            $itens = Topic::all();
            $title = "Novo tópico";

            return view('cms.topics.create', compact('title', 'itens'));
        } else {
            $title = "Acesso não autorizado";
            return view('cms.errors.401', compact('title'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TopicsRequest $request)
    { 
        $new = $request->all(); 

        if($request->hasFile('image')){
            $file = $request->file('image');
            $file_name = time().'-'.$file->getClientOriginalName(); 
            $file->move('uploads/', $file_name); 
            $new['image'] = $file_name; 
        } 

        Topic::create($new);

        Session::flash('message', 'Adicionado com sucesso!');
        Session::flash('class', 'success');
        return redirect()->route('topics.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        if(!$request->user()->authorizeRoles(['1'])) {
            $title = "Acesso não autorizado";
            return view('cms.errors.401', compact('title'));
        }         
        $topic = Topic::find($id);
        $itens = Topic::whereNotin('id',[$topic->id])->get();
        $title = "Editando tópico";
        return view('cms.topics.edit', compact('title','topic','itens'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $up = $request->all(); 

        if($request->hasFile('image')){
            $file = $request->file('image');
            $file_name = time().'-'.$file->getClientOriginalName(); 
            $file->move('uploads/', $file_name); 
            $up['image'] = $file_name; 
        } 

        $topic = Topic::find($id);

        $topic->update($up);
        Session::flash('message', 'Editado com sucesso!');
        Session::flash('class', 'success');
        return redirect()->route('topics.edit', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    { 
        if($request->user()->authorizeRoles(['1'])) {
            $topic = Topic::findOrFail($id);  
            $topic->delete();

            Session::flash('message', 'Removido com sucesso!');
            Session::flash('class', 'danger');
            return redirect()->route('topics.index'); 
        } else {
            $title = "Acesso não autorizado";
            return redirect('cms.errors.401', compact('title'));
        }
    }
}
