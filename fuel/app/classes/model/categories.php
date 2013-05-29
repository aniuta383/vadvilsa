<?php
class Model_Categories extends Orm\Model
{
    protected static $_primary_key = array('category_id');
    protected static $_table_name = 'categories';
    protected static $_many_many = array(
        'products' => array(
            'key_from' => 'category_id',
            'key_through_from' => 'category_id', // column 1 from the table in between, should match a posts.id
            'table_through' => 'products_categories', // both models plural without prefix in alphabetical order
            'key_through_to' => 'product_id', // column 2 from the table in between, should match a users.id
            'model_to' => 'Model_Products',
            'key_to' => 'product_id',
            'cascade_save' => true,
            'cascade_delete' => false,
        )
    );
    protected static $_properties =
        array ('category_id',
               'parent_ID'=>array('label' => 'Parent Category', 'form'=>array('type'=>'select', 'options'=>array())),
               'name'=>array('data_type'=>'varchar', 'label' => 'Category Name', 'validation' => array('required'), 'max_length'=>array(255), 'form' =>array ('type'=>'text')),
               'description' => array('data_type'=>'string','label'=>'Description', 'form'=>array('type'=>'textarea')),
        );
    public static function _init()
    {
        //$categories = Model_Subcategories::find('all', array('where' => array(array('parent_ID', 'IS', NULL))));
 /*       foreach ($categories as $cat)
        {
            static::$_properties['parent_ID']['form']['options']['NULL'] = 'Root Category';
            static::$_properties['parent_ID']['form']['options'][$cat->ID] = $cat->name;
        }*/
    }
};

