<?php
/*
Template Name: Ethical Conscience
*/

get_header();

$pageId = get_queried_object_id();
$topPlaces = get_field('top_places');
$quote = get_field('quote');
$advantages = get_field('advantages', 'option');

?>

    <section class="ethical-conscience-hero hero hero--classic">
        <div class="hero__img">
            <?php if (has_post_thumbnail($pageId)) {
                echo get_the_post_thumbnail($pageId, 'large_1920', array('class' => 'img'));
            } else { ?>
                <?= wp_get_attachment_image(9717, 'large_1920',true, ['class' => 'img']) ?>
            <?php } ?>
        </div>
        <div class="hero__container container">
            <div class="hero__content">
                <h1 class="hero__title title-xxl"><?php the_title(); ?></h1>
                <p class="hero__text"><?= get_field('hero_text') ?></p>
            </div>
        </div>
    </section>

    <section class="ethical-conscience">
        <div class="ethical-conscience__container container the-content">
            <div class="ethical-conscience__content the-content">
                <?php the_content(); ?>
            </div>
            <div class="ethical-conscience__motto">
                <p class="ethical-conscience__motto-title"><?= get_field('motto_title') ?></p>
                <p class="ethical-conscience__motto-text title-s"><?= get_field('motto_text') ?></p>
            </div>
        </div>
    </section>

    <section class="ethical-conscience-top-places top-places">
        <div class="top-places__container container custom-line">
            <p class="top-places__subtitle">
                <?= !empty($topPlaces['subtitle']) ? $topPlaces['subtitle'] : "Our top picks" ?>
            </p>
            <h2 class="top-places__title title-l">
                <?= !empty($topPlaces['title']) ? $topPlaces['title'] : "Featured Vacations" ?>
            </h2>
            <div class="top-places__grid">
                <?php if ($topPlaces['which_posts'] === 'Сhoose yourself') {
                    foreach ($topPlaces['selected_posts'] as $index => $post) {
                        setup_postdata($post);
                        get_template_part('templates/items/_tour-post', null, ['index' => $index, 'className' => 'single-tour-post']);
                    }
                } else {
                    $queryArgs = array(
                        'post_type' => 'tour',
                        'posts_per_page' => 3,
                        'orderby' => 'date',
                    );

                    $query = new WP_Query($queryArgs);
                    $index = 0;
                    while ($query->have_posts()) {
                        $query->the_post();
                        get_template_part('templates/items/_tour-post', null, ['index' => $index, 'className' => 'single-tour-post']);
                        $index++;
                    }
                }

                wp_reset_postdata();
                ?>
            </div>
        </div>
    </section>

    <section class="quote">
        <div class="quote__container container">
            <svg class="quote__icon" width="67" height="35" viewBox="0 0 67 35" fill="none"
                 xmlns="http://www.w3.org/2000/svg">
                <path d="M2 10v8c0 8.837 7.163 16 16 16v0c8.837 0 16-7.163 16-16v0c0-8.837-7.163-16-16-16v0h-8M34 2h16c8.837 0 16 7.163 16 16v0c0 8.837-7.163 16-16 16v0c-8.837 0-16-7.163-16-16V2z"
                      stroke="#B4ADA4"/>
                <circle cx="2" cy="2" r="2" fill="#144D55"/>
            </svg>
            <p class="quote__text"><?= $quote['text'] ?></p>
            <p class="quote__author-name">
                <?= $quote['author_name'] ?>
            </p>
        </div>
    </section>

    <section class="ethical-conscience-advantages">
        <div class="container">
            <div class="ethical-conscience-advantages__wrap">
                <h3 class="ethical-conscience-advantages__title"><?= $advantages['advantages_title'] ?></h3>
                <ul class="ethical-conscience-advantages__list">
                    <?php if (isset($advantages['advantages']) && !empty($advantages['advantages'])) : ?>
                        <?php foreach ($advantages['advantages'] as $index => $item) { ?>
                            <li class="ethical-conscience-advantages__item">
                                <?= wp_get_attachment_image_lazy($item['icon'], 'thumbnail', "ethical-conscience-advantages__icon") ?>
                                <p class="ethical-conscience-advantages__item-title"><?= $item['title'] ?></p>
                                <p class="ethical-conscience-advantages__text"><?= $item['text'] ?></p>
                            </li>
                        <?php } ?>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </section>


<?php get_footer(); ?>