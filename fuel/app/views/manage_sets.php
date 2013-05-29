<?php
if(Auth::member(100)){
    echo 'Create New Attribute Set';
    echo Html::anchor('attributeset/create',Asset::img('add-new.png', array('title' => 'Add Set')));
    ?>
<div class="set-list">
    <?php foreach ($sets as $set):
    echo $set['group_name'];
    echo Html::anchor('attributeset/edit/'.$set->set_id,Asset::img('edit.png', array('title' => 'Edit Set')));
    echo Html::anchor('attributeset/delete/'.$set->set_id,Asset::img('delete.png', array('title' => 'Delete Set')));
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