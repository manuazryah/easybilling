<?php

namespace backend\modules\product\controllers;

use Yii;
use common\models\ItemMaster;
use common\models\ItemMasterSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ItemMasterController implements the CRUD actions for ItemMaster model.
 */
class ItemMasterController extends Controller {

        public function init() {
                if (Yii::$app->user->isGuest)
                        $this->redirect(['/site/index']);

                if (Yii::$app->session['post']['admin'] != 1)
                        $this->redirect(['/site/home']);
        }

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
         * Lists all ItemMaster models.
         * @return mixed
         */
        public function actionIndex() {
                $searchModel = new ItemMasterSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                return $this->render('index', [
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                ]);
        }

        /**
         * Displays a single ItemMaster model.
         * @param integer $id
         * @return mixed
         */
        public function actionView($id) {
                return $this->render('view', [
                            'model' => $this->findModel($id),
                ]);
        }

        /**
         * Creates a new ItemMaster model.
         * If creation is successful, the browser will be redirected to the 'view' page.
         * @return mixed
         */
        public function actionCreate() {
                $model = new ItemMaster();

                if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model) && $model->validate() && $model->save()) {
                        return $this->redirect(['view', 'id' => $model->id]);
                }
                return $this->render('create', [
                            'model' => $model,
                ]);
        }

        /**
         * Updates an existing ItemMaster model.
         * If update is successful, the browser will be redirected to the 'view' page.
         * @param integer $id
         * @return mixed
         */
        public function actionUpdate($id) {
                $model = $this->findModel($id);

                if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model) && $model->validate() && $model->save()) {
                        return $this->redirect(['view', 'id' => $model->id]);
                }
                return $this->render('update', [
                            'model' => $model,
                ]);
        }

        /**
         * Deletes an existing ItemMaster model.
         * If deletion is successful, the browser will be redirected to the 'index' page.
         * @param integer $id
         * @return mixed
         */
        public function actionDelete($id) {
                $this->findModel($id)->delete();

                return $this->redirect(['index']);
        }

        /**
         * Finds the ItemMaster model based on its primary key value.
         * If the model is not found, a 404 HTTP exception will be thrown.
         * @param integer $id
         * @return ItemMaster the loaded model
         * @throws NotFoundHttpException if the model cannot be found
         */
        protected function findModel($id) {
                if (($model = ItemMaster::findOne($id)) !== null) {
                        return $model;
                } else {
                        throw new NotFoundHttpException('The requested page does not exist.');
                }
        }

}
