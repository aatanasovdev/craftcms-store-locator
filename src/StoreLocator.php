<?php
namespace aatanasov\storelocator;

Use Craft;

use aatanasov\storelocator\services\Routes;
use aatanasov\storelocator\models\Settings;
use aatanasov\storelocator\helpers\PluginHelper;
use aatanasov\storelocator\Store;

use craft\services\Elements;
use craft\events\RegisterUrlRulesEvent;
use craft\web\UrlManager;

use yii\base\Event;

class StoreLocator extends \craft\base\Plugin
{
    public $hasCpSettings = true;
    public $hasCpSection = true;

    public function init()
    {
        parent::init();

        $this->_registerDashboardRoutes();

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
            PluginHelper::getHandleName() . '/dashboard/settings',
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
                $handleName = PluginHelper::getHandleName();

                $event->rules[$handleName] = $handleName . '/stores/index';
            }
        );        
    }    
}