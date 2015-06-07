<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%contest_current}}".
 *
 * @property integer $id
 * @property string $title
 * @property integer $type_id
 * @property integer $category
 * @property integer $region_id
 *
 * @property Region $region
 * @property ContestType $type
 */
class ContestCurrent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%contest_current}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'type_id', 'category', 'region_id'], 'required'],
            [['type_id', 'category', 'region_id'], 'integer'],
            [['title'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'type_id' => 'Type ID',
            'category' => 'Category',
            'region_id' => 'Region ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegion()
    {
        return $this->hasOne(Region::className(), ['id' => 'region_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(ContestType::className(), ['id' => 'type_id']);
    }
}
