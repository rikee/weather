<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%structure}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $structure
 * @property integer $status
 *
 * @property ContestType[] $contestTypes
 */
class Structure extends \yii\db\ActiveRecord
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%structure}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'structure'], 'required'],
            [['structure'], 'string'],
            [['status'], 'integer'],
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
            'structure' => 'Structure',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContestTypes()
    {
        return $this->hasMany(ContestType::className(), ['structure_id' => 'id']);
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
