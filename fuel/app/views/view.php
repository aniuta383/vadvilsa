<table class="user">
    <tr>
        <td class="label">
            Username
        </td>
        <td>
            <?php echo $data['username']; ?>
        </td>
    </tr>
    <tr>
        <td class="label">
            E-mail
        </td>
        <td>
            <?php echo $data['email']; ?>
        </td>
    </tr>
    <tr>
        <td class="label">
            Group
        </td>
        <td>
            <?php echo $data['group']; ?>
        </td>
    </tr>
    <tr>
        <td class="label">
            Name
        </td>
        <td>
            <?php echo $data['name']; ?>
        </td>
    </tr>
    <tr>
        <td class="label">
            Surname
        </td>
        <td>
            <?php echo $data['surname']; ?>
        </td>
    </tr>
    <tr>
        <td class="label">
            Phone
        </td>
        <td>
            <?php echo $data['phone']; ?>
        </td>
    </tr>
    <tr>
        <td class="label">
            Last login
        </td>
        <td>
            <?php echo Date::forge($data['last_login'])->format("%m/%d/%Y %H:%M"); ?>
        </td>
    </tr>
    <tr>
        <td class="label">
            Registered
        </td>
        <td>
            <?php
                echo Date::forge($data['created_at'])->format("%m/%d/%Y %H:%M"); ?>
        </td>
    </tr>
</table>
<?php
if($data['my_profile']): ?>
    <button>
            <span>
       <?php echo Html::anchor('account/edit', 'Edit my profile data', array('class' => 'edit-profile'));?>
            </span>
    </button>
<button>
            <span>
       <?php echo Html::anchor('account/delete', 'Delete my profile', array('class' => 'edit-profile'));?>
            </span>
</button>
<?php endif; ?>
