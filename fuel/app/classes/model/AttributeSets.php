<?php
class Model_AttributeSets extends Orm\Model
{
    protected static $_primary_key=array('ID');
    protected static $_table_name = 'attribute_sets';
/*    protected static $_has_many = array(
        'products' => array(
            'key_from' => 'ID',
            'model_to' => 'Model_Products',
            'key_to' => 'group_id',
        ));*/
    protected static $_properties =
        array ('ID',
               'group_name'=>array('label' => 'Attribute Group Name', 'form'=>array('type'=>'text')),
              );
};
