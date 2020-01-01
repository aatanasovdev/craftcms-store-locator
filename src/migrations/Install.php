<?php

namespace aatanasov\storelocator\migrations;

use Craft;
use craft\db\Migration;
use craft\helpers\MigrationHelper;

/**
 * Install migration.
 */
class Install extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createtables();
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTableIfExists('{{%storelocator}}');

        $this->delete('{{%elements}}', ['type' => 'aatanasov\storelocator\elements\Store']);
    }

    /**
     * Create tables required by the plugin.
     *
     * @return void
     */    
    protected function createtables() 
    {    
        $this->createTable('{{%storelocator}}', [
            'id' => $this->primaryKey(),
            'address' => $this->string(),
            'dateCreated' => $this->dateTime()->notNull(),
            'dateUpdated' => $this->dateTime()->notNull(),
            'uid' => $this->uid(),            
        ]);

        $this->addForeignKey(null, '{{%storelocator}}', ['id'], '{{%elements}}', ['id'], 'CASCADE', null);
    }    
}
