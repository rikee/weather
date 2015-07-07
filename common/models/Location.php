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

    /**
     * @param $date -   string format yyyy-mm-ddThh:mm:ss-code');
     *                  code - 4 digit time zone offset code (ie 0700)
     * @return object - forecast historical object
     */
    public function getDateForecast($date)
    {
        $forecast = new ForecastIO(self::FORECAST_API_KEY, 'auto', 'en');
        return $forecast->getHistoricalConditions($this->lat, $this->lon, $date);
    }

    /**
     * imports all historical weather data since 01/01/2015
     */
    public function importPastData()
    {
        $attributes = ['location_id','date','temp_max','temp_min','precip_intensity_max','precip_type','wind_speed','humidity','pressure'];
        $data = [];

        $start_date = '2015-01-01';
        $end_date = date('Y-m-d', strtotime("-1 day"));
        while(strtotime($start_date) < strtotime($end_date))
        {
            $date = $start_date . 'T12:00:00-0700';

            $dateForecast = $this->getDateForecast($date);
            $data[] = [
                $this->id,
                $start_date,
                round($dateForecast->getMaxTemperature(),0),
                round($dateForecast->getMinTemperature(),0),
                round($dateForecast->getMaxPrecipitationIntensity(),3),
                $dateForecast->getPrecipitationType(),
                round($dateForecast->getWindSpeed(),0),
                round($dateForecast->getHumidity(),2),
                round($dateForecast->getPressure(),0),
            ];
            $start_date = date('Y-m-d', strtotime("+1 day", strtotime($start_date)));
        };

        $pastDataTable = '{{%location_past_data}}';
        Yii::$app->db->createCommand()->delete($pastDataTable, 'location_id = ' . $this->id)->execute();
        Yii::$app->db->createCommand()->batchInsert($pastDataTable, $attributes, $data)->execute();
    }
}
