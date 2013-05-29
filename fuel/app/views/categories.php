<div class="categories">
<?php
foreach($cats AS $cat){
        ?> <ul class="cats"><li><?php echo \Html::anchor('categories/index/'.$cat['id'], $cat['name']);?></li><?php
    if (isset($subcats[$cat['id']]))
    {
        foreach($subcats[$cat['id']] AS $p=>$c){
             ?> <ul class="subcats"><li> <?php echo \Html::anchor('categories/index/'.$c['id'], $c['name']);?> </li></ul> <?php
        }
    }
    ?></ul><?php
}?></div>
<div class="clearfix"></div>
<div class="products">
        <?php foreach($products as $product){
        ?>
        <div class="product">
            <div class="image">
                <?php echo Asset::img(str_replace(".", "_small.", $product['image']));?>
            </div>
            <?php echo \Html::anchor('products/view/'.$product['product_id'], $product['name']);?>
            <button>
                <span>
                    <?php echo \Html::anchor('products/view/'.$product['product_id'], 'View more');?>
                </span>
            </button>
        </div><?php
}
        ?>
</div>