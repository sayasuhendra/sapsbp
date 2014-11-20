<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class Vendor extends Eloquent {

	protected $guarded = [];

	public $timestamps = false;

	protected $table = 'vendor_tb';

	protected $primaryKey = 'id_vendor';
	
}