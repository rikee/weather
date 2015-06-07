<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%contest_types}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $entry_fee
 * @property string $withheld
 * @property integer $min_players
 * @property integer $max_players
 * @property integer $structure_id
 *
 * @property Structures $structure
 */
class ContestType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%contest_types}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'entry_fee', 'withheld', 'min_players', 'max_players', 'structure_id'], 'required'],
            [['entry_fee', 'withheld'], 'number'],
            [['min_players', 'max_players', 'structure_id'], 'integer'],
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
            'entry_fee' => 'Entry Fee',
            'withheld' => 'Withheld',
            'min_players' => 'Min Players',
            'max_players' => 'Max Players',
            'structure_id' => 'Structure ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStructure()
    {
        return $this->hasOne(Structures::className(), ['id' => 'structure_id']);
    }
}
