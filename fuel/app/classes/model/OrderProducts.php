<?php
class Model_OrderProducts extends Orm\Model
{
    protected static $_primary_key=array('ID');
    protected static $_table_name = 'order_products';
    protected static $_belongs_to = array(
        'products' => array(
            'key_from' => 'product_ID',
            'model_to' => 'Model_Products',
            'key_to' => 'ID',
        ));
    protected static $_properties =
        array ('ID' ,
               'product_id',
               'order_id'
        );
}
