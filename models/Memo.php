<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class Memo extends Eloquent {

	protected $guarded = [];

	public $timestamps = false;

	protected $table = 'internal_memo';
	
	protected $primaryKey = 'idmemo';
}