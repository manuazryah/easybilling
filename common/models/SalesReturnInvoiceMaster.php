<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sales_return_invoice_master".
 *
 * @property integer $id
 * @property string $sales_invoice_number
 * @property string $sales_invoice_date
 * @property integer $order_type
 * @property string $busines_partner_code
 * @property string $salesman
 * @property string $payment_terms
 * @property string $delivery_terms
 * @property string $amount
 * @property string $tax_amount
 * @property string $order_amount
 * @property string $ship_to_adress
 * @property string $card_amount
 * @property string $cash_amount
 * @property string $round_of_amount
 * @property string $amount_payed
 * @property string $due_amount
 * @property integer $payment_status
 * @property string $reference
 * @property string $error_message
 * @property integer $status
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 *
 * @property SalesReturnInvoiceDetails[] $salesReturnInvoiceDetails
 */
class SalesReturnInvoiceMaster extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sales_return_invoice_master';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sales_invoice_date', 'DOC', 'DOU'], 'safe'],
            [['order_type', 'payment_status', 'status', 'CB', 'UB'], 'integer'],
            [['amount', 'tax_amount', 'order_amount', 'card_amount', 'cash_amount', 'round_of_amount', 'amount_payed', 'due_amount'], 'number'],
            [['CB', 'UB'], 'required'],
            [['sales_invoice_number', 'ship_to_adress', 'reference', 'error_message'], 'string', 'max' => 50],
            [['busines_partner_code'], 'string', 'max' => 15],
            [['salesman', 'payment_terms', 'delivery_terms'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sales_invoice_number' => 'Sales Invoice Number',
            'sales_invoice_date' => 'Sales Invoice Date',
            'order_type' => 'Order Type',
            'busines_partner_code' => 'Busines Partner Code',
            'salesman' => 'Salesman',
            'payment_terms' => 'Payment Terms',
            'delivery_terms' => 'Delivery Terms',
            'amount' => 'Amount',
            'tax_amount' => 'Tax Amount',
            'order_amount' => 'Order Amount',
            'ship_to_adress' => 'Ship To Adress',
            'card_amount' => 'Card Amount',
            'cash_amount' => 'Cash Amount',
            'round_of_amount' => 'Round Of Amount',
            'amount_payed' => 'Amount Payed',
            'due_amount' => 'Due Amount',
            'payment_status' => 'Payment Status',
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
    public function getSalesReturnInvoiceDetails()
    {
        return $this->hasMany(SalesReturnInvoiceDetails::className(), ['sales_invoice_master_id' => 'id']);
    }
}
