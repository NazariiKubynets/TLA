<?php
$pageId = get_queried_object_id();
$shortTitle = get_field('short_title');
$category = get_field('category');
$hero = get_field('hero');
$cognitive = get_field('cognitive');
$contact = get_field('contact', 'option');
$topPlaces = get_field('top_places');
$directions = get_field('directions');
$importantInfo = get_field('important_info');
$faq = get_field('faq');
$infoPosts = get_field('destinations_posts');


get_header();
?>
    <section class="description-hero hero">
        <div class="hero__img">
            <?php if ($hero['img']) {
                echo wp_get_attachment_image($hero['img'], 'large_1920', false, array('class' => 'img'));
            } else { ?>
                <img class="img" src="<?= get_template_directory_uri(); ?>/img/decor/dist/default-img.jpg"
                     alt="default-img">
            <?php } ?>
        </div>
        <div class="hero__container container">
            <div class="hero__content">
                <a class="hero__subtitle" href="<?= $hero['subtitle']['url'] ?>"><?= $hero['subtitle']['title'] ?></a>
                <h1 class="hero__title title-xl"><?php the_title(); ?></h1>
                <p class="hero__text"><?= $hero['text'] ?></p>
            </div>
        </div>
    </section>

    <?php if (!empty($cognitive['text'])) : ?>
    <section class="toc">
        <div class="toc__container container">
            <ul class="toc__list">
                <li><a class="toc__title active" href="#introduction">Introduction</a></li>
                <li><a class="toc__title" href="#tripIdeas">Trip Ideas</a></li>
                <li><a class="toc__title" href="#needToKnow">Need to know</a></li>
                <li><a class="toc__title" href="#inspiration">Inspiration</a></li>
            </ul>
        </div>
    </section>
    <?php endif; ?>

    <?php if (!empty($cognitive['text'])) : ?>
    <section id="introduction" class="cognitive-block">
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
                            <?= !empty($cognitive['link']['title']) ? $cognitive['link']['title'] : "See Featured " . $shortTitle . " Tours" ?>
                        </a>
                    <?php } else {?>
                        <a class="cognitive-block__btn btn" href="#tripIdeas">
                            <?= !empty($cognitive['button_name']) ? $cognitive['button_name'] : "See Featured " . $shortTitle . " Tours" ?>
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
                                <a href="tel:<?= $contact['number_free'] ?>"
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
                                <a href="tel:<?= $contact['number_direct'] ?>"
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
    <?php endif; ?>

    <?php if (!empty($category)) : ?>
    <section id="tripIdeas" class="top-places">
        <div class="top-places__container container custom-line">
            <p class="top-places__subtitle">
                <?= !empty($topPlaces['subtitle']) ? $topPlaces['subtitle'] : "Our top picks" ?>
            </p>
            <h2 class="top-places__title title-l">
                <?= !empty($topPlaces['title']) ? $topPlaces['title'] : "Featured Luxury " . $shortTitle . " Tours" ?>
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
                        'posts_per_page' => -1,
                        'orderby' => 'date',
                        'cat' => $category
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
            <button class="top-places__btn btn">
                See All <?= $shortTitle ?> Tours
            </button>
        </div>
    </section>
    <?php endif; ?>

    <?php if (isset($directions['directions_items']) && !empty($directions['directions_items'])) : ?>
    <section class="directions">
            <div class="directions__container container">
                <p class="directions__subtitle">
                    <?= $directions['subtitle'] ?>
                </p>
                <h2 class="directions__title title-l">
                    <?= !empty($directions['title']) ? $directions['title'] : $shortTitle . " Principal Destinations" ?>
                </h2>
                <div class="directions__swiper-wrap">
                    <div class="directions__swiper swiper">
                        <div class="directions__swiper-wrapper swiper-wrapper directions__grid">
                            <?php foreach ($directions['directions_items'] as $item) { ?>
                                <div class="directions__swiper-slide swiper-slide">
                                    <div class="directions__img">
                                        <?= wp_get_attachment_image_lazy($item['img'], 'medium_large', "img") ?>
                                    </div>
                                    <p class="directions__item-text">Discover</p>
                                    <h3 class="directions__item-title title-m"><?= $item['title'] ?></h3>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="directions__swiper-pagination swiper-pagination"></div>
                </div>
            </div>
    </section>
    <?php endif; ?>

    <?php if (isset($importantInfo['info']) && !empty($importantInfo['info'])) : ?>
    <section id="needToKnow" class="important-info">
        <div class="important-info__container container">
            <h2 class="important-info__title title-l">
                <?= !empty($importantInfo['title']) ? $importantInfo['title'] : $shortTitle . " Need To Know " ?>
            </h2>
            <div class="important-info__grid">
                    <?php foreach ($importantInfo['info'] as $item) { ?>
                        <div class="important-info__item">
                            <?= wp_get_attachment_image_lazy($item['icon'], 'thumbnail', "important-info__icon") ?>
                            <h3 class="important-info__item-title title-s"><?= $item['title'] ?></h3>
                            <p class="important-info__text"><?= $item['text'] ?></p>
                        </div>
                    <?php } ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <?php if (isset($faq['faq_list']) && !empty($faq['faq_list'])) : ?>
        <section class="faq">
            <div class="faq__container container custom-line">
                <div class="faq__wrap">
                    <h2 class="faq__title title-l"><?= $faq['title'] ?></h2>
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
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php if (!empty($category)) : ?>
    <section id="inspiration" class="inspiration">
        <div class="inspiration__container container">
            <h2 class="inspiration__title title-l">
                <?= !empty($infoPosts['title']) ? $infoPosts['title'] : $shortTitle . " Inspiration" ?>
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
                        'cat' => $category
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
    <?php endif; ?>

<?php get_footer(); ?>