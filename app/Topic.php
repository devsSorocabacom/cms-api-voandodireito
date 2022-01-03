<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $table = 'topics';

    protected $fillable = [
        'id_pai', 'title', 'subtitle', 'text', 'image', 
	];

    public function getImageAttribute($value) {
        if($value) {
            return url('/').'/uploads/'.$value;
        }
    }
}
