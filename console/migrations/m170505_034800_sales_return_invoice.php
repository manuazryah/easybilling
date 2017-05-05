<?php

use yii\db\Migration;

class m170505_034800_sales_return_invoice extends Migration
{
    public function up() {
                $tableOptions = null;
                if ($this->db->driverName === 'mysql') {
                        // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
                        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
                }

                $this->createTable('{{%sales_return_invoice_master}}', [
                    'id' => $this->primaryKey(),
                    'sales_invoice_number' => $this->string(50)->Null(),
                    'sales_invoice_date' => $this->dateTime(),
                    'order_type' => $this->Integer()->Null(),
                    'busines_partner_code' => $this->string(15)->Null(),
                    'salesman' => $this->string(30)->Null(),
                    'payment_terms' => $this->string(30)->Null(),
                    'delivery_terms' => $this->string(30)->Null(),
                    'amount' => $this->decimal(10,2)->Null(),
                    'tax_amount' => $this->decimal(10,2)->Null(),
                    'order_amount' => $this->decimal(10,2)->Null(),
                    'ship_to_adress' => $this->string(50)->Null(),
                    'card_amount' => $this->decimal(10,2)->Null(),
                    'cash_amount' => $this->decimal(10,2)->Null(),
                    'round_of_amount' => $this->decimal(10,2)->Null(),
                    'amount_payed' => $this->decimal(10,2)->Null(),
                    'due_amount' => $this->decimal(10,2)->Null(),
                     'payment_status' => $this->Integer()->Null(),
                    'reference' => $this->string(50)->Null(),
                    'error_message' => $this->string(50)->Null(),
                    'status' => $this->smallInteger()->notNull()->defaultValue(0),
                    'CB' => $this->integer()->notNull(),
                    'UB' => $this->integer()->notNull(),
                    'DOC' => $this->dateTime(),
                    'DOU' => $this->timestamp(),
                        ], $tableOptions);
                $this->alterColumn('{{%sales_return_invoice_master}}', 'id', $this->integer() . ' NOT NULL AUTO_INCREMENT');

                $this->createTable('{{%sales_return_invoice_details}}', [
                    'id' => $this->primaryKey(),
                    'sales_invoice_master_id' => $this->integer()->notNull(),
                    'sales_invoice_number' => $this->string(50)->Null(),
                    'sales_invoice_date' => $this->dateTime(),
                    'busines_partner_code' => $this->string(15)->Null(),
                    'item_code' => $this->string(30)->Null(),
                    'item_name' => $this->string(30)->Null(),
                    'base_unit' => $this->integer()->Null(),
                    'qty' => $this->integer()->Null(),
                    'rate' => $this->decimal(10,2)->Null(),
                    'amount' => $this->decimal(10,2)->Null(),
                    'discount_percentage' => $this->string(30)->Null(),
                    'discount_amount' => $this->decimal(10,2)->Null(),
                    'net_amount' => $this->decimal(10,2)->Null(),
                    'tax_id' => $this->integer()->Null(),
                    'tax_percentage' => $this->string(30)->Null(),
                    'tax_amount' => $this->decimal(10,2)->Null(),
                    'line_total' => $this->decimal(10,2)->Null(),
                    'reference' => $this->string(50)->Null(),
                    'error_message' => $this->string(50)->Null(),
                    'status' => $this->smallInteger()->notNull()->defaultValue(0),
                    'CB' => $this->integer()->notNull(),
                    'UB' => $this->integer()->notNull(),
                    'DOC' => $this->dateTime(),
                    'DOU' => $this->timestamp(),
                        ], $tableOptions);
                $this->alterColumn('{{%sales_return_invoice_details}}', 'id', $this->integer() . ' NOT NULL AUTO_INCREMENT');

                $this->createIndex('sales-return-invoice-master', 'sales_return_invoice_details', 'sales_invoice_master_id', $unique = false);
                $this->addForeignKey("salesreturn--invoice-master", "sales_return_invoice_details", "sales_invoice_master_id", "sales_return_invoice_master", "id", "RESTRICT", "RESTRICT");
        }

    public function down()
    {
        echo "m170505_034800_sales_return_invoice cannot be reverted.\n";

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
