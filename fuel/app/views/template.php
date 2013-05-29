<html>
<head>
<?php echo Asset::css('style.css')?>
<title><?php echo $title;?> </title>
</head>
<body>
<div class="content">
    <div class="header">
        <div class="top-header">
            <div class="anchors">
                <?php echo Html::anchor('main/index', 'Home') ?>
                <?php echo Html::anchor ('categories/index', 'Reservation')?>
            </div>
            <div class="top-links">
                <?php echo Html::anchor('http://www.facebook.com', Asset::img('facebook.png'))?>
                <?php echo Html::anchor('http://www.twitter.com', Asset::img('twitter.png'))?>
                <?php echo Html::anchor('http://www.youtube.com', Asset::img('youtube.png'))?>
            </div>
        </div>
        <div class="account">
            <?php echo Html::anchor('users/registration', 'Registration') ?>
            <?php echo Html::anchor ('users/login', 'Login')?>
            <?php echo Html::anchor ('users/logout', 'Logout')?>
            <p><?php echo Session::get_flash("error")?></p>
        </div>
        <div class="logo">
            <?php echo Html::anchor('main/index', Asset::img('ananas.png'))?>
        </div>
    </div>
    <div class="content">
        <?php echo $content; ?>
    </div>
</div>
</body>
<html>
