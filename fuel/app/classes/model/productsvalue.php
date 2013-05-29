<?php
class Model_ProductsValue extends \Orm\Model
{
    protected static $_primary_key = array('product_id', 'attribute_id');
    protected static $_table_name = 'products_value';
    protected static $_properties = array(
        'product_id',
        'attribute_id',
        'value'=>array(
            'label' => 'Value',
            'form'=>array(
                'type'=>'text'
            ))
    );
    protected static $_belongs_to = array(
        'attributes' => array(
            'key_from' => 'attribute_id',
            'model_to' => 'Model_Attributes',
            'key_to' => 'attribute_id',
        ));
}
