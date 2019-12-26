<?php
namespace aatanasov\storelocator;

use aatanasov\storelocator\models\Settings;
Use Craft;

class StoreLocator extends \craft\base\Plugin
{
	public $hasCpSettings = true;

    public function init()
    {
        parent::init();
    }

    protected function createSettingsModel()
    {
    	return new Settings();
    }

    protected function settingsHtml(): string
    {
        return Craft::$app->view->renderTemplate(
            'craftcms-store-locator/settings',
            [
                'settings' => $this->getSettings()
            ]
        );
    }
}