<?php

namespace app\modules\dinamic\models;

use Yii;
use app\modules\dinamic\controllers\Query;

/**
 * This is the model class for table "unit".
 *
 * @property integer $id
 * @property string $name
 * @property integer $template_id
 *
 * @property Template $template
 */
class Unit extends \yii\db\ActiveRecord {

    const template = 'book';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'unit';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['template_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
            [['template_id'], 'exist', 'skipOnError' => true, 'targetClass' => Template::className(), 'targetAttribute' => ['template_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'template_id' => 'Шаблон',
        ];
    }

    public function getAll_elem($elem = NULL)
    {
        $command = Yii::$app->db->createCommand("SELECT e.id,
                                                        e.name
                                                 FROM element e,
                                                      TEMPLATE t,
                                                               template_has_element te
                                                 WHERE t.`id` = te.`template_id`
                                                   AND te.`element_id` = e.id
                                                   AND t.name = '$elem'");
        $elem = $command->queryAll();

        if (!empty($elem))
            foreach ($elem as $key => $value)
            {
                $all[$key] = ['id' => $value['id'], 'name' => $value['name'],];
            }
        return ($all) ? $all : null;
    }

    public function getAll_value($unit_id = NULL)
    {
        if ($unit_id)
            $elem = Data::find()->select('element_id, value')
                    ->where('unit_id = :unit_id', [':unit_id' => $unit_id])
                    ->all();
        else
            $elem = Data::find()->select('element_id, value, unit_id')
                    ->all();

        if (!empty($elem))
            if (!$unit_id)
                foreach ($elem as $key => $value)
                {
                    $all[$value->unit_id][$value->element_id] = $value->value;
                }
            else
                foreach ($elem as $key => $value)
                {
                    $all[$value->element_id] = $value->value;
                }

        return ($all) ? $all : null;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTemplate()
    {
        return $this->hasOne(Template::className(), ['id' => 'template_id']);
    }

    public function getTemplate_id($name)
    {
        return $name = Template::find()->select('id')
                        ->where('name = :name', [':name' => $name])
                        ->scalar();
       
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert))
        {
            return true;
        }
        return false;
    }

}
