<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $table = 'results';

    protected $fillable = [
        'name', 'phone', 'email', 
	];

    public function itens()
    {
        return $this->hasMany('App\ResultItem', 'result_id');
    }
}
