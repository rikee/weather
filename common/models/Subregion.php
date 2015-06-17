<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%subregion}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $short_title
 * @property integer $region_id
 * @property integer $status
 *
 * @property Location[] $locations
 * @property Region $region
 * @property string $statusString
 */
class Subregion extends \yii\db\ActiveRecord
{
    const STATUS_DELETED = 0;
    const STATUS_DISABLED = 2;
    const STATUS_ACTIVE = 10;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%subregion}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'region_id'], 'required'],
            [['region_id', 'status'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['short_title'], 'string', 'max' => 8],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
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
            'short_title' => 'Short Title',
            'region_id' => 'Region ID',
            'status' => 'Status',
            'regionTitle' => Yii::t('app', 'Region Title'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocations()
    {
        return $this->hasMany(Location::className(), ['subregion_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegion()
    {
        return $this->hasOne(Region::className(), ['id' => 'region_id']);
    }

    /**
     * @inheritdoc
     */
    public function getStatusString()
    {
        switch ($this->status)
        {
            case $this::STATUS_ACTIVE:
                return 'Active';
            case $this::STATUS_DISABLED:
                return 'Disabled';
            case $this::STATUS_DELETED:
                return 'Deleted';
            default:
                return 'Error';
        }
    }
}
