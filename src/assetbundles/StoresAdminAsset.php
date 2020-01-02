<?php
namespace aatanasov\storelocator\assetbundles;

use Craft;
use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;

class StoresAdminAsset extends AssetBundle
{
    public function init()
    {
        $this->sourcePath = "@aatanasov/storelocator/resources/admin/dist";

        $this->depends = [
            CpAsset::class,
        ];

        $this->css = [
            'bundle.css',
        ];

        $this->js = [
            'bundle.js',
        ];

        parent::init();
    }
}
