<?php

namespace aatanasov\storelocator\helpers;

use Craft;

class PluginHelper
{
    /**
     * Plugin handle name.
	 *
     * @cons string
     */	
	CONST HANDLE = 'store-locator';

	/**
	 * Translate a given string.
	 *
     * @param $message
     * @param array $params
     * @param null $language
     *
	 * @return $pluginHandleName
     * @see Craft::t()
     */
    public static function t($message, $params = [], $language = null)
    {
        return Craft::t(self::HANDLE, $message, $params, $language);
    }

    /**
     * Get the handle name
     *
     * @return string
     */	
    public static function handle() 
    {	
    	return self::HANDLE;
    }	
}