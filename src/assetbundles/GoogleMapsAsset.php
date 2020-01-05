<?php
namespace aatanasov\storelocator\assetbundles;

use Craft;
use aatanasov\storelocator\StoreLocator;
use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;

class GoogleMapsAsset extends AssetBundle
{
    public function init()
    {

        $apiKey = StoreLocator::getInstance()->getSettings()->googleApiKey;

        if(empty($apiKey)) {
            return;
        }

        $this->js = [
            '//maps.googleapis.com/maps/api/js?key=' . $apiKey,
        ];

        parent::init();
    }
}