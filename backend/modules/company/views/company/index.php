<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CompanySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Companies';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-index">

        <div class="row">
                <div class="col-md-12">

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>

                                </div>
                                <div class="panel-body">
                                        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                                        <?= Html::a('<i class="fa-th-list"></i><span> Create Company</span>', ['create'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                                        <?=
                                        GridView::widget([
                                            'dataProvider' => $dataProvider,
                                            'filterModel' => $searchModel,
                                            'columns' => [
                                                    ['class' => 'yii\grid\SerialColumn'],
//                                                'id',
                                                'name',
                                                'formation_date',
                                                'currency',
                                                'tin',
                                                    [
                                                    'attribute' => 'logo',
                                                    'format' => 'raw',
                                                    'value' => function ($data) {

                                                            $img = '<img width="80px" height="80px" src="' . Yii::$app->homeUrl . '../images/companyImages/' . $data->id . '.' . $data->logo . '"/>';

                                                            return $img;
                                                    },
                                                ],
                                                // 'cst',
                                                // 'gst',
                                                // 'pan',
                                                // 'cin',
                                                // 'address1:ntext',
                                                // 'address2:ntext',
                                                // 'city',
                                                // 'state',
                                                // 'country',
                                                // 'postal_code',
                                                // 'phone',
                                                // 'mobile',
                                                // 'email:email',
                                                // 'web',
                                                // 'logo',
                                                // 'note',
                                                // 'status',
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


