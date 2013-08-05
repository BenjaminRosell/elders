<?php namespace Beinir\Builder;

use Illuminate\Support\Facades\Facade;

class BuilderFacade extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'Beinir\Builder\BuilderInterface'; }

}