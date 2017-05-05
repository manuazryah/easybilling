<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use yii\db\Expression;
use kartik\datetime\DateTimePicker;
use common\components\DropdownWidget;
use common\models\ItemMaster;

/* @var $this yii\web\View */
/* @var $model common\models\EstimatedProforma */

$this->title = 'Sales Invoice';
$this->params['breadcrumbs'][] = ['label' => ' Pre-Funding', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-12">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h2  class="appoint-title panel-title"><?= Html::encode($this->title) . '</b>' ?></h2>

            </div>
            <?php //Pjax::begin();      ?>
            <div class="panel-body">
                <?php $form = ActiveForm::begin(); ?>

                <div class="panel-body">
                    <div class="sales-invoice-master-create">
                        <div class="sales-invoice-master-form form-inline">
                            <?php
                            date_default_timezone_set('Asia/Kolkata');
                            $current_date = date("d-m-Y h:i");
                            ?>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <label class="control-label control-label1" for="formation-date" >Sales Return Date</label>
                                <input type="text" class="form-control"  data-mask="datetime"name="sales_invoice_date" value="<?= $current_date ?>"/>
                            </div>

                            <div class='col-md-4 col-sm-6 col-xs-12'>
                                <?= $form->field($model_sales_master, 'sales_invoice_number')->textInput(['maxlength' => true]) ?>

                            </div>

                            <div class='col-md-4 col-sm-6 col-xs-12'>

                                <?=
                                $form->field($model, 'busines_partner_code')->widget(\yii\jui\AutoComplete::classname(), ['options' => ['class' => 'ui-autocomplete-input form-control'],
                                    'clientOptions' => [
                                        'source' => $this->context->getPartner(),
                                    ],
                                ])
                                ?>

                            </div>
                            <div class='col-md-4 col-sm-6 col-xs-12'>
                                <?php
                                $default_salesman = \common\models\Salesman::findOne(['type' => 1])->name;
                                ?>
                                <?=
                                $form->field($model_sales_master, 'salesman')->widget(\yii\jui\AutoComplete::classname(), ['options' => ['class' => 'ui-autocomplete-input form-control', 'value' => (!empty($default_salesman) ? $default_salesman : '')],
                                    'value' => 'Manu',
                                    'clientOptions' => [
                                        'source' => $this->context->getSalesman(),
                                    ],
                                ])
                                ?>
                                <?php // $form->field($model_sales_master, 'salesman')->textInput(['maxlength' => true]) ?>

                            </div>
                            <div class='col-md-4 col-sm-6 col-xs-12'>
                                <?= $form->field($model_sales_master, 'payment_status')->dropDownList(['0' => 'Free', '1' => 'Open', '2' => 'Paid']) ?>

                            </div>
                            <div class='col-md-4 col-sm-6 col-xs-12'>
                                <?= $form->field($model_sales_master, 'amount')->textInput(['maxlength' => true, 'readonly' => TRUE]) ?>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="table-responsive" data-pattern="priority-columns" data-focus-btn-icon="fa-asterisk" data-sticky-table-header="true" data-add-display-all-btn="true" data-add-focus-btn="true">
                    <?php
                    $items = ArrayHelper::map(ItemMaster::find()->where(['status' => 1])->all(), 'SKU', 'SKU');
                    ?>
                    <table cellspacing="0" class="table table-small-font table-bordered table-striped" id="add-invoicee">
                        <thead>
                            <tr>
                                <th data-priority="3">Item</th>
                                <th data-priority="6" >Qty</th>
                                <th data-priority="6">UOM</th>
                                <th data-priority="6">RATE</th>
                                <th data-priority="6">Discount %</th>
                                <th data-priority="6">Discount Amount</th>
                                <th data-priority="6">Tax %</th>
                                <th data-priority="6">Amount</th>
                                <th data-priority="1"></th>
                            </tr>
                        </thead>
                        <tbody>
                        <input type="hidden" value="1" name="next_item_id" id="next_item_id"/>
                        <tr class="filter" id="item-row-1">

                            <td>
                                <div class="form-group field-salesinvoicedetails-item_code has-success">

                                    <select id="salesinvoicedetails-item-code-1" class="form-control salesinvoicedetails-item_code" name="SalesInvoiceDetailsItem[1]" aria-invalid="false">
                                        <option value="">-Item-</option>
                                        <?php foreach ($items as $value) { ?>
                                            <option value="<?= $value ?>"><?= $value ?></option>
                                        <?php }
                                        ?>
                                    </select>

                                    <div class="help-block"></div>
                                </div>
                                <?php // $form->field($model, 'item_code')->dropDownList(ArrayHelper::map(ItemMaster::findAll(['status' => 1]), 'id', 'SKU'), ['prompt' => '-Item-'])->label(false);   ?>
                            </td>
                            <td>
                                <div class="form-group field-salesinvoicedetails-qty has-success">

                                    <input type="number" id="salesinvoicedetails-qty-1" class="form-control salesinvoicedetails-qty" name="SalesInvoiceDetailsQty[1]" placeholder="Qty" min="1" aria-invalid="false">

                                    <div class="help-block"></div>
                                </div>
                            </td>
                        <input type="hidden" value="" placeholder="" class="form-control" id="tax-type-1" name="tax-type[1]" readonly/>
                        <td>
                            <input type="text" value="" placeholder="UOM" class="form-control" id="sales-uom-1" name="sales-uom[1]" readonly/>
                            <?php // $form->field($model, 'item_name')->textInput(['placeholder' => 'UOM'])->label(false)        ?>
                        </td>
                        <td>
                            <div class="form-group field-salesinvoicedetails-rate has-success">

                                <input type="text" id="salesinvoicedetails-rate-1" class="form-control salesinvoicedetails-rate" name="SalesInvoiceDetailsRate[1]" placeholder="RATE" aria-invalid="false">

                                <div class="help-block"></div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group field-salesinvoicedetails-discount_percentage has-success">

                                <input type="text" id="salesinvoicedetails-discount_percentage-1" class="form-control salesinvoicedetails-discount_percentage" name="SalesInvoiceDetailsDiscount[1]" placeholder="Discount %" aria-invalid="false">

                                <div class="help-block"></div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group field-salesinvoicedetails-discount_amount has-success">

                                <input type="text" id="salesinvoicedetails-discount_amount-1" class="form-control salesinvoicedetails-discount_amount" name="SalesInvoiceDetailsAmount[1]" placeholder="Discount Amount" aria-invalid="false">

                                <div class="help-block"></div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group field-salesinvoicedetails-tax_percentage has-success">

                                <input type="text" id="salesinvoicedetails-tax_percentage-1" class="form-control salesinvoicedetails-tax_percentage" name="SalesInvoiceDetailsTaxPercentage[1]" readonly="" placeholder="Tax" aria-invalid="false">

                                <div class="help-block"></div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group field-salesinvoicedetails-line_total has-success">

                                <input type="text" id="salesinvoicedetails-line_total-1" class="form-control salesinvoicedetails-line_total" name="SalesInvoiceDetailsLineTotal[1]" placeholder="Amount" aria-invalid="false">

                                <div class="help-block"></div>
                            </div>
                        </td>
                        <td>
                            <a id="del" class="" ><i class="fa fa-trash-o sales-invoice-delete"></i></a>
                        </td>


                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="panel-body">
                    <div class="sales-invoice-master-create">
                        <div class="sales-invoice-master-form form-inline">

                            <div class='col-md-4 col-sm-6 col-xs-12'>
                                <?= $form->field($model_sales_master, 'delivery_terms')->textInput(['maxlength' => true]) ?>
                                <?= $form->field($model_sales_master, 'payment_terms')->textInput(['maxlength' => true]) ?>
                            </div>

                            <div class='col-md-4 col-sm-6 col-xs-12'>
                                <table cellspacing="0" class="table table-small-font table-bordered table-striped" style="float:right;text-align: left;">
                                <!--<table style="float:right;text-align: left;">-->
                                    <tr>
                                        <td>Total</td>
                                        <td><input type="text" id="sub_total" name="sub_total" style="width: 100%;" readonly/></td>
                                        <!--<td><span id="sub_total"></span></td>-->
                                    </tr>
                                    <tr>
                                        <td>Tax Amount</td>
                                        <td><input type="text" id="tax_sub_total" name="tax_sub_total" style="width: 100%;" readonly/></td>
                                        <!--<td><span id="tax_sub_total"></span></td>-->
                                    </tr>
                                    <tr>
                                        <td>Order Amount</td>
                                        <td><input type="text" id="order_sub_total" name="order_sub_total" style="width: 100%;" readonly/></td>
                                        <!--<td><span id="order_sub_total"></span></td>-->
                                    </tr>
                                </table>
                            </div>

                            <div class='col-md-4 col-sm-6 col-xs-12'>
                                <table cellspacing="0" class="table table-small-font table-bordered table-striped" style="float:right;text-align: left;">
                                <!--<table style="float:right;text-align: left;">-->
                                    <tr>
                                        <td>Round off</td>
                                        <td><input type="text" id="round_of" name="round_of" style="width: 100%;"/></td>
                                    </tr>
                                    <tr>
                                        <td>Cash</td>
                                        <td><input type="text" id="cash_amount" name="cash_amount" style="width: 100%;"/></td>
                                    </tr>
                                    <tr>
                                        <td>Card</td>
                                        <td><input type="text" id="card_amount" name="card_amount" style="width: 100%;"/></td>
                                    </tr>
                                    <tr>
                                        <td>Amount Payed</td>
                                        <td><input type="text" id="payed_amount" name="payed_amount" style="width: 100%;" readonly/></td></td>
                                    </tr>
                                    <tr>
                                        <td>Balance</td>
                                        <td><input type="text" id="balance" name="balance" style="width: 100%;" readonly/></td>
                                        <!--<td><span id="balance"></span></td>-->
                                    </tr>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
                <div style="float:right;">
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-secondary']) ?>
                </div>

                <?php ActiveForm::end(); ?>



            </div>
            <?php //Pjax::end();                 ?>
        </div>
    </div>
</div>
<div class="modal fade" id="add-sub">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Dynamic Content</h4>
            </div>

            <div class="modal-body">

                Content is loading...

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-info">Save changes</button>
            </div>
        </div>
    </div>
    <style>
        .filter{
            background-color: #b9c7a7;
        }
    </style>
    <script type="text/javascript" src="<?= Yii::$app->homeUrl ?>js/invoice.js"></script>
</div>
<!-- Imported scripts on this page -->
<script src="<?= Yii::$app->homeUrl ?>js/inputmask/jquery.inputmask.bundle.js"></script>
