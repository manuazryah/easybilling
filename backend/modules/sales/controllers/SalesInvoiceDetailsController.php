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
            $data = Yii::$app->request->post();
            $this->SaveSalesMaster($model_sales_master, $data);
            $this->SaveSalesDetails($model_sales_master, $data);
            return $this->redirect(Yii::$app->request->referrer);
        }
        return $this->render('add', [
                    'model' => $model,
                    'model_sales_master' => $model_sales_master,
                    'model_temp' => $model_temp,
        ]);
    }

    public function SaveSalesDetails($model_sales_master, $data) {
        $arr = [];
        $i = 0;
        foreach ($data['SalesInvoiceDetailsItem'] as $val) {
            $arr[$i]['SalesInvoiceDetailsItem'] = $val;
            $i++;
        }
        $i = 0;
        foreach ($data['SalesInvoiceDetailsQty'] as $val) {
            $arr[$i]['SalesInvoiceDetailsQty'] = $val;
            $i++;
        }
        $i = 0;
        foreach ($data['sales-uom'] as $val) {
            $arr[$i]['sales-uom'] = $val;
            $i++;
        }
        $i = 0;
        foreach ($data['SalesInvoiceDetailsRate'] as $val) {
            $arr[$i]['SalesInvoiceDetailsRate'] = $val;
            $i++;
        }
        $i = 0;
        foreach ($data['SalesInvoiceDetailsDiscount'] as $val) {
            $arr[$i]['SalesInvoiceDetailsDiscount'] = $val;
            $i++;
        }
        $i = 0;
        foreach ($data['SalesInvoiceDetailsAmount'] as $val) {
            $arr[$i]['SalesInvoiceDetailsAmount'] = $val;
            $i++;
        }
        $i = 0;
        foreach ($data['SalesInvoiceDetailsTaxPercentage'] as $val) {
            $arr[$i]['SalesInvoiceDetailsTaxPercentage'] = $val;
            $i++;
        }
        $i = 0;
        foreach ($data['SalesInvoiceDetailsLineTotal'] as $val) {
            $arr[$i]['SalesInvoiceDetailsLineTotal'] = $val;
            $i++;
        }
        $this->AddSalesDetails($arr, $model_sales_master);
    }

    public function AddSalesDetails($arr, $model_sales_master) {
        foreach ($arr as $val) {
            $aditional = new SalesInvoiceDetails();
            $item_datas = \common\models\ItemMaster::find()->where(['SKU' => $val['SalesInvoiceDetailsItem']])->one();
            $tax = \common\models\Tax::findOne(['id' => $item_datas->tax_id]);
            $aditional->sales_invoice_master_id = $model_sales_master->id;
            $aditional->sales_invoice_number = $model_sales_master->sales_invoice_number;
            $aditional->sales_invoice_date = $model_sales_master->sales_invoice_date;
            $aditional->busines_partner_code = $model_sales_master->busines_partner_code;
            $aditional->item_code = $val['SalesInvoiceDetailsItem'];
            $aditional->item_name = $item_datas->item_name;
            $aditional->base_unit = $item_datas->base_unit_id;
            $aditional->qty = $val['SalesInvoiceDetailsQty'];
            $aditional->rate = $val['SalesInvoiceDetailsRate'];
            $aditional->amount = $aditional->qty * $aditional->rate;
            $aditional->discount_percentage = $val['SalesInvoiceDetailsDiscount'];
            $aditional->discount_amount = $val['SalesInvoiceDetailsAmount'];
            $aditional->net_amount = $aditional->amount - $aditional->discount_amount;
            $aditional->tax_id = $tax->id;
            $aditional->tax_percentage = $val['SalesInvoiceDetailsTaxPercentage'];
            if ($tax->type == 1) {
                $tax_amount = $aditional->tax_percentage;
            } else {
                $tax_amount = ($aditional->net_amount * $aditional->tax_percentage) / 100;
            }
            $aditional->tax_amount = $tax_amount;
            $aditional->line_total = $aditional->amount + $aditional->tax_amount - $aditional->discount_amount;
            $aditional->status = 1;
            $aditional->CB = Yii::$app->user->identity->id;
            $aditional->UB = Yii::$app->user->identity->id;
            $aditional->DOC = date('Y-m-d');
            if (!empty($aditional->item_code))
                $aditional->save();
        }
    }

    public function SaveSalesMaster($model_sales_master, $data) {
        $model_sales_master->sales_invoice_number = $data['SalesInvoiceMaster']['sales_invoice_number'];
        $model_sales_master->sales_invoice_date = date("Y-m-d h:i", strtotime($data['sales_invoice_date']));
        $model_sales_master->busines_partner_code = $data['SalesInvoiceDetails']['busines_partner_code'];
        $model_sales_master->salesman = $data['SalesInvoiceMaster']['salesman'];
        $model_sales_master->delivery_terms = $data['SalesInvoiceMaster']['delivery_terms'];
        $model_sales_master->payment_terms = $data['SalesInvoiceMaster']['payment_terms'];
        $model_sales_master->payment_status = $data['SalesInvoiceMaster']['payment_status'];
        $model_sales_master->amount = $data['SalesInvoiceMaster']['amount'];
        $model_sales_master->tax_amount = $data['tax_sub_total'];
        $model_sales_master->order_amount = $data['order_sub_total'];
        $model_sales_master->amount_payed = $data['payed_amount'];
        $model_sales_master->due_amount = $data['balance'];
        $model_sales_master->status = 1;
        Yii::$app->SetValues->Attributes($model_sales_master);
        $model_sales_master->save();
        return $model_sales_master;
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

    /**
     * Finds the salesman.
     * @return salesman name as array
     */
    public function getSalesman() {
        $salesman = \common\models\Salesman::find()->where(['status' => 1])->all();
        $source;
        foreach ($salesman as $value) {
            $source[] = $value->name;
        }
        return $source;
    }

    public function actionItemNames() {
        if (Yii::$app->request->isAjax) {

            $data_char = $_POST['item'];
            if (!empty($data_char)) {
                $result = \common\models\ItemMaster::find()->where(['LIKE', 'SKU', $data_char])->all();
                foreach ($result as $item) {
                    $item_value .= $item->SKU . ',';
                }
            } else {
                $item_value = '';
            }
            return rtrim($item_value, ',');
        }
    }

}
