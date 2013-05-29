<html xmlns="http://www.w3.org/1999/html">
<head>
<?php echo Asset::css('style.css');
    echo Asset::js('jquery-1.9.1.js');
    echo Asset::js('nicEdit.js');
    echo Asset::js('functions.js');
?>
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
            <div class="account">
                <?php if((! Auth::member(100)) && (!Auth::member(1))):?>
                <?php echo Html::anchor ('users/login', 'Login') ?>
                <?php echo Html::anchor('users/registration', 'Registration'); ?>
                <p><?php echo Session::get_flash("error")?></p>
                <?php else:?>
                <?php echo Html::anchor('cart/view', 'My cart'); ?>
                <?php echo Html::anchor ('users/logout', 'Logout'); ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="bottom-header">
            <div class="logo">
                <?php echo Html::anchor('main/index', Asset::img('ananas.png'))?>
            </div>
<?php if((Auth::member(100)) || (Auth::member(1)))
     echo Html::anchor('account/view', 'View account'); ?>
            <?php if(Auth::member(100)): ?>
            <div class="admin-panel">
                <?php echo Html::anchor('admin/redirect',Asset::img('admin.png')) ?>
                <div class="admin-text">
                <?php echo Html::anchor('admin/redirect','Admin') ?>
                </div>
            </div>
            <?php endif ?>
        </div>
    </div>
    <div class="contents">
        <?php echo $content; ?>
    </div>
    <div class="footer">
        <div class="all-rights">
            <p>All Rights Reserved. UAB Vadvilsa. 2013.</p>
        </div>
    </div>
</div>
</body>
<html>
