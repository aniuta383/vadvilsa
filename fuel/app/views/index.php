<div class="top-shadow"></div>
<div class="slider">
    <?php
        echo Asset::img('vartai1.jpg', array('class'=>'firstslide'));
        echo Asset::img('vartai2.jpg');
        echo Asset::img('vartai3.jpg');
        echo Asset::img('vartai4.jpg');
        echo Asset::img('vartai5.jpg');
        echo Asset::img('vartai6.jpg');
        echo Asset::img('vartai7.jpg');
    ?>
</div>
<div class="bottom-shadow"></div>
<?php if(Auth::member(100)): ?>
<div class="edit-firm">
    <h4>
        Edit information about firm
    </h4>
        <?php echo Html::anchor('info/edit', Asset::img('edit.png'))?>
</div>
<?php endif ?>
<div id="about">
    <?php
    $file = file_get_contents('/assets/files/info.txt', true);
    echo $file;
    ?>
</div>
