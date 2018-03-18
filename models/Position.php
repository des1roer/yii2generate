<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ds_position".
 *
 * @property int $id
 * @property string $name
 * @property string $alias
 *
 * @property PersUnit[] $persUnits
 * @property UnitPosition[] $unitPositions
 * @property Unit[] $units
 */
class Position extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ds_position';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'alias'], 'required'],
            [['name', 'alias'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'alias' => 'Alias',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersUnits()
    {
        return $this->hasMany(PersUnit::className(), ['position_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnitPositions()
    {
        return $this->hasMany(UnitPosition::className(), ['position_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnits()
    {
        return $this->hasMany(Unit::className(), ['id' => 'unit_id'])->viaTable('ds_unit_position', ['position_id' => 'id']);
    }
}
