<?php

use yii\db\Migration;

class m170316_055721_partner_salesman extends Migration {

    public function up() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%business_partner}}', [
            'id' => $this->primaryKey(),
            'type' => $this->integer()->notNull(),
            'name' => $this->string(30)->notNull(),
            'phone' => $this->integer()->notNull(),
            'email' => $this->string(100),
            'city' => $this->string(100)->Null(),
            'status' => $this->smallInteger()->notNull()->defaultValue(0),
            'CB' => $this->integer()->notNull(),
            'UB' => $this->integer()->notNull(),
            'DOC' => $this->dateTime(),
            'DOU' => $this->timestamp(),
                ], $tableOptions);
        $this->alterColumn('{{%business_partner}}', 'id', $this->integer() . ' NOT NULL AUTO_INCREMENT');

        $this->createTable('{{%salesman}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(30)->notNull(),
            'value' => $this->string(100)->Null(),
            'type' => $this->smallInteger()->notNull()->defaultValue(0),
            'status' => $this->smallInteger()->notNull()->defaultValue(0),
            'CB' => $this->integer()->notNull(),
            'UB' => $this->integer()->notNull(),
            'DOC' => $this->dateTime(),
            'DOU' => $this->timestamp(),
                ], $tableOptions);
        $this->alterColumn('{{%salesman}}', 'id', $this->integer() . ' NOT NULL AUTO_INCREMENT');
    }

    public function down() {
        echo "m170316_055721_partner_salesman cannot be reverted.\n";

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
