<?php
namespace aatanasov\storelocator\models;

use craft\base\Model;

class Store extends Model
{
	public $id = '';

    public function rules()
    {
        return [
            [['id'], 'required'],
        ];
    }
}