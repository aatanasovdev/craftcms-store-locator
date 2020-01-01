<?php

namespace aatanasov\storelocator\helpers;

class PluginHelper
{

    /**
     * Plugin handle name.
	 *
     * @var string
     */	
	private static $pluginHandleName = 'store-locator';

	/**
	 * Get plugin handle name.
	 *
	 * @return $pluginHandleName
	 */	
	static function getHandleName() 
	{	
		return self::$pluginHandleName;
	}	
}