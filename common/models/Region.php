<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%region}}".
 *
 * @property integer $id
 * @property string $title
 * @property integer $parent_region_id
 * @property integer $status
 *
 * @property ContestCurrent[] $contestCurrents
 * @property Subregion[] $subregions
 * @property Region $parentRegion
 * @property string $statusString
 */
class Region extends \yii\db\ActiveRecord
{
    const STATUS_DELETED = 0;
    const STATUS_DISABLED = 2;
    const STATUS_ACTIVE = 10;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%region}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['parent_region_id', 'status'], 'integer'],
            [['title'], 'string', 'max' => 255],
            ['parent_region_id', 'compare', 'compareAttribute' => 'id', 'operator' => '!='],
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
            'parent_region_id' => 'Parent Region ID',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContestCurrents()
    {
        return $this->hasMany(ContestCurrent::className(), ['region_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubregions()
    {
        return $this->hasMany(Subregion::className(), ['region_id' => 'id']);
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
     * @return \yii\db\ActiveQuery
     */
    public function getParentRegion()
    {
        $parent = $this->hasOne(Region::className(), ['id' => 'parent_region_id']);
        return $parent;
    }
}
