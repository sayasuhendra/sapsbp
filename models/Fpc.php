<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class Fpc extends Eloquent {

	protected $guarded = [];

	public $timestamps = false;

	protected $table = 'fpc_tb';

	protected $primaryKey = 'id_fpc';
	
}