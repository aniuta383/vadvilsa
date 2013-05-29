<?php
class Model_Attributes extends Orm\Model
{
    protected static $_primary_key=array('attribute_id');
    protected static $_table_name = 'attributes';
    protected static $_many_many = array(
        'attribute_sets' => array(
            'key_from' => 'attribute_id',
            'key_through_from' => 'attribute_id', // column 1 from the table in between, should match a posts.id
            'table_through' => 'attributes_and_sets', // both models plural without prefix in alphabetical order
            'key_through_to' => 'set_id', // column 2 from the table in between, should match a users.id
            'model_to' => 'Model_AttributeSets',
            'key_to' => 'set_id',
            'cascade_save' => true,
            'cascade_delete' => false,
        ),
        'products' => array(
            'key_from' => 'attribute_id',
            'key_through_from' => 'attribute_id', // column 1 from the table in between, should match a posts.id
            'table_through' => 'products_value', // both models plural without prefix in alphabetical order
            'key_through_to' => 'product_id', // column 2 from the table in between, should match a users.id
            'model_to' => 'Model_Products',
            'key_to' => 'product_id',
            'cascade_save' => true,
            'cascade_delete' => false,
        )
    );
    protected static $_properties =
        array ('attribute_id',
               'name'=>array(
                   'label' => 'Attribute Name',
                   'form'=>array(
                       'type'=>'text'
                   )
               ),
                'type' => array('form' => array('type' => 'select', 'options' => array('checkbox', 'def'))),
                   'options'
    );
};