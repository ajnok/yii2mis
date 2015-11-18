<?php

namespace backend\models;

use Yii;
//use yii\data\ArrayDataProvider;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;
/**
 * This is the model class for table "field_list".
 *
 * @property string $id
 * @property string $field
 * @property string $description
 * @property integer $visibility
 * @property integer $new
 * @property integer $excluded
 * @property string $inserted_at
 */
class FieldList extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'field_list';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['field'], 'required'],
            [['visibility', 'new', 'excluded'], 'integer'],
            [['inserted_at','excluded_at','renewed_at'], 'safe'],
            [['field'], 'string', 'max' => 80],
            [['description'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'field' => 'Field',
            'description' => 'Description',
            'visibility' => 'Visibility',
            'new' => 'New',
            'excluded' => 'Excluded',
            'inserted_at' => 'Inserted At',
        ];
    }

    public static function saveMultipleField($field)
    {
        $time = new Expression("NOW()");
        $data = array();
        foreach($field as $value){
            $data[]=[
                $value,
                $time,

            ];
        }
//        return Yii::$app->db->createCommand()->batchInsert('field_list', ['field','inserted_at'], $data)->execute();
        Yii::$app->db->createCommand()->batchInsert('field_list', ['field','inserted_at'], $data)->execute();
        return  (FieldList::find()->orderBy(['field' => SORT_ASC])->asArray()->all());
    }

//    public static function loadFields()
//    {
//        $data = (FieldList::find()->select('field')->orderBy(['field' => SORT_ASC])->asArray()->all());
//        $fields = array();
//        foreach($data as $i)
//        {
//            foreach($i as $key => $value)
//            {
//                $fields[] = $value;
//            }
//        }
//        return $fields;
//    }

    public static function loadFields()
    {

        $data = (FieldList::find()->orderBy(['field' => SORT_ASC])->asArray()->all());
//        $data = (FieldList::find()->orderBy(['field' => SORT_ASC])->all());
//        $prop = [
//            'backend\models\FieldList' => [
//                'id',
//                'field',
//                'excluded',
//                'new',
//            ],
//        ];
//        $arrData = ArrayHelper::toArray($data,$prop);
//        $x = $data[1]->find()->where(['field'=>'email_uni'])->all();
//        $dp = new ActiveDataProvider([
//            'query' => $data,
//        ]);
//        $dp=new ArrayDataProvider([
//            'allModels' => $data,
//            'sort' => [
//                'attributes' => ['new', 'field', 'excluded'],
//            ],
//            'pagination' => [
//                'pageSize' => 10,
//            ],
//        ]);

        $fields[0] = array();
        $fields[1] = array();
        $fields[3] = $data;
        foreach($data as $value) {
            if((int)$value['excluded'] === 0)
            {
                $fields[0][] = strtolower($value['field']);
            }else
            {
                $fields[1][] = strtolower($value['field']);
            }
        }
        return $fields;
    }

    public static function loadAllFields()
    {
        $data = (FieldList::find()->select(['field','excluded'])->orderBy(['field' => SORT_ASC])->asArray()->all());
//        $fields = array();
//        foreach($data as $i)
//        {
////            foreach($i as $key => $value)
////            {
////                $fields[] = $value;
////            }
//            $fields[] =$i;
//        }
//        return $fields;
        return $data;
    }

    public static function excludeMultipleFields($fields)
    {
        $time = new Expression("NOW()");
        $data = 0;
        foreach($fields as $value){
            $record = FieldList::find()->where(['field'=>$value])->one();
            if($record)
            {
                $record->excluded = 1;
                $record->excluded_at = $time;
                $record->renewed_at = null;
                $record->new = 0;
                $record->update();
                $data = $data+1;
            }

        }
        return $data;
    }

    public static function renewMultipleFields($fields)
    {
        $time = new Expression("NOW()");
        $data = 0;
        foreach($fields as $value){
            $record = FieldList::find()->where(['field'=>$value])->one();
            if($record)
            {
                $record->excluded = 0;
                $record->excluded_at = null;
                $record->renewed_at = $time;
                $record->new = 0;
                $record->update();
                $data = $data+1;
            }

        }
        return $data;
    }
}
