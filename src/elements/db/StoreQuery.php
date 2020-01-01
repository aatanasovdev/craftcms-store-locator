<?php
namespace aatanasov\storelocator\elements\db;

use craft\db\Query;
use craft\elements\db\ElementQuery;
use craft\helpers\Db;
use aatanasov\storelocator\elements\Store;

class StoreQuery extends ElementQuery
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
     * Set the address of the store.
     *
     * @param string $value
     * @return this
     */         
    public function address($value)
    {
        $this->address = $value;

        return $this;
    }      

    /**
     * Prepares the custom fields of the store.
     *
     * @return bool
     */  
    protected function beforePrepare(): bool
    {
        $this->joinElementTable('storelocator');

        $this->query->select([
            'storelocator.address'
        ]);        

        if ($this->address) {
            $this->subQuery->andWhere(Db::parseParam('storelocator.address', $this->address));
        }        

        return parent::beforePrepare();
    }    
}