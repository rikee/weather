<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%contest_type}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $entry_fee
 * @property string $withheld
 * @property integer $min_players
 * @property integer $max_players
 * @property integer $structure_id
 * @property integer $status
 *
 * @property ContestCurrent[] $contestCurrents
 * @property Structure $structure
 * @property string $statusString
 */
class ContestType extends \yii\db\ActiveRecord
{
    const STATUS_DELETED = 0;
    const STATUS_DISABLED = 2;
    const STATUS_ACTIVE = 10;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%contest_type}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'entry_fee', 'withheld', 'min_players', 'max_players', 'structure_id'], 'required'],
            [['entry_fee', 'withheld'], 'number'],
            [['min_players', 'max_players', 'structure_id', 'status'], 'integer'],
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
            'entry_fee' => 'Entry Fee',
            'withheld' => 'Withheld',
            'min_players' => 'Min Players',
            'max_players' => 'Max Players',
            'structure_id' => 'Structure ID',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContestCurrents()
    {
        return $this->hasMany(ContestCurrent::className(), ['type_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStructure()
    {
        return $this->hasOne(Structure::className(), ['id' => 'structure_id']);
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
