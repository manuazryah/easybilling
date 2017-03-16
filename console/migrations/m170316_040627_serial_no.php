<?php

use yii\db\Migration;

class m170316_040627_serial_no extends Migration
{
    public function up() {
                $tableOptions = null;
                if ($this->db->driverName === 'mysql') {
                        // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
                        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
                }

                $this->createTable('{{%serial_number}}', [
                    'id' => $this->primaryKey(),
                    'transaction' => $this->integer()->Null(),
                    'prefix' => $this->integer()->Null(),
                    'sequence_no' => $this->integer()->Null(),
                    'status' => $this->smallInteger()->notNull()->defaultValue(0),
                    'CB' => $this->integer()->notNull(),
                    'UB' => $this->integer()->notNull(),
                    'DOC' => $this->dateTime(),
                    'DOU' => $this->timestamp(),
                        ], $tableOptions);
                $this->alterColumn('{{%serial_number}}', 'id', $this->integer() . ' NOT NULL AUTO_INCREMENT');

        }

    public function down()
    {
        echo "m170316_040627_serial_no cannot be reverted.\n";

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
