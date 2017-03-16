<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\City;

/* @var $this yii\web\View */
/* @var $model common\models\BusinessPartner */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="business-partner-form form-inline">

        <?php $form = ActiveForm::begin(); ?>
        <?php
        $city = ArrayHelper::map(City::find()->where(['status' => 1])->all(), 'id', 'city_name');
        ?>

        <div class='col-md-4 col-sm-6 col-xs-12'>    
                <?= $form->field($model, 'type')->dropDownList(['0' => 'Customer', '1' => 'Supplier']) ?>

        </div>
        <div class='col-md-4 col-sm-6 col-xs-12'>    
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        </div>
        <div class='col-md-4 col-sm-6 col-xs-12'>    
                <?= $form->field($model, 'phone')->textInput() ?>

        </div>
        <div class='col-md-4 col-sm-6 col-xs-12'>    
                <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

        </div>
        <div class='col-md-4 col-sm-6 col-xs-12'>   
                <?= $form->field($model, 'city')->dropDownList($city, ['prompt' => '-Choose City-']) ?>

        </div>
        <div class='col-md-4 col-sm-6 col-xs-12'>    
                <?= $form->field($model, 'status')->dropDownList(['1' => 'Enabled', '0' => 'Disabled']) ?>

        </div>
        <div class="form-group" style="float: right;">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>
        </div>

        <?php ActiveForm::end(); ?>

</div>
