<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';

	public function comment()
	{
		return $this->belongsTo('App\Post');
    }

}
