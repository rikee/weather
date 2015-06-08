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
            [['short_title'], 'string', 'max' => 8]
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
            'regionTitle' => Yii::t('app', 'Region Title')
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

    public function getStatusString() {
        switch($this->status)
        {
            case '10':
                return 'active';
            case '0':
                return 'disabled';
            default:
                return 'error';
        }
    }
}
