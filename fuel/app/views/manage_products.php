<?php
if(Auth::member(100)){
    echo 'Create New Product';
    echo Html::anchor('products/create',Asset::img('add-new.png', array('title' => 'Add Product')));
    ?>
<div class="product-list">
    <?php foreach ($products as $prod):
    echo $prod['name'];
    echo Html::anchor('products/edit/'.$prod->product_id,Asset::img('edit.png', array('title' => 'Edit Product')));
    echo Html::anchor('products/delete/'.$prod->product_id,Asset::img('delete.png', array('title' => 'Delete Product')));
    ?>
    </br>
    <?php endforeach; ?>
</div>
<?php
}?>
<button>
        <span>
            <?php echo Html::anchor ('admin/redirect', 'Go back!');?>
        </span>
</button>