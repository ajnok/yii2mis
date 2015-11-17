<?php

namespace backend\models;

use Yii;

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
            [['inserted_at'], 'safe'],
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
}
