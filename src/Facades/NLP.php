<?php

namespace Web64\LaravelNlp\Facades;

use Illuminate\Support\Facades\Facade;

class NLP  extends Facade
{
	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor() { return 'Web64\LaravelNlp\LaravelNlp'; }
}