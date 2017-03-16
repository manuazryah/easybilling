<?php

use yii\db\Migration;

class m170316_044513_item_master extends Migration
{
    public function up() {
                $tableOptions = null;
                if ($this->db->driverName === 'mysql') {
                        // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
                        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
                }

                $this->createTable('{{%item_master}}', [
                    'id' => $this->primaryKey(),
                    'SKU' => $this->string(30)->notNull(),
                    'item_name' => $this->string(30)->notNull(),
                    'item_type' => $this->integer()->notNull(),
                    'tax_id' => $this->integer()->notNull(),
                    'base_unit_id' => $this->integer()->notNull(),
                    'MRP' => $this->decimal(10,2)->Null(),
                    'retail_price' => $this->decimal(10,2)->Null(),
                    'purchase_prce' => $this->decimal(10,2)->Null(),
                    'item_cost' => $this->decimal(10,2)->Null(),
                    'status' => $this->smallInteger()->notNull()->defaultValue(0),
                    'CB' => $this->integer()->notNull(),
                    'UB' => $this->integer()->notNull(),
                    'DOC' => $this->dateTime(),
                    'DOU' => $this->timestamp(),
                        ], $tableOptions);
                $this->alterColumn('{{%item_master}}', 'id', $this->integer() . ' NOT NULL AUTO_INCREMENT');

                $this->createIndex('tax', 'item_master', 'tax_id', false);
                $this->createIndex('base', 'item_master', 'base_unit_id', false);
                $this->addForeignKey("tax", "item_master", "tax_id", "tax", "id", "RESTRICT", "RESTRICT");
                $this->addForeignKey("base", "item_master", "base_unit_id", "base_unit", "id", "RESTRICT", "RESTRICT");
        }

    public function down()
    {
        echo "m170316_044513_item_master cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
