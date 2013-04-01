<?php namespace Beinir\Builder;

use Illuminate\Support\Facades\Config as Config;
use Illuminate\Support\Facades\Lang as Lang;

class Builder implements BuilderInterface
{

	public $routes;

	public $locale;

	public function __construct($routes)
    {
        $this->routes = self::getRoutes();
    }

    public static function linkTo($target, $anchorText = 'Link', array $attributes = array()) 
    {
    	$locale = self::getLocale();

    	$routes = self::getRoutes();

    	if (isset($routes[$target])) {

    		$linkTarget = $routes[$target];

    		return self::buildLink($linkTarget, $anchorText, $attributes);

    	}

    	return false;

    }

    public static function buildLink($target, $anchorText, array $attributes)
    {
    	$link = '<a href="'. $target. '" ';

		foreach ($attributes as $attribute => $value){
			$link .= "$attribute=\"$value\" "; 
		}

		$link .='>'. $anchorText. '</a>';

		return $link;
    }

    public static function getLocale() 
    {
    	return Config::get('app.locale');
    }

    public static function getRoutes() 
    {
    	return Lang::get('routes');
    }
}