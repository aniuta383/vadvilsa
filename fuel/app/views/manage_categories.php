<?php
echo 'Create New Category';
echo Html::anchor('categories/create',Asset::img('add-new.png', array('title' => 'Add Category')));
if($msg)
    echo $msg;
?>
<div class="category-list">
    <?php foreach ($categories as $cats):
    echo $cats['name'];
    echo Html::anchor('categories/edit/'.$cats->category_id,Asset::img('edit.png', array('title' => 'Edit Category')));
    echo Html::anchor('categories/delete/'.$cats->category_id,Asset::img('delete.png', array('title' => 'Delete Category')));
    ?>
    </br>
    <?php endforeach; ?>
</div>
<button>
        <span>
            <?php echo Html::anchor ('admin/redirect', 'Go back!');?>
        </span>
</button>