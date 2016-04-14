<?php

namespace app\modules\dinamic\models;

use yii\helpers\Html;
use Yii;

/**
 * This is the model class for table "template".
 *
 * @property integer $id
 * @property string $name
 *
 * @property Data[] $datas
 * @property Element[] $elements
 * @property TemplateHasElement[] $templateHasElements
 * @property Element[] $elements0
 * @property Unit[] $units
 */
class Template extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'template';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
            [['element_list'], 'safe'],
        ];
    }

    public function behaviors()
    {
        return [

            [
                'class' => \voskobovich\behaviors\ManyToManyBehavior::className(),
                'relations' => [
                    'element_list' => 'element',
                ],
            ],
        ];
    }

    public function getElement()
    {
        return $this->hasMany(Element::className(), ['id' => 'element_id']) //ид из связной
                        ->viaTable('template_has_element', ['template_id' => 'id']);
    }

    public function getSubject_url($class = NULL)
    {
        if (empty($class))
            $class = 'element';
        $classes = $this->$class;
        for ($i = 0; $i <= count($classes); $i++)
        {
            if (!empty($classes[$i]['name']))
                $class_[] = Html::a($classes[$i]['name'], ['/dinamic/' . $class . '/view', 'id' => $classes[$i]['id'],], ['class' => 'btn btn-link']);
        }
        return ($class_) ? implode($class_) : '';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'element_list' => 'Элементы',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDatas()
    {
        return $this->hasMany(Data::className(), ['unit_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getElements()
    {
        return $this->hasMany(Element::className(), ['id' => 'element_id'])->viaTable('data', ['unit_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTemplateHasElements()
    {
        return $this->hasMany(TemplateHasElement::className(), ['template_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getElements0()
    {
        return $this->hasMany(Element::className(), ['id' => 'element_id'])->viaTable('template_has_element', ['template_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnits()
    {
        return $this->hasMany(Unit::className(), ['template_id' => 'id']);
    }

}
