<?php

use yii\db\Migration;

/**
 * Class m200408_183531_table_auth
 */
class m200408_183531_table_auth extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute(file_get_contents(Yii::getAlias('@app/migrations/sql/m200408_183531.sql')));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200408_183531_table_auth cannot be reverted.\n";

        return false;
    }
}
