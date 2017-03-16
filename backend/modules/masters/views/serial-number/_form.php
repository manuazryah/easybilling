<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\SerialNumber */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="serial-number-form form-inline">

        <?php $form = ActiveForm::begin(); ?>

        <div class='col-md-4 col-sm-6 col-xs-12'>   
                <?= $form->field($model, 'transaction')->dropDownList(['0' => 'Sales', '1' => 'Credit Note', '2' => 'Receipt']) ?>

        </div>
        <div class='col-md-4 col-sm-6 col-xs-12'>    
                <?= $form->field($model, 'prefix')->textInput() ?>

        </div>
        <div class='col-md-4 col-sm-6 col-xs-12'>    
                <?= $form->field($model, 'sequence_no')->textInput() ?>

        </div>
        <div class='col-md-4 col-sm-6 col-xs-12'>    
                <?= $form->field($model, 'status')->dropDownList(['1' => 'Enabled', '0' => 'Disabled']) ?>

        </div>
        <div class="form-group" style="float: right;">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>
        </div>

        <?php ActiveForm::end(); ?>

</div>
