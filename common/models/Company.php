<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "company".
 *
 * @property integer $id
 * @property string $name
 * @property string $formation_date
 * @property string $currency
 * @property string $tin
 * @property string $cst
 * @property string $gst
 * @property string $pan
 * @property string $cin
 * @property string $address1
 * @property string $address2
 * @property integer $city
 * @property integer $state
 * @property integer $country
 * @property string $postal_code
 * @property string $phone
 * @property string $mobile
 * @property string $email
 * @property string $web
 * @property string $logo
 * @property string $note
 * @property integer $status
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 */
class Company extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'company';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['name'], 'required'],
                        [['address1', 'address2'], 'string'],
                        [['city', 'state', 'country', 'status', 'CB', 'UB'], 'integer'],
                        [['DOC', 'DOU'], 'safe'],
                        [['email'], 'email'],
                        [['name', 'formation_date', 'currency', 'tin', 'cst', 'pan', 'cin', 'postal_code'], 'string', 'max' => 30],
                        [['gst', 'phone', 'mobile'], 'string', 'max' => 15],
                        [['email', 'logo', 'note'], 'string', 'max' => 50],
                        [['web'], 'string', 'max' => 100],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'name' => 'Name',
                    'formation_date' => 'Formation Date',
                    'currency' => 'Currency',
                    'tin' => 'TIN',
                    'cst' => 'CST',
                    'gst' => 'GST',
                    'pan' => 'PAN',
                    'cin' => 'CIN',
                    'address1' => 'Address1',
                    'address2' => 'Address2',
                    'city' => 'City',
                    'state' => 'State',
                    'country' => 'Country',
                    'postal_code' => 'Postal Code',
                    'phone' => 'Phone',
                    'mobile' => 'Mobile',
                    'email' => 'Email',
                    'web' => 'Web',
                    'logo' => 'Logo',
                    'note' => 'Note',
                    'status' => 'Status',
                    'CB' => 'Cb',
                    'UB' => 'Ub',
                    'DOC' => 'Doc',
                    'DOU' => 'Dou',
                ];
        }

}
