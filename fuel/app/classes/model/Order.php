<?php
class Model_Order extends Orm\Model
{
    protected static $_primary_key=array('ID');
    protected static $_table_name = 'orders';
    protected static $_belongs_to = array(
        'users' => array(
            'key_from' => 'user_id',
            'model_to' => 'Model_Users',
            'key_to' => 'ID',
        ));
    protected static $_has_many = array(
        'orderproducts'=>array(
            'key_from'=>'ID',
            'model_to'=>'OrderProducts',
            'key_to'=>'order_id'
        )
    );
    protected static $_properties = array (
            'ID' ,
            'user_id'
        );
};
