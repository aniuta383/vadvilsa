<?php
class Model_ProductsCategories extends \Orm\Model
{
    protected static $_primary_key = array('product_id', 'category_id');
    protected static $_table_name = 'products_categories';
    protected static $_properties = array(
        'product_id',
        'category_id',
    );
}