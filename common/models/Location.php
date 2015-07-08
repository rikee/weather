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
    const PAST_DATA_TABLE = '{{%location_past_data}}';

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
     * @param $date -   string format yyyy-mm-ddThh:mm:ss-code
     *                  code - 4 digit time zone offset code (ie 0700)
     * @param $lat - latitude
     * @param $lon - longitude
     * @return object - forecast historical object
     */
    public function getDateForecast($date, $lat = null, $lon = null)
    {
        $lat = is_null($lat) ? $this->lat : $lat;
        $lon = is_null($lon) ? $this->lon : $lon;
        $forecast = new ForecastIO(self::FORECAST_API_KEY, 'auto', 'en');
        return $forecast->getHistoricalConditions($lat, $lon, $date);
    }

    /**
     * imports all historical weather data from 01/01/2015 to yesterday for a location
     */
    public function importPastData()
    {
        $attributes = ['location_id','date','temp_max','temp_min','precip_intensity_max','precip_type','wind_speed','humidity','pressure'];
        $data = [];

        $start_date = '2015-01-01';
        $end_date = date('Y-m-d');
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

        Yii::$app->db->createCommand()->delete(self::PAST_DATA_TABLE, 'location_id = ' . $this->id)->execute();
        Yii::$app->db->createCommand()->batchInsert(self::PAST_DATA_TABLE, $attributes, $data)->execute();
    }

    public function importAllDayData($date)
    {
        $attributes = ['location_id','date','temp_max','temp_min','precip_intensity_max','precip_type','wind_speed','humidity','pressure'];
        $data = [];
        $locations = $this->find()->all();
        $date .= 'T12:00:00-0700';

        foreach ($locations as $location)
        {
            $dateForecast = $this->getDateForecast($date, $location->lat, $location->lon);

            $data[] = [
                $location->id,
                $date,
                round($dateForecast->getMaxTemperature(),0),
                round($dateForecast->getMinTemperature(),0),
                round($dateForecast->getMaxPrecipitationIntensity(),3),
                $dateForecast->getPrecipitationType(),
                round($dateForecast->getWindSpeed(),0),
                round($dateForecast->getHumidity(),2),
                round($dateForecast->getPressure(),0),
            ];
        };

        Yii::$app->db->createCommand()->batchInsert(self::PAST_DATA_TABLE, $attributes, $data)->execute();
    }

    /**
     * @param int $page
     * @param int $limit
     * @return array - objects containing data from each day
     */
    public function getPastData($page = 1, $limit = 0)
    {
        $sql =  'SELECT * FROM ' . self::PAST_DATA_TABLE .
                'WHERE location_id=' . $this->id;
        if ($limit > 0)
        {
            $sql .= ' LIMIT ' . ($limit);
            $sql .= ' OFFSET ' . ($page - 1) * $limit;
        }
        $query = Yii::$app->db->createCommand($sql);
        return $query->queryAll($fetchMode = \PDO::FETCH_OBJ);
    }
}
