<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model
{
    public $timestamps = false;
    protected $table = 'users_groups';

    public function users_groups()
	{
		// return $this->hasMany('User')
		// 			->hasMany('Group');
	}
}
