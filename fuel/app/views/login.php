<div class="log-form">
    <form action="/users/login" method="post">
        <?php echo Form::label('Login: ', 'username');?>
        <input name="username" type="text">
        <?php echo Form::label('Password: ', 'password');?>
        <input name="password" type="password">
        <input type="submit" name="submit" value="<?php echo ("Sign up"); ?>">
    </form>
</div>