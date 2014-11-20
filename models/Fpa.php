<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class Fpa extends Eloquent {

	protected $guarded = [];

	public $timestamps = false;

	protected $table = 'fpa_tb';

	protected $primaryKey = 'idfpa';
	
}