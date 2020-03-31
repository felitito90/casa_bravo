<?php

use yii\db\Migration;

/**
 * Class m200331_171135_sale_items_table
 */
class m200331_171135_sale_items_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute(file_get_contents(Yii::getAlias('@app/migrations/sql/m200331_171135.sql')));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200331_171135_sale_items_table cannot be reverted.\n";

        return false;
    }
}
