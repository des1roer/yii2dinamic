<?php

namespace app\modules\dinamic\models;

use Yii;

/**
 * This is the model class for table "data".
 *
 * @property integer $unit_id
 * @property integer $element_id
 * @property string $value
 *
 * @property Element $element
 * @property Template $unit
 */
class Data extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'data';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['unit_id', 'element_id'], 'required'],
            [['unit_id', 'element_id'], 'integer'],
            [['value'], 'string', 'max' => 255],
            [['element_id'], 'exist', 'skipOnError' => true, 'targetClass' => Element::className(), 'targetAttribute' => ['element_id' => 'id']],
            [['unit_id'], 'exist', 'skipOnError' => true, 'targetClass' => Template::className(), 'targetAttribute' => ['unit_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'unit_id' => 'Unit ID',
            'element_id' => 'Element ID',
            'value' => 'Value',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getElement()
    {
        return $this->hasOne(Element::className(), ['id' => 'element_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnit()
    {
        return $this->hasOne(Template::className(), ['id' => 'unit_id']);
    }
}
