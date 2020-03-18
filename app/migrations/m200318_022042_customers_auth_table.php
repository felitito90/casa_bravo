<?php

use yii\db\Migration;

/**
 * Class m200318_022042_customers_auth_table
 */
class m200318_022042_customers_auth_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute(file_get_contents(Yii::getAlias('@app/migrations/sql/m200318_022042.sql')));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200318_022042_customers_auth_table cannot be reverted.\n";

        return false;
    }
}
