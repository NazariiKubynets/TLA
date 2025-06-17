<!doctype html>
<html id="top" <?php language_attributes() ?>>

<head>
    <meta charset=<?php bloginfo('charset'); ?>>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preload" href="/wp-content/themes/bov/fonts/Inter-Regular.woff2" as="font" type="font/woff2"
          crossorigin="anonymous">
    <link rel="preload" href="/wp-content/themes/bov/fonts/Inter-Medium.woff2" as="font" type="font/woff2"
          crossorigin="anonymous">
    <link rel="preload" href="/wp-content/themes/bov/fonts/Inter-SemiBold.woff2" as="font" type="font/woff2"
          crossorigin="anonymous">
    <link rel="preload" href="/wp-content/themes/bov/fonts/PalatinoLTStd-Roman.woff2" as="font" type="font/woff2"
          crossorigin="anonymous">
    <link rel="preload" href="/wp-content/themes/bov/fonts/PalatinoLTStd-Italic.woff2" as="font" type="font/woff2"
          crossorigin="anonymous">
    <link rel="preload" href="/wp-content/themes/bov/fonts/GT-America-Standard-Regular.woff2" as="font"
          type="font/woff2" crossorigin="anonymous">

    <?php $hero = get_field('hero');

    // Desktop video
    if (isset($hero['add_video_desktop']) && $hero['add_video_desktop'] === 'File') {
        $videoDesktop = isset($hero['bg_video']['url']) ? $hero['bg_video']['url'] : '';
    } else {
        $videoDesktop = isset($hero['bg_video_url']) ? $hero['bg_video_url'] : '';
    }

    // Mobile video
    if (isset($hero['add_video_mobile']) && $hero['add_video_mobile'] === 'File') {
        $videoMobile = isset($hero['bg_video_mobile']['url']) ? $hero['bg_video_mobile']['url'] : '';
    } else {
        $videoMobile = isset($hero['bg_video_mobile_url']) ? $hero['bg_video_mobile_url'] : '';
    }
    ?>


    <script defer>
        document.addEventListener("DOMContentLoaded", function () {
            var video = document.querySelector(".home-hero__video");
            if (!video) {
                return;
            }
            var mobileVideo = "<?= $videoMobile ?>";
            var desktopVideo = "<?= $videoDesktop ?>";

            var selectedVideo = window.innerWidth <= 768 ? mobileVideo : desktopVideo;

            var source = document.createElement("source");
            source.src = selectedVideo;
            source.type = "video/mp4";

            video.appendChild(source);
            video.load();
        });
    </script>


    <?php wp_head(); ?>


    <style>
        <?php include "custom-styles.css" ?>
    </style>
</head>

<body <?php body_class(); ?>>

<?php include "js/inline-js.php" ?>

<?php
$hero = get_field('hero');
$header = get_field('header', 'option');
$contact = get_field('contact', 'option');
?>

<header class="main-header">
    <div class="main-header__menu ">
        <div class="main-header__container container">
            <a href="<?= home_url() ?>" class="main-header__logo">
                <?= wp_get_attachment_image($header['logo'], 'full', false, ['width' => '300', 'height' => '80']); ?>
            </a>
            <div class="main-header__wrap mobile-menu--bg">
                <nav class="main-menu mobile-menu
                        mobile-menu--type-right">
                    <?php echo getMenu('header-menu', 'main-menu',
                        new HierarchyMenuWalker());
                    ?>
                    <div class="main-menu__contact">
                        <p class="main-menu__info-text">contacts</p>
                        <a href="tel:<?= str_replace(' ', '', $contact['number_free']) ?>"
                           class="main-menu__contact-tel"
                           target="_blank"
                           rel="nofollow">
                            Toll Free USA: <?= $contact['number_free'] ?>
                        </a>
                        <a href="tel:<?= str_replace(' ', '', $contact['number_direct']) ?>"
                           class="main-menu__contact-tel"
                           target="_blank"
                           rel="nofollow">
                            Direct (Peru): <?= $contact['number_direct'] ?>
                        </a>
                        <a class="main-menu__btn btn btn--secondary"
                           href="<?= $contact['link_buttons_secondary']['url'] ?>">
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
