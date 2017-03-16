<?php

use yii\db\Migration;

class m170315_044718_country_state_city extends Migration {

        public function up() {
                $tableOptions = null;
                if ($this->db->driverName === 'mysql') {
                        // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
                        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
                }

                $this->createTable('{{%country}}', [
                    'id' => $this->primaryKey(),
                    'country_name' => $this->string(100)->notNull(),
                    'status' => $this->smallInteger()->notNull()->defaultValue(1),
                    'CB' => $this->integer()->notNull(),
                    'UB' => $this->integer()->notNull(),
                    'DOC' => $this->dateTime(),
                    'DOU' => $this->timestamp(),
                        ], $tableOptions);
                $this->alterColumn('{{%country}}', 'id', $this->integer() . ' NOT NULL AUTO_INCREMENT');

                $this->createTable('{{%state}}', [
                    'id' => $this->primaryKey(),
                    'country_id' => $this->integer()->notNull(),
                    'state_name' => $this->string(100),
                    'status' => $this->smallInteger()->notNull()->defaultValue(1),
                    'CB' => $this->integer()->notNull(),
                    'UB' => $this->integer()->notNull(),
                    'DOC' => $this->dateTime(),
                    'DOU' => $this->timestamp(),
                        ], $tableOptions);
                $this->alterColumn('{{%state}}', 'id', $this->integer() . ' NOT NULL AUTO_INCREMENT');

                $this->createIndex('country-id', 'state', 'country_id', false);
                $this->addForeignKey("countryid", "state", "country_id", "country", "id", "RESTRICT", "RESTRICT");

                $this->createTable('{{%city}}', [
                    'id' => $this->primaryKey(),
                    'country_id' => $this->integer()->notNull(),
                    'state_id' => $this->integer()->notNull(),
                    'city_name' => $this->string(100),
                    'status' => $this->smallInteger()->notNull()->defaultValue(1),
                    'CB' => $this->integer()->notNull(),
                    'UB' => $this->integer()->notNull(),
                    'DOC' => $this->dateTime(),
                    'DOU' => $this->timestamp(),
                        ], $tableOptions);
                $this->alterColumn('{{%city}}', 'id', $this->integer() . ' NOT NULL AUTO_INCREMENT');

                $this->createIndex('country-id', 'city', 'country_id', false);
                $this->createIndex('state-id', 'city', 'state_id', false);
                $this->addForeignKey("country", "city", "country_id", "country", "id", "RESTRICT", "RESTRICT");
                $this->addForeignKey("state", "city", "state_id", "state", "id", "RESTRICT", "RESTRICT");
        }

        public function down() {
                echo "m170315_044718_country_state_city cannot be reverted.\n";

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
