<?php

use yii\db\Migration;

class m170315_053955_company extends Migration {

        public function up() {
                $tableOptions = null;
                if ($this->db->driverName === 'mysql') {
                        // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
                        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
                }

                $this->createTable('{{%company}}', [
                    'id' => $this->primaryKey(),
                    'name' => $this->string(30)->notNull(),
                    'formation_date' => $this->string(30)->notNull(),
                    'currency' => $this->string(30)->Null(),
                    'tin' => $this->string(30)->Null(),
                    'cst' => $this->string(30)->Null(),
                    'gst' => $this->string(15)->Null(),
                    'pan' => $this->string(30)->Null(),
                    'cin' => $this->string(30),
                    'address1' => $this->text(),
                    'address2' => $this->text(),
                    'city' => $this->integer()->Null(),
                    'state' => $this->integer()->Null(),
                    'country' => $this->integer()->Null(),
                    'postal_code' => $this->string(30),
                    'phone' => $this->string(15),
                    'mobile' => $this->string(15),
                    'email' => $this->string(50),
                    'web' => $this->string(100),
                    'logo' => $this->string(50),
                    'note' => $this->string(50),
                    'status' => $this->smallInteger()->notNull()->defaultValue(0),
                    'CB' => $this->integer()->notNull(),
                    'UB' => $this->integer()->notNull(),
                    'DOC' => $this->dateTime(),
                    'DOU' => $this->timestamp(),
                        ], $tableOptions);
                $this->alterColumn('{{%company}}', 'id', $this->integer() . ' NOT NULL AUTO_INCREMENT');
        }

        public function down() {
                echo "m170315_053955_company cannot be reverted.\n";

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
