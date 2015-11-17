<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use common\models\LoginForm;
use yii\filters\VerbFilter;
use common\models\LoadApi;
use backend\models\FieldList;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
//            'access' => [
//                'class' => AccessControl::className(),
//                'rules' => [
//                    [
//                        'actions' => ['login', 'error'],
//                        'allow' => true,
//                    ],
//                    [
//                        'actions' => ['logout', 'index'],
//                        'allow' => true,
//                        'roles' => ['@'],
//                    ],
//                ],
//            ],
//            'verbs' => [
//                'class' => VerbFilter::className(),
//                'actions' => [
//                    'logout' => ['post'],
//                ],
//            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        $jsonData = new LoadApi();
//        $jsonField = array_keys(array_change_key_case($jsonData->arrayperson[0],CASE_LOWER));
        $jsonData = $jsonData->person;
        $fieldList = new FieldList();
        $dbField = $fieldList->find()->orderBy(['field'=>SORT_ASC])->all();
//        if(count($jsonField)>0)
//        {
//            //$jsonField = strtolower($jsonField);
//            //$jsonField = ArrayHelper::multisort($jsonField,SORT_DESC);
//            //Check if database is blank.
//            if(count($dbField)===0)
//            {
//                //Insert all new json field into the database.
//
//            }else
//            {
//                //Check for new field, excluded field and update existing field from excluded to new
//                //Check for new field
//
//            }
//        }else
//        {
//            //Load Data from Local Database (Not included in this version).
//        }

        return $this->render('index',[
            'jsonField' => $jsonData,
            'dbField' => $dbField,
        ]);
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
