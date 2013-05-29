<?php
foreach ($description as $desc){
    ?>
    <div class='cat-name'>
        <?php echo $desc['name']?>
    </div>
    <div class='cat-desc'>
        <?php echo $desc['description']?>
    </div><?php
}