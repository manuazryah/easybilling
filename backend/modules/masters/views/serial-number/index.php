<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\SerialNumberSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Serial Numbers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="serial-number-index">

        <div class="row">
                <div class="col-md-12">

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>

                                </div>
                                <div class="panel-body">
                                        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                                        <?= Html::a('<i class="fa-th-list"></i><span> Create Serial Number</span>', ['create'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                                        <?=
                                        GridView::widget([
                                            'dataProvider' => $dataProvider,
                                            'filterModel' => $searchModel,
                                            'columns' => [
                                                    ['class' => 'yii\grid\SerialColumn'],
//                                                            'id',
                                                [
                                                    'attribute' => 'transaction',
                                                    'format' => 'raw',
                                                    'filter' => ['0' => 'Sales', '1' => 'Credit Note', '2' => 'Receipt'],
                                                    'value' => function ($model) {
                                                            if ($model->transaction == 0) {
                                                                    return 'Sales';
                                                            } elseif ($model->transaction == 1) {
                                                                    return 'Credit Note';
                                                            } elseif ($model->transaction == 2) {
                                                                    return 'Receipt';
                                                            }
                                                    },
                                                ],
                                                'prefix',
                                                'sequence_no',
                                                    [
                                                    'attribute' => 'status',
                                                    'format' => 'raw',
                                                    'filter' => [1 => 'Enabled', 0 => 'disabled'],
                                                    'value' => function ($model) {
                                                            return $model->status == 1 ? 'Enabled' : 'disabled';
                                                    },
                                                ],
                                                // 'CB',
                                                // 'UB',
                                                // 'DOC',
                                                // 'DOU',
                                                ['class' => 'yii\grid\ActionColumn'],
                                            ],
                                        ]);
                                        ?>
                                </div>
                        </div>
                </div>
        </div>
</div>


