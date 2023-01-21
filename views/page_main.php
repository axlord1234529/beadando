<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Title</title>
    <link rel="stylesheet" type="text/css" href="<?php echo SITE_ROOT?>css/main_style.css">
    <?php if($viewData['style']) echo '<link rel="stylesheet" type="text/css" href="'.$viewData['style'].'">'; ?>
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Petit+Formal+Script&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Petit+Formal+Script&display=swap" rel="stylesheet">
</head>
<body>
<header class="main-header">
    <div class="logo">Süti Factory</div>
    <div class="hamburger">
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
    </div>
    <nav class="nav-bar">
        <?php echo Menu::getMenu($viewData['selectedItems']); ?>
    </nav>
</header>
<div id="user"><em><?php  if($_SESSION['userid'] != 0) echo "Bejelentkezett: ".$_SESSION['userlastname']." ".$_SESSION['userfirstname']." (".$_SESSION['username'].")"; ?></em></div>
<section>
    <?php if($viewData['render']) include($viewData['render']); ?>
</section>
<footer id="footer">&copy; don't know yet <?= date("Y") ?></footer>
<script src="<?php echo SITE_ROOT?>scripts/main.js"></script>
</body>
</html>