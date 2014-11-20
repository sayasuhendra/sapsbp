<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class Report extends Eloquent {

	protected $guarded = [];

	public $timestamps = false;

	protected $table = 'report_pro';

	protected $primaryKey = 'idreport';
}