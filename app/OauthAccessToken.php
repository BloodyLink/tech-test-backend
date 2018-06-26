<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OauthAccessToken extends Model
{
    protected $fillable = [
        'id', 'user_id', 'client_id', 'name', 'scopes', 'revoked'
    ];

    protected $dates = [
        'created_at', 'updated_at', 'expires_at'
    ];

    public function User(){
        return $this->belongsTo('\App\User');
    }
}
