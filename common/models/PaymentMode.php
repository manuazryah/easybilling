<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "payment_mode".
 *
 * @property integer $id
 * @property string $name
 * @property string $value
 * @property integer $status
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 */
class PaymentMode extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'payment_mode';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['name', 'value'], 'required'],
                        [['value'], 'number'],
                        [['status', 'CB', 'UB'], 'integer'],
                        [['DOC', 'DOU'], 'safe'],
                        [['name'], 'string', 'max' => 10],
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
