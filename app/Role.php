<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name'
    ];

    protected $dates = [
        'created_at',
        'modified_at',
        'deleted_at'
    ];

    protected function user () {
        return $this->belongsTo('App\User');
    }
}
