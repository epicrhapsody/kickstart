<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta http-equiv="x-ua-compatible" content="ie=edge">

        <title><?php bloginfo( 'name' ); ?> - <?php bloginfo( 'description' ); ?></title>
        <meta name="description" content="">
        <meta name="keywords" content="">

        <meta name="rights" content="" />
        <meta name="author" content="" />
        <meta name="robots" content="index, follow" />

        <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=yes">

        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="mobile-web-app-title" content="Kickstart">

        <link rel="apple-touch-icon" href="<?php echo esc_url( get_template_directory_uri() ); ?>/apple-touch-icon.png" />
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo esc_url( get_template_directory_uri() ); ?>/favicon.ico" />

        <?php wp_head(); ?>
        <link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/style.css">

        <script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/modernizr-2.8.3.min.js"></script>
    </head>
    <body <?php body_class(); ?>>
