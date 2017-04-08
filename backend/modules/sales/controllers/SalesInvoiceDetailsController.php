<?php

namespace backend\modules\sales\controllers;

use Yii;
use common\models\SalesInvoiceDetails;
use common\models\SalesInvoiceDetailsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\SalesInvoiceMaster;
use common\models\BusinessPartner;
use common\models\SalesInvoiceTemp;

/**
 * SalesInvoiceDetailsController implements the CRUD actions for SalesInvoiceDetails model.
 */
class SalesInvoiceDetailsController extends Controller {

        /**
         * @inheritdoc
         */
        public function behaviors() {
                return [
                    'verbs' => [
                        'class' => VerbFilter::className(),
                        'actions' => [
                            'delete' => ['POST'],
                        ],
                    ],
                ];
        }

        /**
         * Lists all SalesInvoiceDetails models.
         * @return mixed
         */
        public function actionIndex() {
                $searchModel = new SalesInvoiceDetailsSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                return $this->render('index', [
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                ]);
        }

        /**
         * Displays a single SalesInvoiceDetails model.
         * @param integer $id
         * @return mixed
         */
        public function actionView($id) {
                return $this->render('view', [
                            'model' => $this->findModel($id),
                ]);
        }

        /**
         * Creates a new SalesInvoiceDetails model.
         * If creation is successful, the browser will be redirected to the 'view' page.
         * @return mixed
         */
        public function actionCreate() {
                $model = new SalesInvoiceDetails();

                if ($model->load(Yii::$app->request->post()) && $model->save()) {
                        return $this->redirect(['view', 'id' => $model->id]);
                } else {
                        return $this->render('create', [
                                    'model' => $model,
                        ]);
                }
        }

        /**
         * Updates an existing SalesInvoiceDetails model.
         * If update is successful, the browser will be redirected to the 'view' page.
         * @param integer $id
         * @return mixed
         */
        public function actionUpdate($id) {
                $model = $this->findModel($id);

                if ($model->load(Yii::$app->request->post()) && $model->save()) {
                        return $this->redirect(['view', 'id' => $model->id]);
                } else {
                        return $this->render('update', [
                                    'model' => $model,
                        ]);
                }
        }

        /**
         * Deletes an existing SalesInvoiceDetails model.
         * If deletion is successful, the browser will be redirected to the 'index' page.
         * @param integer $id
         * @return mixed
         */
        public function actionDelete($id) {
                $this->findModel($id)->delete();

                return $this->redirect(['index']);
        }

        /**
         * Finds the SalesInvoiceDetails model based on its primary key value.
         * If the model is not found, a 404 HTTP exception will be thrown.
         * @param integer $id
         * @return SalesInvoiceDetails the loaded model
         * @throws NotFoundHttpException if the model cannot be found
         */
        protected function findModel($id) {
                if (($model = SalesInvoiceDetails::findOne($id)) !== null) {
                        return $model;
                } else {
                        throw new NotFoundHttpException('The requested page does not exist.');
                }
        }

        public function actionAdd() {
                $model = new SalesInvoiceDetails();
                $model_sales_master = new SalesInvoiceMaster();
                $model_temp = SalesInvoiceTemp::find()->where(['status' => 1])->all();
                if ($model->load(Yii::$app->request->post())) {
                        $model->tax_id = $_POST['tax-type'];
                        $this->addTemperory($model);
                        return $this->redirect(Yii::$app->request->referrer);
                }
                return $this->render('add', [
                            'model' => $model,
                            'model_sales_master' => $model_sales_master,
                            'model_temp' => $model_temp,
                ]);
        }

        public function addTemperory($model) {
                $model_temp = new SalesInvoiceTemp();
                $model_temp->item_code = $model->item_code;
                $model_temp->qty = $model->qty;
                $model_temp->rate = $model->rate;
                $model_temp->discount_percentage = $model->discount_percentage;
                $model_temp->discount_amount = $model->discount_amount;
                $model_temp->tax = $model->tax_percentage;
                $model_temp->tax_id = $model->tax_id;
                $model_temp->line_total = $model->line_total;
                Yii::$app->SetValues->Attributes($model_temp);
                $model_temp->save();
                return TRUE;
        }

        /**
         * Finds the Business Partner name.
         * @return businee partner names as array
         */
        public function getPartner() {
                $partner = BusinessPartner::find()->where(['status' => 1])->all();
                $source;
                foreach ($partner as $value) {
                        $source[] = $value->name;
                }
                return $source;
        }

        /**
         * Finds the item Code(SKU).
         * @return item Code(SKU) as array
         */
        public function getItemName() {
                $items = \common\models\ItemMaster::find()->where(['status' => 1])->all();
                $source;
                foreach ($items as $value) {
                        $source[] = $value->SKU;
                }
                return $source;
        }

}
