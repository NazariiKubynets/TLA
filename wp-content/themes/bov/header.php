<!doctype html>
<html id="top" <?php language_attributes() ?>>

<head>
    <meta charset=<?php bloginfo('charset'); ?>>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php wp_head(); ?>

    <style>
        <?php include "custom-styles.css" ?>
    </style>
</head>

<body <?php body_class(); ?>>
<?php

?>

<?php include "js/inline-js.php" ?>

<?php /*
<div class="preloader">
  <div class="preloader__inner">

  </div>
</div>
<?= getACFLogo('main-header__logo') ?>
*/ ?>

<?php
$header = get_field('header', 'option');
$contact = get_field('contact', 'option');
?>

<header class="main-header">
    <div class="main-header__menu ">
        <div class="main-header__container container">
            <a href="<?= home_url() ?>" class="main-header__logo">
                <?= wp_get_attachment_image($header['logo'], 'medium', 'img'); ?>
            </a>
            <div class="main-header__wrap mobile-menu--bg">
                <nav class="main-menu mobile-menu
                        mobile-menu--type-right">
                    <?php echo getMenu( 'header-menu', 'main-menu',
                        new HierarchyMenuWalker() );
                    ?>
                    <div class="main-menu__contact">
                        <p class="main-menu__info-text">contacts</p>
                        <a href="tel:<?= $contact['number_free'] ?>"
                           class="main-menu__contact-tel"
                           target="_blank"
                           rel="nofollow">
                            Toll Free USA: <?= $contact['number_free'] ?>
                        </a>
                        <a href="tel:<?= $contact['number_direct'] ?>"
                           class="main-menu__contact-tel"
                           target="_blank"
                           rel="nofollow">
                            Direct (Peru): <?= $contact['number_direct'] ?>
                        </a>
                        <a class="main-menu__btn btn btn--secondary" href="<?= $contact['link_buttons_secondary']['url'] ?>">
                            <?= $contact['link_buttons_secondary']['title'] ?>
                        </a>
                    </div>
                </nav>
            </div>
        </div>
        <button type="button" class="burger  main-header__burger" aria-label="Mobile menu toggle">
                    <span class="burger__inner">
                        <span class="burger__line"></span>
                    </span>
        </button>
    </div>


</header>

<main class="main-content">
