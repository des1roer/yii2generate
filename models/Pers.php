<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ds_pers".
 *
 * @property int $id
 * @property string $name
 * @property int $lvl
 * @property int $money
 * @property int $race_id
 * @property int $page_id
 *
 * @property Race $race
 * @property Page $page
 * @property PersUnit[] $persUnits
 * @property UserPers[] $userPers
 * @property User[] $users
 */
class Pers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ds_pers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'money', 'race_id'], 'required'],
            [['lvl', 'money', 'race_id', 'page_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
            [['race_id'], 'exist', 'skipOnError' => true, 'targetClass' => Race::className(), 'targetAttribute' => ['race_id' => 'id']],
            [['page_id'], 'exist', 'skipOnError' => true, 'targetClass' => Page::className(), 'targetAttribute' => ['page_id' => 'id']],
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
            'money' => 'Money',
            'race_id' => 'Race ID',
            'page_id' => 'Page ID',
        ];
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
    public function getPage()
    {
        return $this->hasOne(Page::className(), ['id' => 'page_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersUnits()
    {
        return $this->hasMany(PersUnit::className(), ['pers_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserPers()
    {
        return $this->hasMany(UserPers::className(), ['pers_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['id' => 'user_id'])->viaTable('ds_user_pers', ['pers_id' => 'id']);
    }
}
