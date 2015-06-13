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
 * @property integer $status
 *
 * @property Region $region
 * @property ContestType $type
 */
class ContestCurrent extends \yii\db\ActiveRecord
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;

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
            [['type_id', 'category', 'region_id', 'status'], 'integer'],
            [['title'], 'string', 'max' => 255],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
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
            'status' => 'Status',
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
