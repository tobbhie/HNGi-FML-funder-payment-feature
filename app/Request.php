<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
	protected $table = 'requests';
	
	protected $fillable = ['user_id','title','description','photoURL','currency','amount','isFunded','isSuspended','isActive'];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function transaction(){
        return $this->hasMany('App\Request');
    }

}
