<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "salesman".
 *
 * @property integer $id
 * @property string $name
 * @property integer $value
 * @property integer $status
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 */
class Salesman extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'salesman';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['name', 'CB', 'UB'], 'required'],
                        [['value', 'status', 'CB', 'UB'], 'integer'],
                        [['DOC', 'DOU'], 'safe'],
                        [['name'], 'string', 'max' => 30],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'name' => 'Name',
                    'value' => 'Value',
                    'status' => 'Status',
                    'CB' => 'Cb',
                    'UB' => 'Ub',
                    'DOC' => 'Date of Creation',
                    'DOU' => 'Date of Updation',
                ];
        }

}
