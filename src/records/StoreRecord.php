<?php
namespace aatanasov\storelocator\records;

use craft\db\ActiveRecord;
use craft\records\Element;

use yii\db\ActiveQueryInterface;

class StoreRecord extends ActiveRecord
{
    /**
     * Define the database table name of the stores.
     *
     * @return string
     */      
    public static function tableName(): string
    {
        return '{{%storelocator}}';
    }

    /**
     * Get a store from the database.
     *
     * @return object
     */   
    public function getElement(): ActiveQueryInterface
    {
        return $this->hasOne(Element::class, ['id' => 'id']);
    }
}
