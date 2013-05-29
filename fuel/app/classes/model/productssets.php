<?php
class Model_ProductsSets extends \Orm\Model
{
    protected static $_primary_key = array('product_id', 'set_id');
    protected static $_table_name = 'products_sets';
    protected static $_properties = array(
        'product_id',
        'set_id',
    );
}
