<?php
namespace aatanasov\storelocator\elements;

use craft\base\Element;

class Store extends Element
{
    /**
     * @inheritdoc
     */
    public static function displayName(): string
    {
        return 'Store';
    }

    /**
     * @inheritdoc
     */
    public static function pluralDisplayName(): string
    {
        return 'Stores';
    }

    /**
     * @inheritdoc
     */
    public static function hasContent(): bool
    {
        return true;
    }
    /**
     * @inheritdoc
     */
    public static function hasTitles(): bool
    {
        return true;
    }
    /**
     * @inheritdoc
     */
    public static function hasUris(): bool
    {
        return true;
    }
    /**
     * @inheritdoc
     */
    public static function isLocalized(): bool
    {
        return true;
    }    
}