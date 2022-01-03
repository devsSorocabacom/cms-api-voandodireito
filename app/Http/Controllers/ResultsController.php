<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Exports\ResultsExport;
use App\Result;
use App\ResultItem;

use Excel;
use Session;

class ResultsController extends Controller
{    
    public function index(Request $request)
    {
        if($request->user()->authorizeRoles(['1'])) {
            $itens = Result::orderBy('id', 'ASC')->paginate(20);  
            $title = "Listando Resultados";
            return view('cms.results.index', compact('title', 'itens'));
        } else {
            $title = "Acesso não autorizado";
            return view('cms.errors.401', compact('title'));
        }
    }

    public function show(Request $request)
    { 
        $result = Result::find($request->result_id); 
        $data = [];
        $data["itens"] = $result->itens()->get();
        return view("cms.results.modal",$data);
    }
  
    public function destroy(Request $request, $id)
    { 
        if($request->user()->authorizeRoles(['1'])) {
            $result = Result::findOrFail($id);  
            $result->itens()->delete();
            $result->delete();

            Session::flash('message', 'Removido com sucesso!');
            Session::flash('class', 'danger');
            return redirect()->route('results.index'); 
        } else {
            $title = "Acesso não autorizado";
            return redirect('cms.errors.401', compact('title'));
        }
    }

    public function generateResultsToExcel(){
        return Excel::download(new ResultsExport, 'results.xlsx');
    }

    public function destroyAll(Request $request)
    { 
        if($request->user()->authorizeRoles(['1'])) {
            
            try {
                Result::truncate();
                ResultItem::truncate();
                $status = true;
            } catch (\Throwable $th) {
                $status = false; 
            }
            
            return response()->json(['status'=>$status]); 
        } else {
            $title = "Acesso não autorizado";
            return redirect('cms.errors.401', compact('title'));
        }
    }
}
