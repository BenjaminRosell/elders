<?php namespace Beinir\Builder;

use Illuminate\Support\Facades\Config as Config;
use Illuminate\Support\Facades\Lang as Lang;
use Illuminate\Support\Facades\App as App;
use Illuminate\Support\Facades\Request as Request;
use Illuminate\Support\Facades\Route as Route;

class Builder implements BuilderInterface
{

	public $routes;

	public $locale;

    protected $languages = array('fr', 'en');

	public function __construct()
    {
        $this->routes = self::getRoutes();
    }

    public function activate(){
        //Defining the site structure !
        $uriSegments = Request::segments();

        $found = false;

        if ($uriSegments){

            foreach($this->languages as $language) {

                $routes = Lang::get('routes', array(), $language);

                if (array_key_exists($uriSegments[0], $routes)) {
                    $request = $routes[$uriSegments[0]];
                    $this->setLocale($language);
                    $found = true;
                    break;
                }
            }

            if ($found) {
                $type = $request['type'] ? $request['type'] : 'resource';
                $controller = $request['route'];

                if ($request['beforeFilter']){
                    Route::$type($uriSegments[0], $controller, array('before' => $request['beforeFilter']));
                } else {
                    Route::$type($uriSegments[0], $controller);
                }
            }

        }
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

    public function setLocale($language) 
    {
        App::setLocale($language);
        return true;
    }
    
    public static function getRoutes() 
    {
    	return Lang::get('routes');
    }
}