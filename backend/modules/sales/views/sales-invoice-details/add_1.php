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

                                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                                                <label class="control-label control-label1" for="formation-date">Sales Invoice Date</label>
                                                                <input type="datetime-local" id="w1" class="form-control" name="sales_invoice_date" value="23-03-2017 03:31" data-krajee-datetimepicker="datetimepicker_1b78f15e">
                                                        </div>

                                                        <!--<div class='col-md-4 col-sm-6 col-xs-12'>-->
                                                        <?php
//                                                                echo '<label class="control-label control-label1" for="formation-date">Sales Invoice Date</label>';
//                                                                if (!$model_sales_master->isNewRecord) {
//                                                                        $model_sales_master->sales_invoice_date = date('d-m-Y h:i', strtotime($model_sales_master->sales_invoice_date));
//                                                                } else {
//                                                                        $model_sales_master->sales_invoice_date = date('d-m-Y h:i');
//                                                                }
//                                                                echo DateTimePicker::widget([
//                                                                    'name' => 'sales_invoice_date',
//                                                                    'type' => DateTimePicker::TYPE_INPUT,
//                                                                    'value' => $model_sales_master->sales_invoice_date,
//                                                                    'pluginOptions' => [
//                                                                        'autoclose' => true,
//                                                                        'format' => 'dd-M-yyyy hh:ii'
//                                                                    ]
//                                                                ]);
                                                        ?>

                                                        <!--</div>-->
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
                                                                <?= $form->field($model_sales_master, 'salesman')->textInput(['maxlength' => true]) ?>

                                                        </div>
                                                        <div class='col-md-4 col-sm-6 col-xs-12'>
                                                                <?= $form->field($model_sales_master, 'payment_status')->dropDownList(['0' => 'Free', '1' => 'Open', '2' => 'Paid']) ?>

                                                        </div>
                                                        <div class='col-md-4 col-sm-6 col-xs-12'>
                                                                <?= $form->field($model_sales_master, 'amount')->textInput(['maxlength' => true]) ?>

                                                        </div>
                                                </div>
                                        </div>
                                </div>

                                <div class="table-responsive" data-pattern="priority-columns" data-focus-btn-icon="fa-asterisk" data-sticky-table-header="true" data-add-display-all-btn="true" data-add-focus-btn="true">

                                        <table cellspacing="0" class="table table-small-font table-bordered table-striped">
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
                                                                <th data-priority="1">ACTIONS</th>
                                                        </tr>
                                                </thead>
                                                <tbody>
                                                        <tr class="filter">

                                                                <td>
                                                                        <?=
                                                                        $form->field($model, 'item_code')->widget(\yii\jui\AutoComplete::classname(), ['options' => ['class' => 'ui-autocomplete-input form-control', 'placeholder' => 'Item'],
                                                                            'clientOptions' => [
                                                                                'source' => $this->context->getItemName(),
                                                                            ],
                                                                        ])->label(false);
                                                                        ?>
                                                                        <?php // $form->field($model, 'item_code')->dropDownList(ArrayHelper::map(ItemMaster::findAll(['status' => 1]), 'id', 'SKU'), ['prompt' => '-Item-'])->label(false); ?>
                                                                </td>
                                                                <td>
                                                                        <?= $form->field($model, 'qty')->textInput(['placeholder' => 'Qty'])->label(false) ?>
                                                                </td>
                                                <input type="hidden" value="" placeholder="" class="form-control" id="tax-type" name="tax-type" readonly/>
                                                <td>
                                                        <input type="text" value="" placeholder="UOM" class="form-control" id="sales-uom" name="sales-uom" readonly/>
                                                        <?php // $form->field($model, 'item_name')->textInput(['placeholder' => 'UOM'])->label(false)      ?>
                                                </td>
                                                <td>
                                                        <?= $form->field($model, 'rate')->textInput(['placeholder' => 'RATE'])->label(false) ?>
                                                </td>
                                                <td>
                                                        <?= $form->field($model, 'discount_percentage')->textInput(['placeholder' => 'Discount %'])->label(false) ?>
                                                </td>
                                                <td>
                                                        <?= $form->field($model, 'discount_amount')->textInput(['placeholder' => 'Discount Amount'])->label(false) ?>
                                                </td>
                                                <td>
                                                        <?= $form->field($model, 'tax_percentage')->textInput(['placeholder' => 'Tax', 'readonly' => true])->label(false) ?>
                                                </td>
                                                <td>
                                                        <?= $form->field($model, 'line_total')->textInput(['placeholder' => 'Amount'])->label(false) ?>
                                                </td>
                                                <td>
                                                        <?= Html::submitButton($model->isNewRecord ? 'Add' : 'Update', ['class' => 'btn btn-success', 'name' => 'add']) ?>
                                                </td>


                                                </tr>
                                                <?php
                                                foreach ($model_temp as $temp) {
                                                        ?>
                                                        <tr>
                                                                <td><?= $temp->item_code ?></td>
                                                                <td> <?= $temp->qty ?>  </td>
                                                                <td>
                                                                        <?php
                                                                        $item_datas = \common\models\ItemMaster::find()->where(['SKU' => $temp->item_code])->one();
                                                                        $uom = \common\models\BaseUnit::findOne(['id' => $item_datas->base_unit_id])->name;
                                                                        ?>
                                                                        <?= $uom ?>
                                                                </td>
                                                                <td><?= $temp->rate ?></td>
                                                                <td><?= $temp->discount_percentage ?></td>
                                                                <td><?= $temp->discount_amount ?></td>
                                                                <td><?= $temp->tax ?></td>
                                                                <td><?= $temp->line_total ?></td>
                                                                <td></td>
                                                        </tr>
                                                        <?php
                                                }
                                                ?>

                                                </tbody>
                                        </table>
                                </div>
                                <div class="panel-body">
                                        <div class="sales-invoice-master-create">
                                                <div class="sales-invoice-master-form form-inline">

                                                        <div class='col-md-4 col-sm-6 col-xs-12'>
                                                                <?= $form->field($model_sales_master, 'delivery_terms')->textInput(['maxlength' => true]) ?>

                                                        </div>
                                                        <div class='col-md-4 col-sm-6 col-xs-12'>
                                                                <?= $form->field($model_sales_master, 'payment_terms')->textInput(['maxlength' => true]) ?>

                                                        </div>
                                                        <div class='col-md-4 col-sm-6 col-xs-12'>
                                                                <table cellspacing="0" class="table table-small-font table-bordered table-striped" style="float:right;text-align: left;">
                                                                <!--<table style="float:right;text-align: left;">-->
                                                                        <tr>
                                                                                <td>Total</td>
                                                                                <td></td>
                                                                        </tr>
                                                                        <tr>
                                                                                <td>Tax Amount</td>
                                                                                <td></td>
                                                                        </tr>
                                                                        <tr>
                                                                                <td>Order Amount</td>
                                                                                <td></td>
                                                                        </tr>
                                                                </table>
                                                        </div>
                                                </div>
                                        </div>
                                </div>

                                <?php ActiveForm::end(); ?>



                        </div>
                        <?php //Pjax::end();               ?>
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
