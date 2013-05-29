<?php
class Model_Products extends Orm\Model
{
    protected static $_primary_key=array('product_id');
    protected static $_table_name = 'products';
    protected  static $_many_many = array(
        'categories' => array(
            'key_from' => 'product_id',
            'key_through_from' => 'product_id', // column 1 from the table in between, should match a posts.id
            'table_through' => 'products_categories', // both models plural without prefix in alphabetical order
            'key_through_to' => 'category_id', // column 2 from the table in between, should match a users.id
            'model_to' => 'Model_Categories',
            'key_to' => 'category_id',
            'cascade_save' => true,
            'cascade_delete' => false,
        ),
        'attributes' => array(
            'key_from' => 'product_id',
            'key_through_from' => 'product_id', // column 1 from the table in between, should match a posts.id
            'table_through' => 'products_value', // both models plural without prefix in alphabetical order
            'key_through_to' => 'attribute_id', // column 2 from the table in between, should match a users.id
            'model_to' => 'Model_Attributes',
            'key_to' => 'attribute_id',
            'cascade_save' => true,
            'cascade_delete' => false,
        ),
        'attribute_sets' => array(
            'key_from' => 'product_id',
            'key_through_from' => 'product_id', // column 1 from the table in between, should match a posts.id
            'table_through' => 'products_sets', // both models plural without prefix in alphabetical order
            'key_through_to' => 'set_id', // column 2 from the table in between, should match a users.id
            'model_to' => 'Model_AttributeSets',
            'key_to' => 'set_id',
            'cascade_save' => true,
            'cascade_delete' => false,
        ));
    protected static $_properties =
        array ('product_id' ,
               'name' => array('data_type'=>'varchar', 'label' => 'Product Name', 'validation' => array('required'), 'max_length'=>array(255), 'form' =>array ('type'=>'text')),
               'price',
                'image' => array('crop_resize', 200, 200)
        );
};

