<?php

namespace backend\controllers;

use Yii;
use common\models\FieldEmployee;
use common\models\FieldEmployeeSearch;
use common\models\JsonData;
use yii\db\Expression;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FieldEmployeeController implements the CRUD actions for FieldEmployee model.
 */
class FieldEmployeeController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all FieldEmployee models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FieldEmployeeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $FieldEmployee = new FieldEmployee();
        $JsonData = new JsonData();
        $arrayJsonData = array_values($JsonData->getField("array"));

//        $insertCount = 0;
        $arrayFieldEmployee = $FieldEmployee->find()->orderBy(['name'=>SORT_ASC])->asArray()->all();
        $countDbData = count($arrayFieldEmployee);
        $countJsonData = count($arrayJsonData);
        $new = array();
        $excluded = array();
        if($countJsonData > 0) {
            $arrayJsonData = array_unique($arrayJsonData);
            if ($countDbData === 0) {
                //Load all filed to Database
                $bulkInsert = array();
                $now = new Expression('NOW()');
                foreach ($arrayJsonData as $field) {
                    $bulkInsert[] = [
                        'name' => $field,
                        'inserted_at' => $now,
                    ];
                }
                $FieldEmployee->batchInsert($bulkInsert,['name','inserted_at']);
//                Yii::$app->db->createCommand()->batchInsert('field_employee', ['name', 'inserted_at'],
//                    $bulkInsert)->execute();
            }elseif($countDbData > 0)
            {
                //Check New and Deleted fields
                //$new = array_diff($arrayJsonData,$arrayFieldEmployee);
                $arrayDb = ArrayHelper::getColumn($arrayFieldEmployee,'name');
                $new = array_diff($arrayJsonData,$arrayDb);
                if(count($new) > 0)
                {
                    $bulkInsert = array();
                    $now = new Expression('NOW()');
                    foreach ($new as $field) {
                        $bulkInsert[] = [
                            'name' => $field,
                            'inserted_at' => $now,
                        ];
                    }
                    $FieldEmployee->batchInsert($bulkInsert,['name','inserted_at']);
                }
                $excluded = array_diff($arrayDb,$arrayJsonData);
                if(count($excluded)>0)
                {
                    $bulkDelete = array();
                    foreach($excluded as $field)
                    {
                        Yii::$app->db->createCommand()->delete(FieldEmployee::tableName(),['name'=>$field])->execute();
                    }
                }
//                Yii::$app->db->createCommand()->batchInsert('field_employee', ['name', 'inserted_at'],
//                    $bulkInsert)->execute();


            }
        }else
        {
            //Can't Load JSON from URL,then , Load Field and Data from Local Database (Not in this version).
        }
        $model = new FieldEmployee();
        return $this->render('index', [
            'model' => $model,
//            'new' => $new,
//            'jsonField' => $arrayJsonData,
////            'dbField' => $FieldEmployee,
//            'excluded' => $excluded,
//            'dbField' => ArrayHelper::getColumn($arrayFieldEmployee,'name'),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }

    /**
     * Displays a single FieldEmployee model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new FieldEmployee model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new FieldEmployee();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing FieldEmployee model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
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
     * Deletes an existing FieldEmployee model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the FieldEmployee model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FieldEmployee the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FieldEmployee::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
