<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body class="bg-dark">
    <header>
        <span class="humberger-menu">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
        </span>
        <nav class="menu">
            <?php if (function_exists('the_custom_logo')) {
                the_custom_logo();
            }
            ?>
            <?php
            echo JetCode_get_menu_items('primary');
            ?>
        </nav>
        <img src="<?php echo get_template_directory_uri() . '/assets/' ?>images/Mobile_Menu_footer.svg" class="menu_footer">
    </header>