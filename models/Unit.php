<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ds_unit".
 *
 * @property int $id
 * @property string $name
 * @property int $hp
 * @property int $atk
 * @property string $img
 * @property int $race_id
 * @property array $atk_param
 * @property int $parent_id
 *
 * @property PersUnit[] $persUnits
 * @property Race $race
 * @property Unit $parent
 * @property Unit[] $units
 * @property UnitPosition[] $unitPositions
 * @property Position[] $positions
 * @property UnitTransport[] $unitTransports
 * @property Transport[] $transports
 */
class Unit extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ds_unit';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'race_id'], 'required'],
            [['hp', 'atk', 'race_id', 'parent_id'], 'integer'],
            [['atk_param'], 'string'],
            [['name', 'img'], 'string', 'max' => 255],
            [['name'], 'unique'],
            [['race_id'], 'exist', 'skipOnError' => true, 'targetClass' => Race::className(), 'targetAttribute' => ['race_id' => 'id']],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Unit::className(), 'targetAttribute' => ['parent_id' => 'id']],
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
            'hp' => 'Hp',
            'atk' => 'Atk',
            'img' => 'Img',
            'race_id' => 'Race ID',
            'atk_param' => 'Atk Param',
            'parent_id' => 'Parent ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersUnits()
    {
        return $this->hasMany(PersUnit::className(), ['unit_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRace()
    {
        return $this->hasOne(Race::className(), ['id' => 'race_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Unit::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnits()
    {
        return $this->hasMany(Unit::className(), ['parent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnitPositions()
    {
        return $this->hasMany(UnitPosition::className(), ['unit_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPositions()
    {
        return $this->hasMany(Position::className(), ['id' => 'position_id'])->viaTable('ds_unit_position', ['unit_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnitTransports()
    {
        return $this->hasMany(UnitTransport::className(), ['unit_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransports()
    {
        return $this->hasMany(Transport::className(), ['id' => 'transport_id'])->viaTable('ds_unit_transport', ['unit_id' => 'id']);
    }
}
