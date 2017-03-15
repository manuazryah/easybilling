<?php

namespace backend\modules\company\controllers;

use Yii;
use common\models\Company;
use common\models\CompanySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * CompanyController implements the CRUD actions for Company model.
 */
class CompanyController extends Controller {

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
         * Lists all Company models.
         * @return mixed
         */
        public function actionIndex() {
                $searchModel = new CompanySearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                return $this->render('index', [
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                ]);
        }

        /**
         * Displays a single Company model.
         * @param integer $id
         * @return mixed
         */
        public function actionView($id) {
                return $this->render('view', [
                            'model' => $this->findModel($id),
                ]);
        }

        /**
         * Creates a new Company model.
         * If creation is successful, the browser will be redirected to the 'view' page.
         * @return mixed
         */
        public function actionCreate() {
                $model = new Company();

                if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model)) {
                        $filee = UploadedFile::getInstance($model, 'logo');
                        $model->logo = $filee->extension;
                        $model->formation_date = $this->ChangeFormat($_POST['formation_date']);
                        $model->DOC = date("Y-m-d H:i:s");
                        if ($model->validate() && $model->save()) {
                                if (isset($filee)) {
                                        $this->upload($model, $filee);
                                }
                                return $this->redirect(['view', 'id' => $model->id]);
                        }
                }
                return $this->render('create', [
                            'model' => $model,
                ]);
        }

        /**
         * Updates an existing Company model.
         * If update is successful, the browser will be redirected to the 'view' page.
         * @param integer $id
         * @return mixed
         */
        public function actionUpdate($id) {
                $model = $this->findModel($id);

                if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model)) {
                        $filee = UploadedFile::getInstance($model, 'logo');
                        if (isset($filee)) {
                                $model->logo = $filee->extension;
                                $this->upload($model, $filee);
                        } else {
                                $photo = Company::findOne($model->id);
                                $model->logo = $photo->logo;
                        }
                        $model->formation_date = $this->ChangeFormat($_POST['formation_date']);
                        $model->save();
                        return $this->redirect(['view', 'id' => $model->id]);
                } else {
                        return $this->render('update', [
                                    'model' => $model,
                        ]);
                }
        }

        /**
         * Deletes an existing Company model.
         * If deletion is successful, the browser will be redirected to the 'index' page.
         * @param integer $id
         * @return mixed
         */
        public function actionDelete($id) {
                $this->findModel($id)->delete();

                return $this->redirect(['index']);
        }

        /**
         * Finds the Company model based on its primary key value.
         * If the model is not found, a 404 HTTP exception will be thrown.
         * @param integer $id
         * @return Company the loaded model
         * @throws NotFoundHttpException if the model cannot be found
         */
        protected function findModel($id) {
                if (($model = Company::findOne($id)) !== null) {
                        return $model;
                } else {
                        throw new NotFoundHttpException('The requested page does not exist.');
                }
        }

        /**
         * @Upload pro images
         */
        public function Upload($model, $filee) {
                $filee->saveAs(Yii::$app->basePath . '/../images/companyImages/' . $model->id . '.' . $filee->extension);
        }

        /*
         * To change the date formate
         * return new date
         */

        public function ChangeFormat($data) {
                if ($data != '') {
                        $originalDate = $data;
                        $newDate = date("Y-m-d h:i", strtotime($originalDate));
                        return $newDate;
                } else {
                        return '';
                }
        }

}
