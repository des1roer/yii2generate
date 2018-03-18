<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ds_btn".
 *
 * @property int $id
 * @property string $link
 * @property int $sort
 * @property string $img
 *
 * @property PageBtn[] $pageBtns
 * @property Page[] $pages
 */
class Btn extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ds_btn';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sort'], 'integer'],
            [['link', 'img'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'link' => 'Link',
            'sort' => 'Sort',
            'img' => 'Img',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPageBtns()
    {
        return $this->hasMany(PageBtn::className(), ['btn_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPages()
    {
        return $this->hasMany(Page::className(), ['id' => 'page_id'])->viaTable('ds_page_btn', ['btn_id' => 'id']);
    }
}
