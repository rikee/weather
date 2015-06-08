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
}
