<?php namespace Beinir\Builder;

interface BuilderInterface 
{
	public static function linkTo($request, $anchorText, array $attributes);

	public static function buildLink($target, $anchorText, array $attributes);

	public static function getLocale();
	
	public static function getRoutes();
}