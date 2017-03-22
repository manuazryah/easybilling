<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use yii\db\Expression;
use kartik\datetime\DateTimePicker;
use common\components\DropdownWidget;

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
                                                        <div class='col-md-4 col-sm-6 col-xs-12'>
                                                                <?php
                                                                echo '<label class="control-label control-label1" for="formation-date">Sales Invoice Date</label>';
                                                                if (!$model_sales_master->isNewRecord) {
                                                                        $model_sales_master->sales_invoice_date = date('d-m-Y h:i', strtotime($model_sales_master->sales_invoice_date));
                                                                } else {
                                                                        $model_sales_master->sales_invoice_date = date('d-m-Y h:i');
                                                                }
                                                                echo DateTimePicker::widget([
                                                                    'name' => 'sales_invoice_date',
                                                                    'type' => DateTimePicker::TYPE_INPUT,
                                                                    'value' => $model_sales_master->sales_invoice_date,
                                                                    'pluginOptions' => [
                                                                        'autoclose' => true,
                                                                        'format' => 'dd-M-yyyy hh:ii'
                                                                    ]
                                                                ]);
                                                                ?>

                                                        </div>
                                                        <div class='col-md-4 col-sm-6 col-xs-12'>
                                                                <?= $form->field($model_sales_master, 'sales_invoice_number')->textInput(['maxlength' => true]) ?>

                                                        </div>
                                                        <div class='col-md-4 col-sm-6 col-xs-12'>
                                                                <?php echo DropdownWidget::widget(['field_name' => 'busines_partner_code','model' => $model_sales_master,'id' => 'salesinvoicemaster-busines_partner_code','name' =>'SalesInvoiceMaster[busines_partner_code]','table_name'=>'BusinessPartner']) ?>
                                                                <?php // $form->field($model_sales_master, 'busines_partner_code')->textInput(['maxlength' => true]) ?>

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
                                                                <th data-priority="6">Tax</th>
                                                                <th data-priority="6">Amount</th>
                                                                <th data-priority="1">ACTIONS</th>
                                                        </tr>
                                                </thead>
                                                <tbody>
                                                        <tr class="filter">

                                                                <td><?= $form->field($model, 'item_name')->textInput(['placeholder' => 'Item'])->label(false) ?></td>
                                                                <td><?= $form->field($model, 'qty')->textInput(['placeholder' => 'Qty'])->label(false) ?></td>
                                                                <td><?= $form->field($model, 'item_name')->textInput(['placeholder' => 'UOM'])->label(false) ?></td>
                                                                <td><?= $form->field($model, 'rate')->textInput(['placeholder' => 'RATE'])->label(false) ?></td>
                                                                <td><?= $form->field($model, 'discount_percentage')->textInput(['placeholder' => 'Discount %'])->label(false) ?></td>
                                                                <td><?= $form->field($model, 'discount_amount')->textInput(['placeholder' => 'Discount Amount'])->label(false) ?></td>
                                                                <td><?= $form->field($model, 'tax_percentage')->textInput(['placeholder' => 'Tax'])->label(false) ?></td>
                                                                <td><?= $form->field($model, 'amount')->textInput(['placeholder' => 'Amount'])->label(false) ?></td>
                                                                <td><?= Html::submitButton($model->isNewRecord ? 'Add' : 'Update', ['class' => 'btn btn-success']) ?> </td>


                                                        </tr>

                                                </tbody>
                                        </table>
                                </div>

                                <?php ActiveForm::end(); ?>
                                <script>
                                        $("document").ready(function () {
                                                $('#subservices-service_id').change(function () {
                                                        var service_id = $(this).val();
                                                        $.ajax({
                                                                type: 'POST',
                                                                cache: false,
                                                                data: {service_id: service_id},
                                                                url: '<?= Yii::$app->homeUrl; ?>/appointment/estimated-proforma/subservice',
                                                                success: function (data) {
                                                                        $('#subservices-sub_service').html(data);
                                                                }
                                                        });
                                                });

                                        });
                                </script>
                                <script type="text/javascript">
                                        jQuery(document).ready(function ($)
                                        {
                                                $("#closeestimatesubservice-sub_service").select2({
                                                        //placeholder: 'Select your country...',
                                                        allowClear: true
                                                }).on('select2-open', function ()
                                                {
                                                        // Adding Custom Scrollbar
                                                        $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
                                                });
                                                $("#closeestimatesubservice-sub_service").select2({
                                                        //placeholder: 'Select your country...',
                                                        allowClear: true
                                                }).on('select2-open', function ()
                                                {
                                                        // Adding Custom Scrollbar
                                                        $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
                                                });

                                        });</script>


                                <link rel="stylesheet" href="<?= Yii::$app->homeUrl; ?>/js/select2/select2.css">
                                <link rel="stylesheet" href="<?= Yii::$app->homeUrl; ?>/js/select2/select2-bootstrap.css">
                                <script src="<?= Yii::$app->homeUrl; ?>/js/select2/select2.min.js"></script>

                                <script>
                                        $(document).ready(function () {
                                                $("#closeestimatesubservice-unit").keyup(function () {
                                                        multiply();
                                                });
                                                $("#closeestimatesubservice-unit_price").keyup(function () {
                                                        multiply();
                                                });
                                        });
                                        function multiply() {
                                                var rate = $("#closeestimatesubservice-unit").val();
                                                var unit = $("#closeestimatesubservice-unit_price").val();
                                                if (rate != '' && unit != '') {
                                                        $("#closeestimatesubservice-total").val(rate * unit);
                                                }

                                        }
                                        $("#closeestimatesubservice-total").prop("disabled", true);
                                        $("#fundingallocation-check_no").prop("disabled", true);
                                        $('#fundingallocation-payment_type').change(function () {
                                                var payment_id = $(this).val();
                                                if (payment_id == 2) {
                                                        $("#fundingallocation-check_no").prop("disabled", false);
                                                } else {
                                                        $("#fundingallocation-check_no").prop("disabled", true);
                                                }
                                        });
                                </script>
                        </div>
                        <?php //Pjax::end();          ?>
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
</div>
