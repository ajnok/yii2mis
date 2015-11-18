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
        $LoadApi = new LoadApi();
//        $jsonField = array_keys(array_change_key_case($jsonData->arrayperson[0],CASE_LOWER));
        $apiPerson = $LoadApi->person;
        if (count($apiPerson) > 0) {
            $apiField = ArrayHelper::getValue($apiPerson,'field');
            $apiData = ArrayHelper::getValue($apiPerson,'data');

            if (count($apiField) > 0)
            {

                $fieldList = new FieldList();
                $dbField = $fieldList->find()->orderBy(['field' => SORT_ASC])->all();
                //Check if database is blank.
                if (count($dbField) === 0) {
                    //Insert all new json field into the database.

                       $apiData = FieldList::saveMultipleField($apiField);


                } else {
                    //Check for new field, excluded field and update existing field from excluded to new
                    //Check for new field

                }
            } else {


            }
        } else
        {
            //Load Data from Local Database (Not included in this version).
            //Below for test only
            $apiField =$apiPerson;
            $apiData= $apiPerson;
        }
        return $this->render('index', [
            'jsonField' => $apiField,
            'dbField' => $apiData,
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
