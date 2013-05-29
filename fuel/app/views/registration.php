<div class="reg-form">
    <form action="/users/registration" method="post">
        <?php echo Form::label('Login: ', 'username');?>
        <input name="username" type="text">
        <?php echo Form::label('E-mail: ', 'email');?>
        <input type="text" name="email">
        <?php echo Form::label('Name: ', 'name');?>
        <input name="name" type="text">
        <?php echo Form::label('Surname: ', 'surname');?>
        <input name="surname" type="text">
        <?php echo Form::label('Phone: ', 'phone');?>
        <input name="phone" type="text">
        <?php echo Form::label('Password: ', 'password');?>
        <input name="password" type="password">
        <?php echo Form::label('Password again: ', 'password_2');?>
        <input type="password" name="password_2">
        <input type="submit" name="submit" value="<?php echo ("Sign up"); ?>">
    </form>
</div>

