<?php
namespace aatanasov\storelocator\models;

use craft\base\Model;

class Settings extends Model
{
    /**
     * The Google API key reuqired for Google Maps.
	 *
     * @var string
     */		
	public $googleApiKey = '';

    /**
     * Set the Settings rules.
     *
     * @return array
     */  
    public function rules()
    {
        return [
            [['googleApiKey'], 'required'],
        ];
    }
}