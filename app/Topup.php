<?php

namespace App;

use Auth;
use Hootlex\Moderation\Moderatable;
use Illuminate\Database\Eloquent\Model;

class Topup extends Model
{
	use Moderatable;

	protected $fillable = [
	       'username' ,'user_name', 'nominal', 'bank', 'user_id', 'proof_image',
	];

	public function users()
	{
	  return $this->belongsTo('App\User');
	}

	public function transactions()
	{
		return $this->belongsTo('App\User');
	}


	public function isOwner()
	{
        if (Auth::guest())
            return false;
        
		return Auth::user()->id == $this->user->id;
	}
}
