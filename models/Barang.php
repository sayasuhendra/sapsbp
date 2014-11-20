<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class Barang extends Eloquent {

	protected $guarded = [];

	public $timestamps = false;

	protected $table = 'barang';

	protected $primaryKey = 'id_barang';
}