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
            'lat' => 'Lat',
            'lon' => 'Lon',
            'subregion_id' => 'Subregion ID',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubregion()
    {
        return $this->hasOne(Subregion::className(), ['id' => 'subregion_id']);
    }
}
