<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\SalesReturnInvoiceDetailsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sales Return Details';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sales-return-invoice-details-index">

        <div class="row">
                <div class="col-md-12">

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>

                                </div>
                                <div class="panel-body">
                                                                                            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                                        
                                        <?=  Html::a('<i class="fa-th-list"></i><span> Create Sales Return Invoice Details</span>', ['create'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                                                                                                                                                        <?= GridView::widget([
                                                'dataProvider' => $dataProvider,
                                                'filterModel' => $searchModel,
        'columns' => [
                                                ['class' => 'yii\grid\SerialColumn'],

//                                                            'id',
//            'sales_invoice_master_id',
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

                                                [
                                'class' => 'yii\grid\ActionColumn',
                                'contentOptions' => [],
                                'header' => 'Actions',
                                'template' => '{view}{print}',
                                'buttons' => [
                                    //view button
                                    'print' => function ($url, $model) {
                                        return Html::a('<span class="fa fa-print" style="padding-top: 0px;font-size: 18px;"></span>', $url, [
                                                    'title' => Yii::t('app', 'print'),
                                                    'class' => 'actions',
                                                    'target' => '_blank',
                                        ]);
                                    },
                                    'view' => function ($url, $model) {
                                        return Html::a('<span class="fa fa-eye" style="padding-top: 0px;font-size: 20px;"></span>', $url, [
                                                    'title' => Yii::t('app', 'view'),
                                                    'class' => 'actions',
                                        ]);
                                    },
                                ],
                                'urlCreator' => function ($action, $model) {
                                    if ($action === 'print') {
                                        $url = 'report?id=' . $model->id;
//                                        $url = 'report';
                                        return $url;
                                    }
                                    if ($action === 'view') {
                                        $url = 'view?id=' . $model->id;
                                        return $url;
                                    }
                                }
                            ],
                                                ],
                                                ]); ?>
                                                                                                                </div>
                        </div>
                </div>
        </div>
</div>


