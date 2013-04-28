<?php namespace Services\Validation;

abstract class Validation
{
	protected $attributes;

	public $errors;

	public function __construct($attributes = null) {
		$this->attributes = $attributes ?: \Input::all();
	}

	public function passes()
	{
		$validation = \Validator::make($this->attributes, static::$rules);

		if ($validation->passes()) return true;

		$this->errors = $validation->messages();

		return false;

	}
}