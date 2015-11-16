<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "field_employee".
 *
 * @property integer $id
 * @property string $name
 * @property integer $visibility
 * @property integer $new
 */
class FieldEmployee extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    const STATUS_NEW = 1;
    const STATUS_VISIBILITY = 1;
    const STATUS_EXCLUDED = 1;

    public static function tableName()
    {
        return 'field_employee';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['visibility', 'new'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['name'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'visibility' => 'Visibility',
            'new' => 'New',
        ];
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['inserted_at'],
                    ActiveRecord::EVENT_AFTER_DELETE => ['excluded_at'],
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    public static function batchInsert($arr = null,$field = null)
    {
        $insertCount  = Yii::$app->db->createCommand()->batchInsert(SELF::tableName(), $field,
            $arr)->execute();
        return $insertCount;

    }
}
