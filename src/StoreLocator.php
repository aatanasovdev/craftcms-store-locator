<?php
namespace aatanasov\storelocator;

Use Craft;

use aatanasov\storelocator\services\Routes;
use aatanasov\storelocator\models\Settings;
use aatanasov\storelocator\helpers\PluginHelper;
use aatanasov\storelocator\Store;
use aatanasov\storelocator\elements\Store as StoreElement;

use craft\events\RegisterUrlRulesEvent;
use craft\events\RegisterComponentTypesEvent;
use craft\web\UrlManager;
use craft\services\Elements;
use craft\services\Fields;

use yii\base\Event;

class StoreLocator extends \craft\base\Plugin
{

    /**
     * Enable the settings panel on the dashboard.
     *
     * @var bool
     */      
    public $hasCpSettings = true;

    /**
     * Enable the custom stores section panel on the dashboard.
     *
     * @var bool
     */          
    public $hasCpSection = true;

    public function init()
    {
        parent::init();

        $this->_registerDashboardRoutes();
        $this->_registerElementTypes();
    }
    /**
     * Enable the plugin settings on the dashboard.
     *
     * @return Settings
     */    
    protected function createSettingsModel()
    {
    	return new Settings();
    }

    /**
     * Register the HTML template of the settings dashboard page.
     *
     * @return View
     */        
    protected function settingsHtml()
    {
        return Craft::$app->view->renderTemplate(
            PluginHelper::handle() . '/dashboard/settings',
            [
                'settings' => $this->getSettings()
            ]
        );
    }

    /**
     * Register the routes responsible for the plugin dashboard pages.
     *
     * @return void
     */    
    private function _registerDashboardRoutes() 
    {            
        Event::on(
            UrlManager::class,
            UrlManager::EVENT_REGISTER_CP_URL_RULES,
            function(RegisterUrlRulesEvent $event) {
                $handle = PluginHelper::handle();

                $event->rules[$handle] = $handle . '/stores/index';
                $event->rules[$handle . '/stores/new'] = $handle . '/stores/edit';
                $event->rules[$handle . '/stores/delete'] = $handle . '/stores/delete';
                $event->rules[$handle . '/stores/<storeId:\d+>'] = $handle . '/stores/edit';
            }
        );        
    }    

    /**
     * Register the custom Stores element type.
     *
     * @return void
     */ 
    private function _registerElementTypes()
    {        
        Event::on(Elements::class, Elements::EVENT_REGISTER_ELEMENT_TYPES, function(RegisterComponentTypesEvent $e) {
            $e->types[] = StoreElement::class;
        });
    }
}