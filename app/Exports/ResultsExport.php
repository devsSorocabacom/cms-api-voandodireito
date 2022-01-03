<?php

namespace App\Exports;

use App\Result;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ResultsExport implements FromView
{
    public function view(): View
    { 
        return view('exports.results', [
            'results' => Result::all()
        ]);
    }
}