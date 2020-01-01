<?php
namespace aatanasov\storelocator\fields;

use Craft;
use aatanasov\storelocator\elements\Store;

class Store extends BaseRelationField
{
    /**
     * @inheritdoc
     */
    public static function displayName(): string
    {
        return Craft::t('store-locator', 'Store');
    }

    /**
     * @inheritdoc
     */
    protected static function elementType(): string
    {
        return Store::class;
    }

    /**
     * @inheritdoc
     */
    public static function defaultSelectionLabel(): string
    {
        return Craft::t('store-locator', 'Add a store');
    }
}
