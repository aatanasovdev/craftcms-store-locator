<?php
namespace aatanasov\storelocator;

Use Craft;
use aatanasov\storelocator\models\Settings;
use aatanasov\storelocator\Store;
use craft\services\Elements;
use craft\events\RegisterComponentTypesEvent;
use yii\base\Event;

class StoreLocator extends \craft\base\Plugin
{
    public $hasCpSettings = true;
    public $hasCpSection = true;

    public function init()
    {
        parent::init();
    }

    protected function createSettingsModel()
    {
    	return new Settings();
    }

    protected function settingsHtml()
    {
        return Craft::$app->view->renderTemplate(
            'craftcms-store-locator/settings',
            [
                'settings' => $this->getSettings()
            ]
        );
    }  
}