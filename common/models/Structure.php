<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%structures}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $structure
 *
 * @property ContestTypes[] $contestTypes
 */
class Structure extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%structures}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'structure'], 'required'],
            [['structure'], 'string'],
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
            'structure' => 'Structure',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContestTypes()
    {
        return $this->hasMany(ContestTypes::className(), ['structure_id' => 'id']);
    }
}
