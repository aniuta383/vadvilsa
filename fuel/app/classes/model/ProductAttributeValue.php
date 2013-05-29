<?php
class Model_ProductsValue extends Orm\Model
{
    protected static $_primary_key=array('ID');
    protected static $_table_name = 'products_value';
    protected static $_belongs_to = array(
        'products' => array(
            'key_from' => 'product_id',
            'model_to' => 'Model_Products',
            'key_to' => 'ID'),
        'attributes' => array(
            'key_from' => 'attribute_id',
            'model_to' => 'Model_Attributes',
            'key_to' => 'ID',
        ));
    protected static $_properties =
        array ('ID',
               'product_id',
               'attribute_id',
               'value'=>array(
                   'label' => 'Value',
                   'form'=>array(
                       'type'=>'text'
                   )
               ),
        );
};