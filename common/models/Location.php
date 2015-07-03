<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
include(Yii::getAlias('@common').'/helpers/forecast.io.php');
use common\helpers\ForecastIO;

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
 * @property string $statusString
 */
class Location extends ActiveRecord
{
    const STATUS_DELETED = 0;
    const STATUS_DISABLED = 2;
    const STATUS_ACTIVE = 10;
    const FORECAST_API_KEY = 'f9d7bea49e2a6a5375c78767674f0b67';

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

    public function getPastDataSingle()
    {
        $forecast = new ForecastIO(self::FORECAST_API_KEY, 'auto', 'en');
        $condition = $forecast->getHistoricalConditions($this->lat, $this->lon, '2011-04-13T19:00:00-0700');
        echo "precip intensity - " . $condition->getPrecipitationIntensity();
        echo "<br>max precip intensity - " . $condition->getMaxPrecipitationIntensity();
        echo "<br>pressure - " . $condition->getPressure();
        echo "<br>max temperature - " . $condition->getMaxTemperature();
        //echo "<pre>";var_dump($condition);die;
    }
}
