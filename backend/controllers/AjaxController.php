<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\BusinessPartner;

class AjaxController extends \yii\web\Controller {

        public function actionIndex() {
                return $this->render('index');
        }

        /*
         * This function select Countries based on the continent_id
         * return result to the view
         */

        public function actionState() {
                if (Yii::$app->request->isAjax) {
                        $country_id = $_POST['country_id'];
                        if ($country_id == '') {
                                echo '0';
                                exit;
                        } else {
                                $state_datas = \common\models\State::find()->where(['country_id' => $country_id])->all();
                                if (empty($state_datas)) {
                                        echo '0';
                                        exit;
                                } else {
                                        $options = '<option value="">-Choose State-</option>';
                                        foreach ($state_datas as $state_data) {
                                                $options .= "<option value='" . $state_data->id . "'>" . $state_data->state_name . "</option>";
                                        }
                                }
                        }

                        echo $options;
                }
        }

        /*
         * This function select City based on the district_id
         * return result to the view
         */

        public function actionCity() {
                if (Yii::$app->request->isAjax) {
                        $state_id = $_POST['state_id'];
                        if ($state_id == '') {
                                echo '0';
                                exit;
                        } else {
                                $city_datas = \common\models\City::find()->where(['state_id' => $state_id])->all();
                                if (empty($city_datas)) {
                                        echo '0';
                                        exit;
                                } else {
                                        $options = '<option value="">-Choose City-</option>';
                                        foreach ($city_datas as $city_data) {
                                                $options .= "<option value='" . $city_data->id . "'>" . $city_data->city_name . "</option>";
                                        }
                                }
                        }

                        echo $options;
                }
        }

        public function actionDropdownData() {
                if (Yii::$app->request->isAjax) {
//                        $model_name = $_POST['table_name'];
                        $data_id = $_POST['data_id'];
                        $datas = BusinessPartner::find()->where(['LIKE', 'name', $data_id])->all();
                        $options = '<ul style="list-style:none;">';
                        foreach ($datas as $data) {
                                $options .= "<li id='autofill-list-item'>" . $data->name . "</li>";
                        }
                        $options .= '</ul>';
                        echo $options;
                }
        }

}
