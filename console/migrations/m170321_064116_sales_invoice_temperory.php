<?php

use yii\db\Migration;

class m170321_064116_sales_invoice_temperory extends Migration {

        public function up() {
                $tableOptions = null;
                if ($this->db->driverName === 'mysql') {
                        // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
                        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
                }


                $this->createTable('{{%sales_invoice_temp}}', [
                    'id' => $this->primaryKey(),
                    'item_code' => $this->string(50)->Null(),
                    'qty' => $this->integer()->Null(),
                    'rate' => $this->decimal(10, 2)->Null(),
                    'discount_percentage' => $this->decimal(10, 2)->Null(),
                    'discount_amount' => $this->decimal(10, 2)->Null(),
                    'tax' => $this->decimal(10, 2)->Null(),
                    'tax_id' => $this->decimal(10, 2)->Null(),
                    'line_total' => $this->decimal(10, 2)->Null(),
                    'status' => $this->smallInteger()->notNull()->defaultValue(1),
                    'CB' => $this->integer()->notNull(),
                    'UB' => $this->integer()->notNull(),
                    'DOC' => $this->dateTime(),
                    'DOU' => $this->timestamp(),
                        ], $tableOptions);
                $this->alterColumn('{{%sales_invoice_temp}}', 'id', $this->integer() . ' NOT NULL AUTO_INCREMENT');
        }

        public function down() {
                echo "m170321_064116_sales_invoice_temperory cannot be reverted.\n";

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
