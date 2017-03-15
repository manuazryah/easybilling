<?php

use yii\db\Migration;

class m170315_115409_tax extends Migration {

        public function up() {
                $tableOptions = null;
                if ($this->db->driverName === 'mysql') {
                        // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
                        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
                }

                $this->createTable('{{%base_unit}}', [
                    'id' => $this->primaryKey(),
                    'name' => $this->string(30)->notNull(),
                    'value' => $this->decimal(10,2)->Null(),
                    'status' => $this->smallInteger()->notNull()->defaultValue(0),
                    'CB' => $this->integer()->notNull(),
                    'UB' => $this->integer()->notNull(),
                    'DOC' => $this->dateTime(),
                    'DOU' => $this->timestamp(),
                        ], $tableOptions);
                $this->alterColumn('{{%base_unit}}', 'id', $this->integer() . ' NOT NULL AUTO_INCREMENT');

                $this->createTable('{{%payment_mode}}', [
                    'id' => $this->primaryKey(),
                    'name' => $this->string(10,2)->notNull(),
                    'value' => $this->decimal()->Null(),
                    'status' => $this->smallInteger()->notNull()->defaultValue(0),
                    'CB' => $this->integer()->notNull(),
                    'UB' => $this->integer()->notNull(),
                    'DOC' => $this->dateTime(),
                    'DOU' => $this->timestamp(),
                        ], $tableOptions);
                $this->alterColumn('{{%payment_mode}}', 'id', $this->integer() . ' NOT NULL AUTO_INCREMENT');

                $this->createTable('{{%tax}}', [
                    'id' => $this->primaryKey(),
                    'name' => $this->string(10,2)->notNull(),
                    'type' => $this->integer()->Null(),
                    'value' => $this->decimal()->Null(),
                    'status' => $this->smallInteger()->notNull()->defaultValue(0),
                    'CB' => $this->integer()->notNull(),
                    'UB' => $this->integer()->notNull(),
                    'DOC' => $this->dateTime(),
                    'DOU' => $this->timestamp(),
                        ], $tableOptions);
                $this->alterColumn('{{%tax}}', 'id', $this->integer() . ' NOT NULL AUTO_INCREMENT');
        }

        public function down() {
                echo "m170315_115409_tax cannot be reverted.\n";

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
