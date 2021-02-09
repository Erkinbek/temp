<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%data}}`.
 */
class m210209_094249_create_data_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%data}}', [
            'id' => $this->primaryKey(),
	        'articule' => $this->string(255),
	        'name' => $this->string(255),
	        'balance' => $this->float(),
	        'unit' => $this->string(55)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%data}}');
    }
}
