<?php

use yii\db\Migration;

/**
 * Class m200425_212603_sales_dlt_values
 */
class m200425_212603_sales_dlt_values extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute(file_get_contents(Yii::getAlias('@app/migrations/sql/m200425_212603.sql')));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200425_212603_sales_dlt_values cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200425_212603_sales_dlt_values cannot be reverted.\n";

        return false;
    }
    */
}
