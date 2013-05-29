<?php
echo Form::open(array('enctype' => 'multipart/form-data'));
echo Form::file('image');
foreach($attributes AS $attr){
    echo $attr->name;
    switch($attr->type){
        case 'checkbox':
            $options = explode(",", $attr->options);
            foreach($options AS $opt){
                echo "<input name='attr[".$attr->attribute_id."][]' type=checkbox value='".$opt."'> ".$opt."</br>";
            }
        break;
        default:
            echo "<input type='text' name='attr[".$attr->attribute_id."]'><br>";
    }
}
echo Form::submit();
echo Form::close();