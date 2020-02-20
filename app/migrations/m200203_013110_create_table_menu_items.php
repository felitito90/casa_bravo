<?php

use yii\db\Migration;

/**
 * Class m200203_013110_create_table_menu_items
 */
class m200203_013110_create_table_menu_items extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute(file_get_contents(Yii::getAlias('@app/migrations/sql/m200203_013110.sql')));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200203_013110_create_table_menu_items cannot be reverted.\n";

        return false;
    }
}
