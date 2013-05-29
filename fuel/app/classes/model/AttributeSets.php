<?php
class Model_AttributeSets extends Orm\Model
{
    protected static $_primary_key=array('set_id');
    protected static $_table_name = 'attribute_sets';
    protected static $_many_many = array(
        'products' => array(
            'key_from' => 'set_id',
            'key_through_from' => 'set_id', // column 1 from the table in between, should match a posts.id
            'table_through' => 'products_sets', // both models plural without prefix in alphabetical order
            'key_through_to' => 'product_id', // column 2 from the table in between, should match a users.id
            'model_to' => 'Model_Products',
            'key_to' => 'product_id',
            'cascade_save' => true,
            'cascade_delete' => false,
        ),
        'attributes' => array(
            'key_from' => 'set_id',
            'key_through_from' => 'set_id', // column 1 from the table in between, should match a posts.id
            'table_through' => 'attributes_and_sets', // both models plural without prefix in alphabetical order
            'key_through_to' => 'attribute_id', // column 2 from the table in between, should match a users.id
            'model_to' => 'Model_Attributes',
            'key_to' => 'attribute_id',
            'cascade_save' => true,
            'cascade_delete' => false,
        )
    );
    protected static $_properties =
        array ('set_id',
               'group_name'=>array('label' => 'Attribute Group Name', 'form'=>array('type'=>'text')),
              );
};
