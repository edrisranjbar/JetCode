<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <?php wp_head(); ?>
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/images/favicon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/style.css">
    <title>home</title>
</head>

<body>
    <main>
        <header>
            <nav class="menu">
                <?php echo JetCode_get_menu_items('primary'); ?>
            </nav>
        </header>