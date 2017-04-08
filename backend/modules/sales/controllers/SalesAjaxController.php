<?php

namespace backend\modules\sales\controllers;

use Yii;

class SalesAjaxController extends \yii\web\Controller {

        public function init() {

        }

        public function actionIndex() {
                return $this->render('index');
        }

        /*
         * This function select base_unit and tax based on the item_id
         * @return base_unit(UOM) and tax as json
         */

        public function actionItemDetails() {
                if (Yii::$app->request->isAjax) {
                        $item_id = $_POST['item_id'];
                        if ($item_id == '') {
                                echo '0';
                                exit;
                        } else {
                                $item_datas = \common\models\ItemMaster::find()->where(['SKU' => $item_id])->one();
                                if (empty($item_datas)) {
                                        echo '0';
                                        exit;
                                } else {
                                        $uom = \common\models\BaseUnit::findOne(['id' => $item_datas->base_unit_id])->name;
                                        $tax = \common\models\Tax::findOne(['id' => $item_datas->tax_id]);
                                        $arr_variable = array($uom, $tax->value, $item_datas->base_unit_id, $tax->type);
                                        $data['result'] = $arr_variable;
                                        echo json_encode($data);
                                }
                        }
                }
        }

        /*
         * This function select base_unit and tax based on the item_id
         * @return base_unit(UOM) and tax as json
         */

        public function actionRate() {
                if (Yii::$app->request->isAjax) {
                        $base_unit = $_POST['base_unit'];
                        $rate = \common\models\BaseUnit::find()->where(['id' => $base_unit])->one();
                        if (empty($rate)) {
                                echo '0';
                                exit;
                        } else {
                                return $rate->value;
                        }
                }
        }

}
