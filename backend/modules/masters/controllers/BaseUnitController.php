<?php

namespace backend\modules\masters\controllers;

use Yii;
use common\models\BaseUnit;
use common\models\BaseUnitSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BaseUnitController implements the CRUD actions for BaseUnit model.
 */
class BaseUnitController extends Controller {

        public function init() {
                if (Yii::$app->user->isGuest)
                        $this->redirect(['/site/index']);

                if (Yii::$app->session['post']['masters'] != 1)
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
         * Lists all BaseUnit models.
         * @return mixed
         */
        public function actionIndex() {
                $searchModel = new BaseUnitSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                return $this->render('index', [
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                ]);
        }

        /**
         * Displays a single BaseUnit model.
         * @param integer $id
         * @return mixed
         */
        public function actionView($id) {
                return $this->render('view', [
                            'model' => $this->findModel($id),
                ]);
        }

        /**
         * Creates a new BaseUnit model.
         * If creation is successful, the browser will be redirected to the 'view' page.
         * @return mixed
         */
        public function actionCreate() {
                $model = new BaseUnit();

                if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model) && $model->validate() && $model->save()) {
                                return $this->redirect(['view', 'id' => $model->id]);
                }
                return $this->render('update', [
                            'model' => $model,
                ]);
        }

        /**
         * Updates an existing BaseUnit model.
         * If update is successful, the browser will be redirected to the 'view' page.
         * @param integer $id
         * @return mixed
         */
        public function actionUpdate($id) {
                $model = $this->findModel($id);

                if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model) && $model->validate() && $model->save()) {
                        return $this->redirect(['view', 'id' => $model->id]);
                } else {
                        return $this->render('update', [
                                    'model' => $model,
                        ]);
                }
        }

        /**
         * Deletes an existing BaseUnit model.
         * If deletion is successful, the browser will be redirected to the 'index' page.
         * @param integer $id
         * @return mixed
         */
        public function actionDelete($id) {
                $this->findModel($id)->delete();

                return $this->redirect(['index']);
        }

        /**
         * Finds the BaseUnit model based on its primary key value.
         * If the model is not found, a 404 HTTP exception will be thrown.
         * @param integer $id
         * @return BaseUnit the loaded model
         * @throws NotFoundHttpException if the model cannot be found
         */
        protected function findModel($id) {
                if (($model = BaseUnit::findOne($id)) !== null) {
                        return $model;
                } else {
                        throw new NotFoundHttpException('The requested page does not exist.');
                }
        }

}
