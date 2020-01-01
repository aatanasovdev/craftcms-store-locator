<?php
namespace aatanasov\storelocator\controllers;

use Craft;
use craft\web\Controller;
use craft\base\Element;

use aatanasov\storelocator\helpers\PluginHelper;
use aatanasov\storelocator\elements\Store as StoreElement;

class StoresController extends Controller
{	
    public function init()
    {
        parent::init();
    }

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
	 * @param int|null
	 * @return View
	 */	
	public function actionEdit(StoreElement $entry = null)
	{	
		$variables['entry'] = $entry;

		if(empty($variables['entry'])) {
			$variables['entry'] = new StoreElement();
		}

		$variables['request'] = Craft::$app->getRequest();

		$variables['title'] = 'Stores';
		$variables['action'] = PluginHelper::getHandleName() . '/stores/save';
		$variables['redirect'] = PluginHelper::getHandleName() . '/';
		
		return $this->renderTemplate(PluginHelper::getHandleName() . '/dashboard/edit', $variables);		
	}

	/**
	 * Save a store.
	 *
	 * @return 
	 */	
	public function actionSave() 
	{	
		$request = Craft::$app->getRequest();

		$entry = new StoreElement();

		$entry->address = Craft::$app->request->getBodyParam('address');
		$entry->title = Craft::$app->request->getBodyParam('title');
		
		$entry->setFieldValuesFromRequest('fields');

		if (!Craft::$app->elements->saveElement($entry)) {

            Craft::$app->getSession()->setError(Craft::t('store-locator', 'Couldn’t save store.'));

            Craft::$app->getUrlManager()->setRouteParams([
                'entry' => $entry
            ]);

            return null;
		}		

		return $this->redirectToPostedUrl($entry);
	}
}