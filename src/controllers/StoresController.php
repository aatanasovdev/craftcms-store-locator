<?php
namespace aatanasov\storelocator\controllers;

use craft\web\Controller;

use aatanasov\storelocator\helpers\PluginHelper;

class StoresController extends Controller
{	
	/**
	 * Load the stores listing admin page.
	 *
	 * @return View
	 */	
	public function actionIndex() 
	{	
		return $this->renderTemplate(PluginHelper::getHandleName() . '/dashboard/index');
	}	
}