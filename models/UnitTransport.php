<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ds_unit_transport".
 *
 * @property int $id
 * @property int $unit_id
 * @property int $transport_id
 *
 * @property Unit $unit
 * @property Transport $transport
 */
class UnitTransport extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ds_unit_transport';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['unit_id', 'transport_id'], 'required'],
            [['unit_id', 'transport_id'], 'integer'],
            [['unit_id', 'transport_id'], 'unique', 'targetAttribute' => ['unit_id', 'transport_id']],
            [['unit_id'], 'exist', 'skipOnError' => true, 'targetClass' => Unit::className(), 'targetAttribute' => ['unit_id' => 'id']],
            [['transport_id'], 'exist', 'skipOnError' => true, 'targetClass' => Transport::className(), 'targetAttribute' => ['transport_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'unit_id' => 'Unit ID',
            'transport_id' => 'Transport ID',
        ];
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
    public function getTransport()
    {
        return $this->hasOne(Transport::className(), ['id' => 'transport_id']);
    }
}
