<?php

namespace NpmWeb\MyAppName\Models;

use \NpmWeb\LaravelBase\Models\BaseModel;
use \Mail;

class Registration extends BaseModel {

	public static $rules = [
		'name' => ['required', 'max:20'],
	];

	protected $fillable = [
		'name'
	];

	const STATUS_CANCELLED = 9;

	public function updateStatus( $newStatus ) {

		$this->status = $newStatus;
		$this->save();
		Mail::send('emails.cancelled', array(), null);
		return true;
	}

}
