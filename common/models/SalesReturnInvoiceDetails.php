<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sales_return_invoice_details".
 *
 * @property integer $id
 * @property integer $sales_invoice_master_id
 * @property string $sales_invoice_number
 * @property string $sales_invoice_date
 * @property string $busines_partner_code
 * @property string $item_code
 * @property string $item_name
 * @property integer $base_unit
 * @property integer $qty
 * @property string $rate
 * @property string $amount
 * @property string $discount_percentage
 * @property string $discount_amount
 * @property string $net_amount
 * @property integer $tax_id
 * @property string $tax_percentage
 * @property string $tax_amount
 * @property string $line_total
 * @property string $reference
 * @property string $error_message
 * @property integer $status
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 *
 * @property SalesReturnInvoiceMaster $salesInvoiceMaster
 */
class SalesReturnInvoiceDetails extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sales_return_invoice_details';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sales_invoice_master_id', 'CB', 'UB'], 'required'],
            [['sales_invoice_master_id', 'base_unit', 'qty', 'tax_id', 'status', 'CB', 'UB'], 'integer'],
            [['sales_invoice_date', 'DOC', 'DOU'], 'safe'],
            [['rate', 'amount', 'discount_amount', 'net_amount', 'tax_amount', 'line_total'], 'number'],
            [['sales_invoice_number', 'reference', 'error_message'], 'string', 'max' => 50],
            [['busines_partner_code'], 'string', 'max' => 15],
            [['item_code', 'item_name', 'discount_percentage', 'tax_percentage'], 'string', 'max' => 30],
            [['sales_invoice_master_id'], 'exist', 'skipOnError' => true, 'targetClass' => SalesReturnInvoiceMaster::className(), 'targetAttribute' => ['sales_invoice_master_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sales_invoice_master_id' => 'Sales Invoice Master ID',
            'sales_invoice_number' => 'Sales Invoice Number',
            'sales_invoice_date' => 'Sales Invoice Date',
            'busines_partner_code' => 'Busines Partner Code',
            'item_code' => 'Item Code',
            'item_name' => 'Item Name',
            'base_unit' => 'Base Unit',
            'qty' => 'Qty',
            'rate' => 'Rate',
            'amount' => 'Amount',
            'discount_percentage' => 'Discount Percentage',
            'discount_amount' => 'Discount Amount',
            'net_amount' => 'Net Amount',
            'tax_id' => 'Tax ID',
            'tax_percentage' => 'Tax Percentage',
            'tax_amount' => 'Tax Amount',
            'line_total' => 'Line Total',
            'reference' => 'Reference',
            'error_message' => 'Error Message',
            'status' => 'Status',
            'CB' => 'Cb',
            'UB' => 'Ub',
            'DOC' => 'Doc',
            'DOU' => 'Dou',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSalesInvoiceMaster()
    {
        return $this->hasOne(SalesReturnInvoiceMaster::className(), ['id' => 'sales_invoice_master_id']);
    }
}
