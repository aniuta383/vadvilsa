<?php
class Model_Subcategories extends Orm\Model
{
   protected static $_primary_key = array('category_id');
    protected static $_table_name = 'categories';
    protected static $_properties =
        array ('category_id',
               'parent_ID'=>array('label' => 'Parent Category', 'form'=>array('type'=>'select', 'options'=>array())),
               'name'=>array('data_type'=>'varchar', 'label' => 'Category Name', 'validation' => array('required'), 'max_length'=>array(255), 'form' =>array ('type'=>'text')),
        );
}
