<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\BaseUnit;

/* @var $this yii\web\View */
/* @var $model common\models\SalesReturnInvoiceDetails */

$this->title = $model->sales_invoice_number;
$this->params['breadcrumbs'][] = ['label' => 'Sales Return Invoice Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .appoint{
        width: 100%;
        background-color: #eeeeee;
    }
    .appoint .value{
        font-weight: bold;
        text-align: left;
    }
    .appoint .labell{
        text-align: left;
    }
    .appoint .colen{

    }
    .appoint td{
        padding: 10px;
    }
    table th{
        color:black;
    }
    table td{
        color:black;
    }
    .sales-master{
        margin-bottom: 40px;
    }
    .sales-details{
        margin-bottom: 40px;
    }
    h4{
        color:#b60d14;
    }
</style>
<div class="row">
    <div class="col-md-12">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>

            </div>
            <div class="panel-body">
                <?= Html::a('<i class="fa-th-list"></i><span> Manage Sales Return Details</span>', ['index'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                <div class="panel-body">
                    <div class="sales-master table-responsive">
                        <h4>Sales Return Master</h4>
                        <table class="appoint">
                            <tr>
                                <td class="labell">Sales Invoice Number </td><td class="colen">:</td><td class="value"> <?= $model->sales_invoice_number; ?></td>
                                <td class="labell">Sales Invoice Date</td><td class="colen">:</td><td class="value"><?= $model->sales_invoice_date; ?></td>
                                <td class="labell">Business Partner </td><td class="colen">:</td><td class="value"><?= $model->busines_partner_code; ?> </td>
                            </tr>
                            <tr>
                                <td class="labell">Salesman </td><td class="colen">:</td><td class="value"> <?= $model->salesman; ?></td>
                                <td class="labell">Amount Payed </td><td class="colen">:</td><td class="value"> <?= $model->amount_payed; ?></td>
                                <td class="labell">Due Amount </td><td class="colen">:</td><td class="value"> <?= $model->due_amount; ?></td>
                            </tr>

                        </table>
                    </div>
                    <div class="sales-details">
                        <h4>Sales Return Details</h4>
                        <table class="table table-bordered">
                            <tr>
                                <th>Item Name</th>
                                <th>Quantity</th>
                                <th>Rate</th>
                                <th>Discount Amount</th>
                                <th>Tax Amount</th>
                                <th>Line Total</th>
                            </tr>
                            <?php
                            $rate_total = 0;
                            $discount_total = 0;
                            $tax_total = 0;
                            $live_total = 0;
                            foreach ($sales_details as $sales_detail) {
                                ?>
                                <tr>
                                    <td><?= $sales_detail->item_name; ?></td>
                                    <td><?= $sales_detail->qty ?> <?= BaseUnit::findOne(['id' => $sales_detail->base_unit])->name; ?></td>
                                    <td><?= $sales_detail->rate; ?></td>
                                    <td><?= $sales_detail->discount_amount; ?></td>
                                    <td><?= $sales_detail->tax_amount; ?></td>
                                    <td><?= $sales_detail->line_total; ?></td>
                                </tr>
                                <?php
                                $rate_total += $sales_detail->rate;
                                $discount_total += $sales_detail->discount_amount;
                                $tax_total += $sales_detail->tax_amount;
                                $live_total += $sales_detail->line_total;
                            }
                            ?>
                            <tr>
                                <td colspan="2">TOTAL</td>
                                <td><?= sprintf('%0.2f', $rate_total); ?></td>
                                <td><?= sprintf('%0.2f', $discount_total); ?></td>
                                <td><?= sprintf('%0.2f', $tax_total); ?></td>
                                <td><?= sprintf('%0.2f', $live_total); ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="Payment-details">
                        <h4>Payment Details</h4>
                        <table class="table table-bordered" style="width:50%;">
                            <tr>
                                <td><b>Round Off</b></td>
                                <td><b><?= $model->round_of_amount ?></b></td>
                            </tr>
                            <tr>
                                <td><b>Cash</b></td>
                                <td><b><?= $model->cash_amount ?></b></td>
                            </tr>
                            <tr>
                                <td><b>Card</b></td>
                                <td><b><?= $model->card_amount ?></b></td>
                            </tr>
                            <tr>
                                <td><b>Amount Paid</b></td>
                                <td><b><?= $model->amount_payed ?></b></td>
                            </tr>
                            <tr>
                                <td><b>Balance</b></td>
                                <td><b><?= $model->due_amount ?></b></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>