<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ds_pers_unit".
 *
 * @property int $id
 * @property int $pers_id
 * @property int $unit_id
 * @property int $position_id
 *
 * @property Pers $pers
 * @property Unit $unit
 * @property Position $position
 */
class PersUnit extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ds_pers_unit';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pers_id', 'unit_id', 'position_id'], 'required'],
            [['pers_id', 'unit_id', 'position_id'], 'integer'],
            [['pers_id', 'unit_id', 'position_id'], 'unique', 'targetAttribute' => ['pers_id', 'unit_id', 'position_id']],
            [['pers_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pers::className(), 'targetAttribute' => ['pers_id' => 'id']],
            [['unit_id'], 'exist', 'skipOnError' => true, 'targetClass' => Unit::className(), 'targetAttribute' => ['unit_id' => 'id']],
            [['position_id'], 'exist', 'skipOnError' => true, 'targetClass' => Position::className(), 'targetAttribute' => ['position_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pers_id' => 'Pers ID',
            'unit_id' => 'Unit ID',
            'position_id' => 'Position ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPers()
    {
        return $this->hasOne(Pers::className(), ['id' => 'pers_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnit()
    {
        return $this->hasOne(Unit::className(), ['id' => 'unit_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosition()
    {
        return $this->hasOne(Position::className(), ['id' => 'position_id']);
    }
}
