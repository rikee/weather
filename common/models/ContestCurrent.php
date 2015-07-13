<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%contest_current}}".
 *
 * @property integer $id
 * @property string $title
 * @property integer $type_id
 * @property integer $category_id
 * @property integer $region_id
 * @property integer $status
 * @property integer $state
 * @property integer $recurring
 * @property integer $time
 *
 * @property Region $region
 * @property ContestType $type
 * @property ContestCategory $category
 * @property string $statusString
 */
class ContestCurrent extends ActiveRecord
{
    const STATUS_DELETED = 0;
    const STATUS_DISABLED = 2;
    const STATUS_ACTIVE = 10;

    const STATE_ANNOUNCED = 0;
    const STATE_REGISTERING = 2;
    const STATE_RUNNING = 4;
    const STATE_CANCELED = 8;
    const STATE_CONCLUDED = 10;

    const RECURRING_ONCE = 0;
    const RECURRING_DAILY = 3;
    const RECURRING_WEEKLY = 5;
    const RECURRING_MONTHLY = 7;

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
            [['title', 'type_id', 'category_id', 'region_id'], 'required'],
            [['type_id', 'category_id', 'region_id', 'state', 'status'], 'integer'],
            [['title'], 'string', 'max' => 255],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
            ['state', 'default', 'value' => self::STATE_ANNOUNCED],
            ['state', 'in', 'range' => [self::STATE_ANNOUNCED, self::STATE_CONCLUDED]],
            ['recurring', 'default', 'value' => self::RECURRING_ONCE],
            ['recurring', 'in', 'range' => [self::RECURRING_ONCE, self::RECURRING_MONTHLY]],
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
            'category_id' => 'Category ID',
            'region_id' => 'Region ID',
            'state' => 'State',
            'time' => 'Date',
            'recurring' => 'Frequency',
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(ContestCategory::className(), ['id' => 'category_id']);
    }

    /**
     * @inheritdoc
     */
    public function getStateString()
    {
        switch ($this->state)
        {
            case $this::STATE_ANNOUNCED:
                return 'Announced';
            case $this::STATE_REGISTERING:
                return 'Registering';
            case $this::STATE_RUNNING:
                return 'Running';
            case $this::STATE_CANCELED:
                return 'Canceled';
            case $this::STATE_CONCLUDED:
                return 'Concluded';
            default:
                return 'Error';
        }
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
     * @inheritdoc
     */
    public function getRecurringString()
    {
        switch ($this->recurring)
        {
            case $this::RECURRING_ONCE:
                return 'Once';
            case $this::RECURRING_DAILY:
                return 'Daily';
            case $this::RECURRING_WEEKLY:
                return 'Weekly';
            case $this::RECURRING_MONTHLY:
                return 'Monthly';
            default:
                return 'Error';
        }
    }
}
