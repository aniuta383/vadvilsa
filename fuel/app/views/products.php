<?php
    echo $product['name'];
    echo Asset::img($product['image']);
echo "<pre>";
function print_value($type, $value){
    if($type == 'def')
        return $value;
    if(strpos($value, ',') !== false){
        $k = explode(",", $value);
        $data = '<select>';
        foreach($k AS $u){
            $data .= '<option>'.$u.'</option>';
        }
        $data .= '</select>';
        return $data;
    } else {
        return $value;
    }
}
foreach($attr AS $a){
    echo $a['attributes']['name'].': '.print_value($a['attributes']['type'], $a->value);
}
echo Html::anchor('cart/add/'.$product['product_id'], 'Add to cart');