<?php
/**
 * Created by JetBrains PhpStorm.
 * User: sunshine)
 * Date: 13.26.5
 * Time: 01:00
 * To change this template use File | Settings | File Templates.
 */

foreach($products AS $key => $product){
    echo $product->name.':'.$counts[$product->product_id].' ['.Html::anchor('cart/delete/'.$key, 'Delete').']<br>';
}