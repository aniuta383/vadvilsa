<?php

foreach($cats AS $cat){
        ?> <ul><li><?php echo $cat['name'];?></li><?php
    if (isset($subcats[$cat['id']]))
    {
        foreach($subcats[$cat['id']] AS $p=>$c){
             ?> <ul class="subcats"><li> <?php echo $c['name'];?> </li></ul> <?php
        }
    }
    ?></ul><?php
}
/* foreach ($menu AS $perem){
echo '<h3><li сlass = "active">';
    echo \Html::anchor('categories/index/'.$perem->ID, $perem->name);
    echo '</li></h3><br/>';
} */
?>
<div class="products">
        <?php foreach($products as $product){
        echo $product['name'];
}
        ?>
</div>