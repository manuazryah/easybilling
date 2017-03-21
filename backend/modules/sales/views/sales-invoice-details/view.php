<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\SalesInvoiceDetails */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Sales Invoice Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
        <div class="col-md-12">

                <div class="panel panel-default">
                        <div class="panel-heading">
                                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>

                                <div class="panel-options">
                                        <a href="#" data-toggle="panel">
                                                <span class="collapse-icon">&ndash;</span>
                                                <span class="expand-icon">+</span>
                                        </a>
                                        <a href="#" data-toggle="remove">
                                                &times;
                                        </a>
                                </div>
                        </div>
                        <div class="panel-body">
                                <?=  Html::a('<i class="fa-th-list"></i><span> Manage Sales Invoice Details</span>', ['index'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                                <div class="panel-body"><div class="sales-invoice-details-view">
                                                <p>
                                                        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                                                        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                                                        'class' => 'btn btn-danger',
                                                        'data' => [
                                                        'confirm' => 'Are you sure you want to delete this item?',
                                                        'method' => 'post',
                                                        ],
                                                        ]) ?>
                                                </p>

                                                <?= DetailView::widget([
                                                'model' => $model,
                                                'attributes' => [
                                                            'id',
            'sales_invoice_master_id',
            'sales_invoice_number',
            'sales_invoice_date',
            'busines_partner_code',
            'item_code',
            'item_name',
            'base_unit',
            'qty',
            'rate',
            'amount',
            'discount_percentage',
            'discount_amount',
            'net_amount',
            'tax_id',
            'tax_percentage',
            'tax_amount',
            'line_total',
            'reference',
            'error_message',
            'status',
            'CB',
            'UB',
            'DOC',
            'DOU',
                                                ],
                                                ]) ?>
</div>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>


