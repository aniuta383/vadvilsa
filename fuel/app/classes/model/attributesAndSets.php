<?php
class Model_AttributesAndSets extends \Orm\Model
{
    protected static $_primary_key = array('attribute_id', 'set_id');
    protected static $_table_name = 'attributes_and_sets';
    protected static $_properties = array(
        'attribute_id',
        'set_id',
    );
}
