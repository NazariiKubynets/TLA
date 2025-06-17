<?php
/*
    Template name: Destination
*/


$hero = get_field('hero');
$cognitive = get_field('cognitive');
$contact = get_field('contact', 'option');
$topPlaces = get_field('top_places');
$destinations = get_field('destinations');
$faq = get_field('faq');
$infoPosts = get_field('info_posts');


get_header();
?>

<section class="hero">
    <div class="hero__img">
        <?php if ($hero['img']) {
            echo wp_get_attachment_image($hero['img'], 'large_1920', false, array('class' => 'img'));
        } else { ?>
            <?= wp_get_attachment_image(9717, 'large_1920',true, ['class' => 'img']) ?>
        <?php } ?>
    </div>
    <div class="hero__container container">
        <div class="hero__content">
            <p class="hero__subtitle"><?php the_title(); ?></p>
            <h1 class="hero__title title-xl"><?= $hero['title'] ?></h1>
            <p class="hero__text"><?= $hero['text'] ?></p>
        </div>
    </div>
</section>

<section class="toc">
    <div class="toc__container container">
        <ul class="toc__list">
            <li><a class="toc__title active" href="#destinationIntroduction">Introduction</a></li>
            <li><a class="toc__title" href="#destinationTripIdeas">Trip Ideas</a></li>
            <li><a class="toc__title" href="#destinationFAQs">FAQs</a></li>
            <li><a class="toc__title" href="#destinationInspiration">Inspiration</a></li>
        </ul>
    </div>
</section>

<section id="destinationIntroduction" class="cognitive-block">
    <div class="cognitive-block__container container custom-line">
        <div class="cognitive-block__wrap">
            <div class="cognitive-block__content">
                <p class="cognitive-block__subtitle">
                    <?= $cognitive['subtitle'] ?>
                </p>
                <h2 class="cognitive-block__title title-l">
                    <?= $cognitive['title'] ?>
                </h2>
                <div class="cognitive-block__text">
                    <?= $cognitive['text'] ?>
                </div>
                <?php if ($cognitive['which_button'] === 'Enter Link') { ?>
                    <a class="cognitive-block__btn btn" href="<?= $cognitive['link']['url'] ?>">
                        <?= !empty($cognitive['link']['title']) ? $cognitive['link']['title'] : "See Featured south America Tours" ?>
                    </a>
                <?php } else {?>
                    <a class="cognitive-block__btn btn" href="#destinationTripIdeas">
                        <?= !empty($cognitive['button_name']) ? $cognitive['button_name'] : "See Featured south America Tours" ?>
                    </a>
                <?php } ?>
            </div>
            <div class="cognitive-block__sidebar">
                <div class="cognitive-block__img">
                    <?= wp_get_attachment_image_lazy($cognitive['map'], 'medium_large', 'img') ?>
                </div>
                <div class="cognitive-block__info">
                    <p class="cognitive-block__info-subtitle">
                        <?= $cognitive['sidebar_subtitle'] ?>
                    </p>
                    <h3 class="cognitive-block__info-title title-s">
                        <?= $cognitive['sidebar_title'] ?>
                    </h3>
                    <div class="cognitive-block__info-text">
                        <?= $cognitive['sidebar_text'] ?>
                    </div>
                    <a class="cognitive-block__info-btn btn btn--secondary"
                       href="<?= $contact['link_buttons_main']['url'] ?>">
                        <?= $contact['link_buttons_main']['title'] ?>
                    </a>
                </div>
                <div class="cognitive-block__contact">
                    <p class="cognitive-block__contact-subtitle">
                        <?= $cognitive['contact_subtitle'] ?>
                    </p>
                    <h3 class="cognitive-block__contact-title title-s">
                        <?= $cognitive['contact_title'] ?>
                    </h3>
                    <div class="column">
                        <div class="cognitive-block__contact-wrap">
                            <p class="cognitive-block__contact-text"><?= $contact['text_number_one'] ?></p>
                            <span class="cognitive-block__line"></span>
                            <a href="tel:<?= str_replace(' ', '', $contact['number_free']) ?>"
                               class="cognitive-block__contact-tel"
                               target="_blank"
                               rel="nofollow"><?= $contact['number_free'] ?>
                            </a>
                        </div>
                        <div class="cognitive-block__contact-wrap">
                            <p class="cognitive-block__contact-text">
                                <?php
                                $text = $contact['text_number_two'];
                                echo preg_replace('/\s*\(.*?\)/', '', $text);
                                ?>
                            </p>
                            <span class="cognitive-block__line"></span>
                            <a href="tel:<?= str_replace(' ', '', $contact['number_direct']) ?>"
                               class="cognitive-block__contact-tel"
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

<section id="destinationTripIdeas" class="top-places">
    <div class="top-places__container container custom-line">
        <p class="top-places__subtitle">
            <?= $topPlaces['subtitle']?>
        </p>
        <h2 class="top-places__title title-l">
            <?= $topPlaces['title']?>
        </h2>
        <div class="top-places__grid">
            <?php if ($topPlaces['which_posts'] === 'Сhoose yourself') {
                foreach ($topPlaces['selected_posts'] as $index => $post) {
                    setup_postdata($post);
                    get_template_part('templates/items/_tour-post', null, ['index' => $index, 'className' => 'destination-tour-post']);
                }
            } else {
                $queryArgs = array(
                    'post_type' => 'tour',
                    'posts_per_page' => 9,
                    'orderby' => 'date',
                );

                $query = new WP_Query($queryArgs);
                $index = 0;
                while ($query->have_posts()) {
                    $query->the_post();
                    get_template_part('templates/items/_tour-post', null, ['index' => $index, 'className' => 'destination-tour-post']);
                    $index++;
                }
            }
            wp_reset_postdata();
            ?>
        </div>
        <button class="destination__btn btn">
            <?= $topPlaces['btn']?>
        </button>
    </div>
</section>

<section class="tours">
    <div class="tours__container container custom-line">
        <p class="tours__subtitle">
            <?= $destinations['subtitle']?>
        </p>
        <h2 class="tours__title title-l">
            <?= $destinations['title']?>
        </h2>
        <div class="tours__grid">
            <?php if ($destinations['which_posts'] === 'Сhoose yourself') {
                foreach ($destinations['selected_posts'] as $post) {
                    setup_postdata($post);
                    get_template_part('templates/items/_tour-post', null,
                        ['className' => 'tour-post--tours', 'text' => 'Explore Journeys']);
                }
            } else {
                $queryArgs = array(
                    'post_type' => 'destinations',
                    'posts_per_page' => -1,
                    'orderby' => 'date',
                );

                $query = new WP_Query($queryArgs);

                while ($query->have_posts()) {
                    $query->the_post();
                    get_template_part('templates/items/_tour-post', null,
                        ['className' => 'tour-post--tours', 'text' => 'Explore Journeys']);
                }
            }
            wp_reset_postdata();
            ?>
        </div>
    </div>
</section>

<section id="destinationFAQs" class="faq">
    <div class="faq__container container custom-line">
        <div class="faq__wrap">
            <h2 class="faq__title title-l"><?= $faq['title'] ?></h2>
            <?php if (isset($faq['faq_list']) && !empty($faq['faq_list'])) : ?>
                <ul class="faq__accordion">
                    <?php foreach ($faq['faq_list'] as $item): ?>
                        <li class="faq__accordion-item">
                            <h3 class="faq__toggle title-s">
                                <?= $item['title'] ?>
                                <svg class="faq__icon">
                                    <use xlink:href="<?= getSvgSpriteUrl() ?>#faq-arrow"/>
                                </svg>
                            </h3>
                            <div class="faq__content">
                                <div class="faq__content-box">
                                    <div class="faq__text">
                                        <?= $item['content'] ?>
                                    </div>
                                </div>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</section>

<section id="destinationInspiration" class="inspiration">
    <div class="inspiration__container container">
        <h2 class="inspiration__title title-l">
            <?= $infoPosts['title']?>
        </h2>
        <div class="inspiration__grid">
            <?php if ($infoPosts['which_posts'] === 'Сhoose yourself') {
                foreach ($infoPosts['selected_posts'] as $post) {
                    setup_postdata($post);
                    get_template_part('templates/items/_info-post', null, [
                        'className' => 'info-post--destinations-post']);
                }
            } else {
                $queryArgs = array(
                    'post_type' => 'post',
                    'posts_per_page' => 3,
                    'orderby' => 'date',
                );

                $query = new WP_Query($queryArgs);

                while ($query->have_posts()) {
                    $query->the_post();
                    get_template_part('templates/items/_info-post', null, [
                        'className' => 'info-post--destinations-post']);
                }
            }
            wp_reset_postdata();
            ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
