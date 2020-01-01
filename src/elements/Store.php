<?php
namespace aatanasov\storelocator\elements;

use Craft;
use craft\base\Element;
use craft\elements\db\ElementQueryInterface;
use craft\helpers\UrlHelper;

use yii\base\Exception;

use aatanasov\storelocator\records\StoreRecord;
use aatanasov\storelocator\elements\db\StoreQuery;
use aatanasov\storelocator\helpers\PluginHelper;

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
     * Get element by ID from a request.
     *
     * @return Element
     */    
    public static function getRequestEntry() 
    {    
        if(!empty(Craft::$app->request->getBodyParam('entryId'))) {
            return Craft::$app->getElements()->getElementById(Craft::$app->request->getBodyParam('entryId'));
        }

        return;
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
                'label' => PluginHelper::t('All Stores'),
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
            'title' => ['label' => PluginHelper::t('Title')],
            'address' => ['label' => PluginHelper::t('Address')],
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
     * Add and save a record to the custom element database table.
     *
     * @param bool $isNew
     * @return trigger afterSave Element event
     */ 
    public function afterSave(bool $isNew)
    {
        if (!$isNew) {
            $record = StoreRecord::findOne($this->id);

            if (!$record) {
                throw new Exception('Invalid product ID: ' . $this->id);
            }
        }

        if(empty($record)) {
            $record = new StoreRecord();
            $record->id = $this->id;            
        }

        $record->address = $this->address;
        $record->save();

        return parent::afterSave($isNew);         
    }

    /**
     * @inheritdoc
     */
    public function getCpEditUrl(): string
    {
        return UrlHelper::cpUrl(PluginHelper::handle() . '/stores/' . $this->id);
    }    
}