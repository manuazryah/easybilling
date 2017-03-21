<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\SalesInvoiceDetailsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sales Invoice Details';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sales-invoice-details-index">

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
                                                                                            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                                        
                                        <?=  Html::a('<i class="fa-th-list"></i><span> Create Sales Invoice Details</span>', ['create'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                                                                                                                                                        <?= GridView::widget([
                                                'dataProvider' => $dataProvider,
                                                'filterModel' => $searchModel,
        'columns' => [
                                                ['class' => 'yii\grid\SerialColumn'],

                                                            'id',
            'sales_invoice_master_id',
            'sales_invoice_number',
            'sales_invoice_date',
            'busines_partner_code',
            // 'item_code',
            // 'item_name',
            // 'base_unit',
            // 'qty',
            // 'rate',
            // 'amount',
            // 'discount_percentage',
            // 'discount_amount',
            // 'net_amount',
            // 'tax_id',
            // 'tax_percentage',
            // 'tax_amount',
            // 'line_total',
            // 'reference',
            // 'error_message',
            // 'status',
            // 'CB',
            // 'UB',
            // 'DOC',
            // 'DOU',

                                                ['class' => 'yii\grid\ActionColumn'],
                                                ],
                                                ]); ?>
                                                                                                                </div>
                        </div>
                </div>
        </div>
</div>


