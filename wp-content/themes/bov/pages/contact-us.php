<?php
/*
Template Name: Contact us
*/

$pageId = get_queried_object_id();
$contact = get_field('contact', 'option');
$contactUs = get_field('contact_us');

get_header();
?>

    <section class="hero hero--classic">
        <div class="hero__img">
            <?php if (has_post_thumbnail()) {
                echo get_the_post_thumbnail($pageId, 'large_1920', array('class' => 'img'));
            } else { ?>
                <?= wp_get_attachment_image(9717, 'large_1920',true, ['class' => 'img']) ?>
            <?php } ?>
        </div>
        <div class="hero__container container">
            <div class="hero__content">
                <h1 class="hero__title title-xxl"><?php the_title(); ?></h1>
                <div class="hero__text"><?= get_the_content() ?></div>
            </div>
        </div>
    </section>

    <section class="contact-us-form">
        <div class="contact-us-form__container container">
            <div class="contact-us-form__wrap">
                <div class="contact-us-form__inner">
                    <?= do_shortcode('[contact-form-7 id="b7eec0a" title="Contact Us Form" html_class="contact-form"]') ?>
                </div>
                <div class="contact-us-form__sidebar">
                    <div class="contact-us-form__info">
                        <p class="contact-us-form__info-subtitle">
                            <?= $contactUs['address_subtitle'] ?>
                        </p>
                        <h3 class="contact-us-form__info-title title-s">
                            <?= $contactUs['address_title'] ?>
                        </h3>
                        <a class="contact-us-form__info-text"
                           href="<?= $contactUs['address_link'] ?>"
                           target="_blank"
                           rel="nofollow">
                            <?= $contactUs['address'] ?>
                        </a>
                    </div>
                    <div class="contact-us-form__contact">
                        <p class="contact-us-form__contact-subtitle">
                            <?= $contactUs['call_subtitle'] ?>
                        </p>
                        <h3 class="contact-us-form__contact-title title-s">
                            <?= $contactUs['call_title'] ?>
                        </h3>
                        <div class="column">
                            <div class="contact-us-form__contact-wrap">
                                <p class="contact-us-form__contact-text"><?= $contact['text_number_one'] ?></p>
                                <span class="contact-us-form__line"></span>
                                <a href="tel:<?= str_replace(' ', '', $contact['number_free']) ?>"
                                   class="contact-us-form__contact-tel"
                                   target="_blank"
                                   rel="nofollow"><?= $contact['number_free'] ?>
                                </a>
                            </div>
                            <div class="contact-us-form__contact-wrap">
                                <p class="contact-us-form__contact-text">
                                    <?php
                                    $text = $contact['text_number_two'];
                                    echo preg_replace('/\s*\(.*?\)/', '', $text);
                                    ?>
                                </p>
                                <span class="contact-us-form__line"></span>
                                <a href="tel:<?= str_replace(' ', '', $contact['number_direct']) ?>"
                                   class="contact-us-form__contact-tel"
                                   target="_blank"
                                   rel="nofollow">
                                    <?= $contact['number_direct'] ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<div class="hide-contact">
    <?php get_footer(); ?>
</div>