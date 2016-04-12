<?php

use yii\db\Migration;

class m160412_112956_init_dinamic extends Migration {

    public function safeUp()
    {
        $this->createTable('template', [
            'id' => $this->primaryKey(),
            'name' => $this->string('255')->notNull()->unique(),
        ]);
        $this->createTable('element', [
            'id' => $this->primaryKey(),
            'name' => $this->string('255')->notNull()->unique(),
        ]);
        $this->createTable('unit', [
            'id' => $this->primaryKey(),
            'name' => $this->string('255')->notNull()->unique(),
            'template_id' => $this->integer(),
        ]);
        $this->createIndex('idx-template_id_u', 'unit', 'template_id');
        $this->addForeignKey('fk-template_id_u', 'unit', 'template_id', 'template', 'id', 'CASCADE');

        $this->createTable('template_has_element', [
            'template_id' => $this->integer(),
            'element_id' => $this->integer(),
            'PRIMARY KEY(template_id, element_id)'
        ]);
        
        $this->createTable('data', [
            'unit_id' => $this->integer(),
            'element_id' => $this->integer(),
            'value' => $this->string(255),
            'PRIMARY KEY(unit_id, element_id)'
        ]);

        $this->createIndex('idx-unit_id', 'data', 'unit_id');
        $this->addForeignKey('fk-unit_id', 'data', 'unit_id', 'template', 'id', 'CASCADE');

        $this->createIndex('idx-element_id', 'data', 'element_id');
        $this->addForeignKey('fk-element_id', 'data', 'element_id', 'element', 'id', 'CASCADE');
        
        $this->createIndex('idx-template_id', 'template_has_element', 'template_id');
        $this->addForeignKey('fk-template_id', 'template_has_element', 'template_id', 'template', 'id', 'CASCADE');

        $this->createIndex('idx-element_id_te', 'template_has_element', 'element_id');
        $this->addForeignKey('fk-element_id_te', 'template_has_element', 'element_id', 'element', 'id', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropTable('template_has_element');
        $this->dropTable('data');
        $this->dropTable('element');
        $this->dropTable('unit');
        $this->dropTable('template');
    }

}
