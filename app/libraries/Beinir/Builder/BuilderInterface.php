<?php namespace Beinir\Builder;

interface BuilderInterface 
{
	public function linkTo($request, $anchorText, array $attributes);

	public function buildLink($target, $anchorText, array $attributes);

	public function getLocale();
	
	public function getRoutes();
}