<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\BaseUnit;
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<!--<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title></title>-->
<div id="print">
    <link rel="stylesheet" href="<?= Yii::$app->homeUrl ?>css/invoice.css">
    <style type="text/css">

        @media print {
            thead {display: table-header-group;}
            tfoot {display: table-footer-group}
            /*tfoot {position: absolute;bottom: 0px;}*/
            .main-tabl{width: 100%}
            .footer {position: fixed ; left: 0px; bottom: 20px; right: 0px; font-size:10px; }
            body h6,h1,h2,h3,h4,h5,p,b,tr,td,span,th,div{
                color:#525252 !important;
            }
            .header{
                font-size: 12.5px;
                display: inline-block;
                width: 100%;
                border-bottom: 2px solid #9E9E9E;
            }
            .main-left{
                padding-top: 12px;
                float: left;
            }
            .main-right{
                float: right;
            }
            table.table{
                border: .1px solid #969696;
                border-collapse: collapse;
                width:100%;
            }
        }
        @media screen{
            .main-tabl{
                width: 60%;
            }
        }
        .print{
            margin-top: 18px;
            margin-left: 315px;
        }
        footer {
            width: 100%;
            position: absolute;
            bottom: 0px;
        }
    </style>
    <!--    </head>
        <body >-->
    <table border ="0"  class="main-tabl" border="0">
        <thead>
            <tr>
                <th style="width:100%">
                    <div class="header">
                        <div class="main-left">
                            <h2>BILLING INVOICE</h2>
                        </div>
                        <div class="main-right">
                            <img src="<?= Yii::$app->homeUrl ?>images/companyImages/<?= $company_details->id ?>.<?= $company_details->logo ?>" style="width: 90px;height: 75px;"/>
                        </div>
                        <br/>
                    </div>

                </th>
            </tr>

        </thead>
        <tbody>
            <tr>
                <td>
                    <div class="invoice-sub-heading" style="margin-bottom: 26px;">
                        <div class="invoive-date-no" style="padding: 10px 0px;">
                            <table class="tb2">
                                <tr>
                                    <td>Date </td> <td style="width: 50px;text-align: center">:</td>
                                    <td style="max-width: 200px"><?= date('d-m-Y'); ?></td>
                                </tr>
                                <tr>
                                    <td>Incoice Number </td> <td style="width: 50px;text-align: center">:</td>
                                    <td style="max-width: 200px"><?= $sales_master->sales_invoice_number ?></td>
                                </tr>
                            </table>
                        </div>
                        <div class="invoive-address" style="padding: 10px 0px;border-bottom: 2px solid #9E9E9E;">
                            <table class="tb2">
                                <tr>
                                    <td style="max-width: 100px"><?= $company_details->address1 ?> <?= $company_details->city ?>, <?= $company_details->state ?>, <?= $company_details->country ?> , <?= $company_details->postal_code ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div style="padding-bottom: 35px;">
                        <table class="table table-bordered">
                            <tr>
                                <th>Item</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                                <th>Line Total</th>
                            </tr>
                            <?php
                            $discount_amount = 0;
                            $net_total = 0;
                            foreach ($sales_details as $sales_detail) {
                                ?>
                                <tr>
                                    <td><?= $sales_detail->item_name ?></td>
                                    <td><?= $sales_detail->qty ?> <?= BaseUnit::findOne(['id' => $sales_detail->base_unit])->name; ?></td>
                                    <td><?= $sales_detail->rate ?></td>
                                    <td><?= $sales_detail->amount ?></td>
                                </tr>
                                <?php
                                $net_total += $sales_detail->amount;
                                $discount_amount += $sales_detail->discount_amount;
                            }
                            ?>
                            <tr>
                                <td colspan="3" style="font-weight: bold;font-size: 11px;">Net Total</td>
                                <td><?= sprintf('%0.2f', $net_total); ?></td>
                            </tr>
                            <tr>
                                <td colspan="3" style="font-weight: bold;font-size: 11px;">Discount</td>
                                <td><?= sprintf('%0.2f', $discount_amount); ?></td>
                            </tr>

                            <tr>
                                <td colspan="3" style="font-weight: bold;font-size: 11px;">Tax</td>
                                <td><?= $sales_master->tax_amount ?></td>
                            </tr>
                            <tr>
                                <td colspan="3" style="font-weight: bold;font-size: 11px;">TOTAL</td>
                                <td style="font-weight: bold;font-size: 11px;"><?= $sales_master->order_amount ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="payment-details">
                        <table class="table table-bordered" style="width:50%;">
                            <tr>
                                <td colspan="2"><b style="font-size: 12px;">Payment Details</b></td>
                            </tr>
                            <tr>
                                <td><b>Cash</b></td>
                                <td><b><?= $sales_master->cash_amount ?></b></td>
                            </tr>
                            <tr>
                                <td><b>Card</b></td>
                                <td><b><?= $sales_master->card_amount ?></b></td>
                            </tr>
                            <tr>
                                <td><b>Round Off</b></td>
                                <td><b><?= $sales_master->round_of_amount ?></b></td>
                            </tr>
                            <tr>
                                <td><b>Amount Paid</b></td>
                                <td><b><?= $sales_master->amount_payed ?></b></td>
                            </tr>
                            <tr>
                                <td><b>Balance</b></td>
                                <td><b><?= $sales_master->due_amount ?></b></td>
                            </tr>
                        </table>
                    </div>

                </td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td style="width:100%">
                    <div class="footer">
                        <span>
                        </span>
                    </div>
                </td>
            </tr>
        </tfoot>
    </table>
</div>
<script>
    function printContent(el) {
        var restorepage = document.body.innerHTML;
        var printcontent = document.getElementById(el).innerHTML;
        document.body.innerHTML = printcontent;
        window.print();
        document.body.innerHTML = restorepage;
    }
</script>
<div class="print">
    <div class="print" style="float:left;">
        <?php
        if ($print) {
            ?>
            <button onclick="printContent('print')" style="font-weight: bold !important;">Print</button>
            <?php
        }
        ?>
        <button onclick="window.close();" style="font-weight: bold !important;">Close</button>
        <?php
        if ($save) {
            ?>
            <a href="<?= Yii::$app->homeUrl ?>/appointment/estimated-proforma/save-report?id=<?= $appointment->id ?>"><button onclick="" style="font-weight: bold !important;">Save</button></a>
            <?php
        }
        ?>

    </div>
</div>
<!--</body>

</html>-->