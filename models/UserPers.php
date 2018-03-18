<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ds_user_pers".
 *
 * @property int $id
 * @property int $user_id
 * @property int $pers_id
 *
 * @property Pers $pers
 * @property User $user
 */
class UserPers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ds_user_pers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'pers_id'], 'required'],
            [['user_id', 'pers_id'], 'integer'],
            [['user_id', 'pers_id'], 'unique', 'targetAttribute' => ['user_id', 'pers_id']],
            [['pers_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pers::className(), 'targetAttribute' => ['pers_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'pers_id' => 'Pers ID',
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
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
