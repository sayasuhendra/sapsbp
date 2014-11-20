<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class Instal extends Eloquent {

	protected $guarded = [];

	public $timestamps = false;

	protected $table = 'instal_im';

	protected $primaryKey = 'id_imin';
	
}