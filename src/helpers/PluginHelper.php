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
    public static function t(string $message,array $params = [],string $language = null)
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

    /**
     * Set a notice.
     *
     * @param string $message
     * @return void
     */    
    public static function setNotice(string $message) 
    {    
        Craft::$app->getSession()->setNotice(Craft::t('store-locator', $message));
    }

    /**
     * Set an error message.
     *
     * @param string $message
     * @return void
     */    
    public static function setError(string $message) 
    {    
        Craft::$app->getSession()->setError(Craft::t('store-locator', $message));
    }    

}