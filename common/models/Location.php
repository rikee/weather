<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%location}}".
 *
 * @property integer $id
 * @property string $title
 * @property double $lat
 * @property double $lon
 * @property integer $subregion_id
 * @property integer $status
 *
 * @property Subregion $subregion
 */
class Location extends \yii\db\ActiveRecord
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%location}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'lat', 'lon', 'subregion_id'], 'required'],
            [['lat', 'lon'], 'number'],
            [['subregion_id', 'status'], 'integer'],
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
            'lat' => 'Lat',
            'lon' => 'Lon',
            'subregion_id' => 'Subregion ID',
            'status' => 'Status',
            'subregionTitle' => Yii::t('app', 'Subregion Title'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubregion()
    {
        return $this->hasOne(Subregion::className(), ['id' => 'subregion_id']);
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
