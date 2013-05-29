<?php
if(count($errors)):
    ?>
<div class="error">
    <?php
    foreach($errors AS $error)
        echo "* ".$error." <br />";
    ?>
</div>
<?php
endif;
?>

<?php
echo Form::open();
?>
<table class="edit_profile">
    <tr>
        <td class="label">
            E-mail
        </td>
        <td>
            <?php echo Form::input('email', $data['email']); ?>
        </td>
    </tr>
    <tr>
    <td class="label">
        Name
    </td>
    <td>
        <?php echo Form::input('name', $data['name']); ?>
    </td>
    </tr>
    <tr>
    <td class="label">
        Surname
    </td>
    <td>
        <?php echo Form::input('surname', $data['surname']); ?>
    </td>
    </tr>
    <tr>
        <td class="label">
            Phone
        </td>
        <td>
            <?php echo Form::input('phone', $data['phone']); ?>
        </td>
    </tr>
    <tr>
        <td colspan="2" class="hr">
        </td>
    </tr>
    <tr>
        <td class="label">
            Old password
        </td>
        <td>
            <?php echo Form::input('password_old', '', array('type' => 'password')); ?>
        </td>
    </tr>
    <tr>
        <td class="label">
            New password
        </td>
        <td>
            <?php echo Form::input('password_new', '', array('type' => 'password')); ?>
        </td>
    </tr>
    <tr>
        <td class="label">
            Repeat password
        </td>
        <td>
            <?php echo Form::input('password_2', '', array('type' => 'password')); ?>
        </td>
    </tr>
</table>
<div class="edit-profile">
    <button>
            <span>
                <?php echo Form::submit('', 'Save');?>

            </span>
    </button>
    <button>
        <span>
           <?php echo Form::reset('', 'Reset');?>
        </span>
    </button>
</div>
<?php echo Form::close(); ?>