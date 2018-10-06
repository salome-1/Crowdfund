<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{

	protected $fillable = [
	       'user_id' ,'topup_id', 'slot_id', 'project_id', 'transaction_type', 'deposit', 'credit', 'status', 'nominal', 'transaction_image'
	];

	public function user()
	{
		return $this->belongsTo('App\User');
	}

	public function topup()
	{
		return $this->belongsTo('App\Topup');
	}

	public function slot()
	{
		return $this->belongsTo('App\Slot');
	}

	public function projects()
	{
	  return $this->belongsTo('App\Project');
	}
}
