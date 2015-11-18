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
//            $apiPerson = ['']
        if (count($apiPerson) > 0) {
            $apiField = ArrayHelper::getValue($apiPerson,'field');
            $apiData = ArrayHelper::getValue($apiPerson,'data');
//            $apiField = ['exc1','exc2'];
            if (count($apiField) > 0)
            {

                $fieldList = new FieldList();
//                $dbField = $fieldList->find()->select('field')->orderBy(['field' => SORT_ASC])->asArray()->all();
                $dbField = $fieldList::loadFields();
//                $f = $fieldList::loadFields($dbField,1);
                $insertedField = 0;
                //Check if database is blank.
                if (count($dbField[0]) === 0 && count($dbField[1]) === 0) {
                    //Insert all new json field into the database.
                       $insertedField = FieldList::saveMultipleField($apiField);

                } else {
                    //Check for new field, excluded field and update existing field from excluded to new
                    //Check for new field
                    $new = array_diff($apiField,array_merge($dbField[0],$dbField[1]));
                    $exclude = array_diff($dbField[0],$apiField);
                    $renew = array_intersect($apiField,$dbField[1]);
                    if(count($new) > 0)
                    {
                        $insertedField = FieldList::saveMultipleField($new);
                    }
                    if(count($exclude) > 0)
                    {
                        $excludeField = FieldList::excludeMultipleFields($exclude);
                    }
                    if(count($renew) > 0)
                    {
                        $renewField = FieldList::renewMultipleFields($renew);
                    }

                }
            } else {
                //Load Data from Local Database (Not included in this version).
                //Below for test only
                $apiField =$apiPerson;
                $apiData= $apiPerson;
            }
        } else
        {
            //Load Data from Local Database (Not included in this version).
            //Below for test only
            $apiField =$apiPerson;
            $apiData= $apiPerson;
        }
        return $this->render('index', [
            'new' => $new,
            'exclude' => $exclude,

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
