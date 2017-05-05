<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Country;
use common\models\State;
use common\models\City;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Company */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="company-form form-inline">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    $country = ArrayHelper::map(Country::find()->where(['status' => 1])->all(), 'id', 'country_name');
    $state = ArrayHelper::map(State::find()->where(['status' => 1])->all(), 'id', 'state_name');
    $city = ArrayHelper::map(City::find()->where(['status' => 1])->all(), 'id', 'city_name');
    ?>

    <div class='col-md-4 col-sm-6 col-xs-12'>
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    </div>
    <div class='col-md-4 col-sm-6 col-xs-12'>
        <?php
        echo '<label class="control-label control-label1" for="formation-date">Formation Date</label>';
        if (!$model->isNewRecord) {
            $model->formation_date = date('d-m-Y h:i', strtotime($model->formation_date));
        } else {
            $model->formation_date = date('d-m-Y h:i');
        }
        echo DateTimePicker::widget([
            'name' => 'formation_date',
            'type' => DateTimePicker::TYPE_INPUT,
            'value' => $model->formation_date,
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'dd-M-yyyy hh:ii'
            ]
        ]);
        ?>

    </div>
    <div class='col-md-4 col-sm-6 col-xs-12'>
        <?= $form->field($model, 'currency')->textInput(['maxlength' => true]) ?>

    </div>
    <div class='col-md-4 col-sm-6 col-xs-12'>
        <?= $form->field($model, 'tin')->textInput(['maxlength' => true]) ?>

    </div>
    <div class='col-md-4 col-sm-6 col-xs-12'>
        <?= $form->field($model, 'cst')->textInput(['maxlength' => true]) ?>

    </div>
    <div class='col-md-4 col-sm-6 col-xs-12'>
        <?= $form->field($model, 'gst')->textInput(['maxlength' => true]) ?>

    </div>
    <div class='col-md-4 col-sm-6 col-xs-12'>
        <?= $form->field($model, 'pan')->textInput(['maxlength' => true]) ?>

    </div>
    <div class='col-md-4 col-sm-6 col-xs-12'>
        <?= $form->field($model, 'cin')->textInput(['maxlength' => true]) ?>

    </div>
    <div class='col-md-4 col-sm-6 col-xs-12'>
        <?= $form->field($model, 'country')->dropDownList($country, ['prompt' => '-Choose Country-', 'class' => 'form-control country-change']) ?>

    </div>
    <div class='col-md-4 col-sm-6 col-xs-12'>
        <?= $form->field($model, 'state')->textInput(['maxlength' => true]) ?>

    </div>
    <div class='col-md-4 col-sm-6 col-xs-12'>
        <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

    </div>
    <div class='col-md-4 col-sm-6 col-xs-12'>
        <?= $form->field($model, 'postal_code')->textInput(['maxlength' => true]) ?>

    </div>
    <div class='col-md-4 col-sm-6 col-xs-12'>
        <?= $form->field($model, 'address1')->textarea(['rows' => 6]) ?>

    </div>
    <div class='col-md-4 col-sm-6 col-xs-12'>
        <?= $form->field($model, 'address2')->textarea(['rows' => 6]) ?>

    </div>
    <div class='col-md-4 col-sm-6 col-xs-12'>
        <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    </div>
    <div class='col-md-4 col-sm-6 col-xs-12'>
        <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>

    </div>
    <div class='col-md-4 col-sm-6 col-xs-12'>
        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    </div>
    <div class='col-md-4 col-sm-6 col-xs-12'>
        <?= $form->field($model, 'web')->textInput(['maxlength' => true]) ?>

    </div>
    <div class='col-md-4 col-sm-6 col-xs-12'>
        <?= $form->field($model, 'note')->textInput(['maxlength' => true]) ?>

    </div>
    <div class='col-md-4 col-sm-6 col-xs-12'>
        <?= $form->field($model, 'status')->dropDownList(['1' => 'Enabled', '0' => 'Disabled']) ?>

    </div>
    <div class='col-md-4 col-sm-6 col-xs-12'>
        <?= $form->field($model, 'logo')->fileInput() ?>

    </div>
    <?php
    if ($model->isNewRecord)
        echo "";
    else {
        ?>
        <div class='col-md-4 col-sm-6 col-xs-12'>
            <img src="<?= Yii::$app->homeUrl ?>images/companyImages/<?= $model->id ?>.<?= $model->logo; ?>" width="75" height="75"/>
        </div>
        <?php
    }
    ?>
    <div class="form-group" style="float: right;">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
