<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Topic;
use App\Info;

class PagesController extends Controller
{
    public function home(Request $request){
        $informacoes = Info::find(1);
        $topics = Topic::all();
        $compact = compact('topics','informacoes');
        return response()->json($compact, 200);
    }
}
