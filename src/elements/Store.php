<?php
namespace aatanasov\storelocator\elements;

use Craft;
use craft\base\Element;
use craft\elements\db\ElementQueryInterface;

use aatanasov\storelocator\records\StoreRecord;
use aatanasov\storelocator\elements\db\StoreQuery;

class Store extends Element
{
    /**
     * The id of the store.
     *
     * @var int
     */
    public $id;

    /**
     * The address of the store.
     *
     * @var string
     */
    public $address;    

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
    public static function refHandle()
    {
        return 'store';
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
     * Define the main tabs of the index stores admin page.
     *
     * @param string $content
     * @return StoreQuery
     */  
    public static function find(): ElementQueryInterface
    {
        return new StoreQuery(static::class);
    }

    /**
     * Set the rules to the element fields.
     *
     * @return array
     */     
    public function rules()
    {
        $rules = parent::rules();

        $rules[] = [['address'], 'required'];

        return $rules;
    }    

    /**
     * Define the main tabs of the index stores admin page.
     *
     * @param string $content
     * @return array
     */       
    protected static function defineSources(string $context = null): array
    {
        return [
            [
                'key' => '*',
                'label' => Craft::t('store-locator', 'All Stores'),
                'criteria' => []
            ]
        ];
    }    

    /**
     * @inheritdoc
     */
    public function beforeSave(bool $isNew): bool
    {
        return parent::beforeSave($isNew);
    }

    /**
     * Set the table attributes of the index page.
     *
     * @return array
     */     
    protected static function defineTableAttributes(): array
    {
        return [
            'title' => ['label' => Craft::t('store-locator', 'Title')],
            'address' => ['label' => Craft::t('store-locator', 'Address')],
        ];
    }

    /**
     * Set the default table attributes of the index page.
     *
     * @return array
     */     
    protected static function defineDefaultTableAttributes(string $source): array
    {
        return [
            'title',
            'address',
        ];
    }    

    /**
     * Add a record to the custom element database table.
     *
     * @param bool $isNew
     * @return trigger afterSave Element event
     */ 
    public function afterSave(bool $isNew)
    {
        $record = new StoreRecord();
        $record->id = $this->id;
        $record->address = $this->address;

        $record->save();

        return parent::afterSave($isNew);         
    }
}