<?php namespace Library\Facades;

use Illuminate\Support\Facades\Facade;

class CryptRC4 extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'cryptrc4'; }

}