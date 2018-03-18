<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ds_page_btn".
 *
 * @property int $id
 * @property int $page_id
 * @property int $btn_id
 *
 * @property Btn $btn
 * @property Page $page
 */
class PageBtn extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ds_page_btn';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['page_id', 'btn_id'], 'required'],
            [['page_id', 'btn_id'], 'integer'],
            [['page_id', 'btn_id'], 'unique', 'targetAttribute' => ['page_id', 'btn_id']],
            [['btn_id'], 'exist', 'skipOnError' => true, 'targetClass' => Btn::className(), 'targetAttribute' => ['btn_id' => 'id']],
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
            'page_id' => 'Page ID',
            'btn_id' => 'Btn ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBtn()
    {
        return $this->hasOne(Btn::className(), ['id' => 'btn_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPage()
    {
        return $this->hasOne(Page::className(), ['id' => 'page_id']);
    }
}
