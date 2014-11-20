<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class Customer extends Eloquent {

	protected $guarded = [];

	public $timestamps = false;

	protected $table = 'customer_new';

	protected $primaryKey = 'cirid';
	
}