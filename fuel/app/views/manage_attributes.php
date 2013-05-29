<?php
if(Auth::member(100)){
    echo 'Create New Attribute';
    echo Html::anchor('attribute/create',Asset::img('add-new.png', array('title' => 'Add Attribute')));
    ?>
<div class="set-list">
    <?php foreach ($attributes as $attribute):
    echo $attribute['name'];
    echo Html::anchor('attribute/edit/'.$attribute->attribute_id,Asset::img('edit.png', array('title' => 'Edit Attribute')));
    echo Html::anchor('attribute/delete/'.$attribute->attribute_id,Asset::img('delete.png', array('title' => 'Delete Attribute')));
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