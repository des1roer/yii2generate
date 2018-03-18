<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ds_transport".
 *
 * @property int $id
 * @property string $name
 * @property int $lvl
 * @property int $price
 * @property string $description
 * @property string $img
 * @property string $params
 *
 * @property UnitTransport[] $unitTransports
 * @property Unit[] $units
 */
class Transport extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ds_transport';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['lvl', 'price'], 'integer'],
            [['name', 'img', 'params'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 511],
            [['name'], 'unique'],
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
            'lvl' => 'Lvl',
            'price' => 'Price',
            'description' => 'Description',
            'img' => 'Img',
            'params' => 'Params',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnitTransports()
    {
        return $this->hasMany(UnitTransport::className(), ['transport_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnits()
    {
        return $this->hasMany(Unit::className(), ['id' => 'unit_id'])->viaTable('ds_unit_transport', ['transport_id' => 'id']);
    }
}
