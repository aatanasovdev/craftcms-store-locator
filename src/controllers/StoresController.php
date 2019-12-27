<?php
namespace aatanasov\storelocator\controllers;

use craft\web\Controller;

use aatanasov\storelocator\helpers\PluginHelper;
use aatanasov\storelocator\models\Store;

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

	/**
	 * Load the stores edit admin page.
	 *
	 * @return View
	 */	
	public function actionEdit(int $storeId = null, Store $store = null)
	{	
		$variables['title'] = 'Add Store';
		$variables['action'] = PluginHelper::getHandleName() . '/stores/save';
		$variables['redirect'] = PluginHelper::getHandleName() . '/';
		$variables['entry']['title'] = '';

		if($storeId) {
			$variables['entry']['title'] = 'Test';
			$variables['title'] = 'Edit Store';
		}

		return $this->renderTemplate(PluginHelper::getHandleName() . '/dashboard/edit', $variables);		
	}	
}