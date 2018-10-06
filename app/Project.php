<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//
use Auth;
// use Illuminate\Database\Eloquent\SoftDeletes;


class Project extends Model
{
    // use SoftDeletes; // 
	// protected $dates = ['deleted_at'];
	protected $fillable = [
		'title', 'slug','opened_at', 'closed_at', 'description', 'project_price','slot', 'user_id', 'project_image', 'slot_price',
    ];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function transactions()
    {
        return $this->belongsTo('App\Transaction');
    }

    public function slots()
    {
        return $this->belongsTo('App\Slot');
    }

    public function isOwner()
	{
        if (Auth::guest())
            return false;
        
		return Auth::user()->id == $this->user->id;
	}
}
