<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%contest_category}}".
 *
 * @property integer $id
 * @property string $title
 * @property integer $status
 *
 * @property ContestCurrent[] $contestCurrents
 * @property string $statusString
 */
class ContestCategory extends \yii\db\ActiveRecord
{
    const STATUS_DELETED = 0;
    const STATUS_DISABLED = 2;
    const STATUS_ACTIVE = 10;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%contest_category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 255],
            [['status'], 'integer'],
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
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContestCurrents()
    {
        return $this->hasMany(ContestCurrent::className(), ['category_id' => 'id']);
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
