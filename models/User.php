<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class User extends Eloquent {

	protected $guarded = [];

	public $timestamps = false;

	protected $table = 'usr_tb';

	protected $primaryKey = 'usrid';
	
}