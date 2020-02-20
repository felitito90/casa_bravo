<?php

use yii\db\Migration;

/**
 * Class m200203_021911_crear_tabla_sales
 */
class m200203_021911_crear_tabla_sales extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->execute(file_get_contents(Yii::getAlias('@app/migrations/sql/m200203_021911.sql')));

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200203_021911_crear_tabla_sales cannot be reverted.\n";

        return false;
    }

}
