<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResultItem extends Model
{
    protected $table = 'results_itens';

    protected $fillable = [
        'result_id', 'topic_id', 'title', 'text'
	];

    public function result()
    {
        return $this->belongsTo('App\Result', 'result_id');
    }

    public function topic()
    {
        return $this->belongsTo('App\Topic', 'topic_id');
    }
}
