<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sales_invoice_temp".
 *
 * @property integer $id
 * @property string $item_code
 * @property integer $qty
 * @property string $rate
 * @property string $discount_percentage
 * @property string $discount_amount
 * @property string $tax
 * @property string $tax_id
 * @property string $line_total
 * @property integer $status
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 */
class SalesInvoiceTemp extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'sales_invoice_temp';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['qty', 'status', 'CB', 'UB'], 'integer'],
                        [['rate', 'discount_percentage', 'discount_amount', 'tax', 'tax_id', 'line_total'], 'number'],
                        [['DOC', 'DOU'], 'safe'],
                        [['item_code'], 'string', 'max' => 50],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'item_code' => 'Item Code',
                    'qty' => 'Qty',
                    'rate' => 'Rate',
                    'discount_percentage' => 'Discount Percentage',
                    'discount_amount' => 'Discount Amount',
                    'tax' => 'Tax',
                    'tax_id' => 'Tax ID',
                    'line_total' => 'Line Total',
                    'status' => 'Status',
                    'CB' => 'Cb',
                    'UB' => 'Ub',
                    'DOC' => 'Doc',
                    'DOU' => 'Dou',
                ];
        }

}
