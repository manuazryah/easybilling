<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "business_partner".
 *
 * @property integer $id
 * @property integer $type
 * @property string $name
 * @property integer $phone
 * @property string $email
 * @property integer $city
 * @property integer $status
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 *
 * @property City $city0
 */
class BusinessPartner extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'business_partner';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['type', 'name', 'phone', 'email'], 'required'],
                        [['type', 'phone', 'city', 'status', 'CB', 'UB'], 'integer'],
                        [['email'], 'email'],
                        [['DOC', 'DOU'], 'safe'],
                        [['name'], 'string', 'max' => 30],
                        [['email'], 'string', 'max' => 100],
                        [['city'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['city' => 'id']],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'type' => 'Type',
                    'name' => 'Name',
                    'phone' => 'Phone',
                    'email' => 'Email',
                    'city' => 'City',
                    'status' => 'Status',
                    'CB' => 'Cb',
                    'UB' => 'Ub',
                    'DOC' => 'Date of Creation',
                    'DOU' => 'Date of Updation',
                ];
        }

        /**
         * @return \yii\db\ActiveQuery
         */
        public function getCity0() {
                return $this->hasOne(City::className(), ['id' => 'city']);
        }

}
