<?php

use yii\db\Migration;

/**
 * Class m200327_144447_menu_item_type
 */
class m200327_144447_menu_item_type extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute(file_get_contents(Yii::getAlias('@app/migrations/sql/m200327_144447.sql')));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200327_144447_menu_item_type cannot be reverted.\n";

        return false;
    }
}
