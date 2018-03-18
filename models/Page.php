<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ds_page".
 *
 * @property int $id
 * @property string $name
 * @property string $txt
 * @property string $link
 * @property string $img
 * @property int $type_id
 * @property int $parent_id
 *
 * @property PageType $type
 * @property Page $parent
 * @property Page[] $pages
 * @property PageBtn[] $pageBtns
 * @property Btn[] $btns
 * @property Pers[] $pers
 */
class Page extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ds_page';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'txt', 'type_id'], 'required'],
            [['type_id', 'parent_id'], 'integer'],
            [['name', 'link', 'img'], 'string', 'max' => 255],
            [['txt'], 'string', 'max' => 1023],
            [['name'], 'unique'],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => PageType::className(), 'targetAttribute' => ['type_id' => 'id']],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Page::className(), 'targetAttribute' => ['parent_id' => 'id']],
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
            'txt' => 'Txt',
            'link' => 'Link',
            'img' => 'Img',
            'type_id' => 'Type ID',
            'parent_id' => 'Parent ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(PageType::className(), ['id' => 'type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Page::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPages()
    {
        return $this->hasMany(Page::className(), ['parent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPageBtns()
    {
        return $this->hasMany(PageBtn::className(), ['page_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBtns()
    {
        return $this->hasMany(Btn::className(), ['id' => 'btn_id'])->viaTable('ds_page_btn', ['page_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPers()
    {
        return $this->hasMany(Pers::className(), ['page_id' => 'id']);
    }
}
