<?php
class Model_Attributes extends Orm\Model
{
    protected static $_primary_key=array('ID');
    protected static $_table_name = 'attributes';
    protected static $_belongs_to = array(
        'products' => array(
            'key_from' => 'set_id',
            'model_to' => 'Model_AttributeSets',
            'key_to' => 'ID',
        ));
    protected static $_properties =
        array ('ID',
               'name'=>array('label' => 'Attribute Group Name', 'form'=>array('type'=>'text'),
               'set_id'=>array('form'=>array('type'=>'select'))),
        );
};