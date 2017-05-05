<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\AdminUsers;
use common\models\Country;
use common\models\State;
use common\models\City;

/* @var $this yii\web\View */
/* @var $model common\models\Company */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Companies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>

            </div>
            <div class="panel-body">
                <?= Html::a('<i class="fa-th-list"></i><span> Update Company</span>', ['update', 'id' => $model->id], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                <div class="panel-body"><div class="company-view">

                        <?=
                        DetailView::widget([
                            'model' => $model,
                            'attributes' => [
//                                                        'id',
                                'name',
                                'formation_date',
                                'currency',
                                'tin',
                                'cst',
                                'gst',
                                'pan',
                                'cin',
                                'address1:ntext',
                                'address2:ntext',
                                [
                                    'attribute' => 'country',
                                    'value' => call_user_func(function($model) {
                                                return Country::findOne($model->country)->country_name;
                                            }, $model),
                                ],
                                [
                                    'attribute' => 'state',
                                    'value' => call_user_func(function($model) {
                                                return State::findOne($model->state)->state_name;
                                            }, $model),
                                ],
                                [
                                    'attribute' => 'city',
                                    'value' => call_user_func(function($model) {
                                                return City::findOne($model->city)->city_name;
                                            }, $model),
                                ],
                                'postal_code',
                                'phone',
                                'mobile',
                                'email:email',
                                'web',
                                'note',
                                [
                                    'attribute' => 'logo',
                                    'format' => 'raw',
                                    'value' => call_user_func(function($model) {
                                                return '<img width="120px" height="100px" src="' . Yii::$app->homeUrl . 'images/companyImages/' . $model->id . '.' . $model->logo . '"/>';
                                            }, $model),
                                ],
                                [
                                    'attribute' => 'status',
                                    'value' => call_user_func(function($model) {
                                                if ($model->status == 1) {
                                                    return 'ENABLED';
                                                } else {
                                                    return 'DISABLED';
                                                }
                                            }, $model),
                                ],
                                [
                                    'attribute' => 'CB',
                                    'label' => 'Created By',
                                    'value' => call_user_func(function($model) {

                                                return AdminUsers::findOne($model->CB)->name;
                                            }, $model),
                                ],
                                [
                                    'attribute' => 'UB',
                                    'label' => 'Updated By',
                                    'value' => call_user_func(function($model) {

                                                return AdminUsers::findOne($model->UB)->name;
                                            }, $model),
                                ],
                                'DOC',
                                'DOU',
                            ],
                        ])
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


