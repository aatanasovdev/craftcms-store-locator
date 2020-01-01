<?php
namespace aatanasov\storelocator\controllers;

use Craft;
use craft\web\Controller;
use craft\base\Element;
use craft\helpers\UrlHelper;

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
        return $this->renderTemplate(PluginHelper::handle() . '/dashboard/index');
    }

    /**
     * Load the stores edit admin page.
     * 
     * @param int|null
     * @return View
     */ 
    public function actionEdit(int $storeId = null, StoreElement $entry = null)
    {
        if(!empty($storeId)) {
            $entry = Craft::$app->getElements()->getElementById($storeId);
        }

        if(empty($entry)) {
            $entry = new StoreElement();
        }

        $variables['entry'] = $entry;
        $variables['title'] = PluginHelper::t('Stores');
        $variables['action'] = PluginHelper::handle() . '/stores/save';
        $variables['redirect'] = PluginHelper::handle() . '/';
        
        return $this->renderTemplate(PluginHelper::handle() . '/dashboard/edit', $variables);       
    }

    /**
     * Save a store.
     *
     * @return 
     */ 
    public function actionSave() 
    {   
        $request = Craft::$app->getRequest();

        if(!empty(Craft::$app->request->getBodyParam('entryId'))) {
            $entry = Craft::$app->getElements()->getElementById(Craft::$app->request->getBodyParam('entryId'));
        }

        if(empty($entry)) {
            $entry = new StoreElement();
        }

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