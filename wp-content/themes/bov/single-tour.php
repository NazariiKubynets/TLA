<?php
$pageId = get_queried_object_id();
$categories = wp_get_post_terms($pageId, 'destination');
$hero = get_field('hero');
$introduction = get_field('introduction');
$info_blocks = $introduction['info_blocks'];
$advantages = get_field('advantages', 'option');
$offers = get_field('offers');
$urlDestination = get_field('links_to_destination', 'destination_' . $categories[0]->term_id);

get_header();

?>

<section class="tour-hero hero">
    <div class="hero__img">
        <?php if (get_the_post_thumbnail($pageId)) {
            echo get_the_post_thumbnail($pageId, 'large_1920', array('class' => 'img'));
        } else { ?>
            <?= wp_get_attachment_image(9717, 'large_1920',true, ['class' => 'img']) ?>
        <?php } ?>
    </div>
    <div class="hero__container container">
        <div class="hero__content">
            <a class="hero__subtitle" href="<?= get_permalink($urlDestination[0]); ?>">
                <?php if (get_the_category()) {
                    echo esc_html($categories[0]->name);
                } ?>
            </a>
            <h1 class="hero__title title-xl"><?php the_title(); ?></h1>
        </div>
    </div>
</section>

<?php if (!empty($introduction['text'])) : ?>
    <section class="toc">
        <div class="toc__container container">
            <ul class="toc__list">
                <li><a class="tour-toc__title toc__title active" href="#quickOverview">Quick overview by day</a></li>
                <li><a class="tour-toc__title toc__title" href="#photos">Photos</a></li>
                <li><a class="tour-toc__title toc__title" href="#itinerary">Day by day itinerary</a></li>
                <li><a class="tour-toc__title toc__title" href="#tab-0">Pricing</a></li>
                <li><a class="tour-toc__title toc__title" href="#tab-1">What’s Included</a></li>
                <li><a class="tour-toc__title toc__title" href="#tab-2">When to Travel</a></li>
                <li><a class="tour-toc__title toc__title" href="#tab-3">Tour Info</a></li>
            </ul>
        </div>
    </section>

    <section class="introduction">
        <div class="introduction__container container custom-line">
            <div class="introduction__wrap">
                <div class="introduction__content">
                    <h2 class="introduction__title title-l">
                        <?= !empty($introduction['title']) ? $introduction['title'] : "Introduction" ?>
                    </h2>
                    <div class="introduction__text the-content">
                        <?= $introduction['text'] ?>
                    </div>
                    <?php if (!empty($introduction['img']) || !empty($introduction['video'])) : ?>
                        <?php if (!$introduction['image_video']) { ?>
                            <div class="introduction__img" data-micromodal-open="modal-tour-photo">
                                <?= wp_get_attachment_image_lazy($introduction['img'], 'large_1920', 'img') ?>
                            </div>
                        <?php } else { ?>
                            <div class="introduction__video-container">
                                <?= $introduction['video'] ?>
                            </div>
                        <?php }
                    endif; ?>
                    <?php if (isset($introduction['overview_items']) && !empty($introduction['overview_items'])) : ?>
                        <div id="quickOverview" class="introduction__overview">
                            <h3 class="introduction__overview-title title-s">
                                <?= !empty($introduction['overview_title']) ? $introduction['overview_title'] : "Quick overview by day:" ?>
                            </h3>
                            <ul class="introduction__overview-list">
                                <?php foreach ($introduction['overview_items'] as $index => $item) { ?>
                                    <li class="introduction__overview-item">
                                        <p class="introduction__overview-item-day">Day</p>
                                        <p class="introduction__overview-item-number"><?= $index + 1 ?></p>
                                        <p class="introduction__overview-item-title"><?= $item['title'] ?></p>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <?php if ($info_blocks['show_expedition_ship']) : ?>
                        <div class="introduction__info-block">
                            <h3 class="introduction__info-block-title title-s"><?= $info_blocks['expedition_ship_title'] ?></h3>
                            <div class="introduction__info-block-text"><?= $info_blocks['expedition_ship_text'] ?></div>
                            <div class="introduction__info-block-row">
                                <div class="introduction__info-block-img" data-micromodal-open="modal-tour-photo">
                                    <?= wp_get_attachment_image_lazy($info_blocks['expedition_ship_image_one'], 'large_1920', 'img') ?>
                                </div>
                                <div class="introduction__info-block-img" data-micromodal-open="modal-tour-photo">
                                    <?= wp_get_attachment_image_lazy($info_blocks['expedition_ship_image_two'], 'large_1920', 'img') ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if ($info_blocks['show_route_map']) : ?>
                        <div class="introduction__info-block-secondary">
                            <div class="introduction__info-block-secondary-wrap">
                                <p class="introduction__info-block-secondary-subtitle"><?= $info_blocks['route_map_subtitle'] ?></p>
                                <h3 class="introduction__info-block-title title-s"><?= $info_blocks['route_map_title'] ?></h3>
                                <div class="introduction__info-block-secondary-text"><?= $info_blocks['route_map_text'] ?></div>
                            </div>
                            <div class="introduction__info-block-secondary-img" data-micromodal-open="modal-tour-photo">
                                <?= wp_get_attachment_image_lazy($info_blocks['route_map_image'], 'large_1920', 'img') ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($introduction['img']) || $info_blocks['show_route_map'] || $info_blocks['show_expedition_ship']) : ?>
                        <?php get_template_part('templates/modals/_tour-photo', null,); ?>
                    <?php endif; ?>

                    <?php if (isset($introduction['slides_image']) && !empty($introduction['slides_image'])) : ?>
                        <div id="photos" class="introduction__swiper-wrap">
                            <div class="introduction__swiper swiper">
                                <div class="introduction__swiper-wrapper swiper-wrapper">
                                    <?php foreach ($introduction['slides_image'] as $slide) { ?>
                                        <div class="introduction__swiper-slide swiper-slide" data-micromodal-open="modal-tour-photos">
                                            <?= wp_get_attachment_image_lazy($slide, 'large', 'img') ?>
                                            <span class="introduction__caption"><?= wp_get_attachment_caption($slide) ?></span>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="introduction__swiper-row-nav">
                                <div class="introduction__swiper-nav introduction__swiper-nav--prev swiper-button-prev">
                                    <svg width="24" height="24">
                                        <use xlink:href="<?= getSvgSpriteUrl() ?>#swiper-left-arrow"/>
                                    </svg>
                                </div>
                                <div class="introduction__swiper-pagination swiper-pagination"></div>
                                <div class="introduction__swiper-nav introduction__swiper-nav--next swiper-button-next">
                                    <svg width="24" height="24">
                                        <use xlink:href="<?= getSvgSpriteUrl() ?>#swiper-right-arrow"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <?php get_template_part('templates/modals/_tour-photos', null, ['introduction' => $introduction]); ?>
                    <?php endif; ?>

                    <ul id="itinerary" class="introduction__descriptions">
                        <?php if (isset($introduction['overview_items']) && !empty($introduction['overview_items'])) : ?>
                            <?php foreach ($introduction['overview_items'] as $index => $item) { ?>
                                <li class="introduction__descriptions-item">
                                    <div class="introduction__descriptions-item-header">
                                        <p class="introduction__descriptions-item-number"><?= $index + 1 ?></p>
                                        <p class="introduction__descriptions-item-day">Day <?= $index + 1 ?></p>
                                    </div>
                                    <div class="introduction__descriptions-item-content">
                                        <h4 class="introduction__descriptions-item-title title-s"><?= $item['title'] ?></h4>
                                        <div class="introduction__descriptions-item-text"><?= $item['text'] ?></div>
                                    </div>
                                </li>
                            <?php } ?>
                        <?php endif; ?>
                    </ul>

                    <?php if (isset($introduction['informations_tabs']) && !empty($introduction['informations_tabs'])) : ?>
                        <div class="introduction__information">
                            <h2 class="introduction__information-title title-l">
                                <?= !empty($introduction['tabs_title']) ? $introduction['tabs_title'] : "Tour Information" ?>
                            </h2>
                            <div class="introduction__information-tabs">
                                <div class="introduction__information-tabs-wrap">
                                    <div class="introduction__information-toggles">
                                        <div class="introduction__swiper-tabs swiper">
                                            <ul class="introduction__swiper-wrapper-tabs swiper-wrapper">
                                                <?php foreach ($introduction['informations_tabs'] as $index => $item): ?>
                                                    <li class="introduction__information-toggle swiper-slide">
                                                        <button class="introduction__information-btn <?php echo $index === 0 ? 'active' : ''; ?>"
                                                                data-tab="tab-<?= $index; ?>">
                                                            <?= $item['title'] ?>
                                                        </button>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="introduction__information-content">
                                    <?php
                                    foreach ($introduction['informations_tabs'] as $index => $tab) {
                                        if ($tab['acf_fc_layout'] === 'sing_text_and_list_optional') { ?>
                                            <div class="introduction__information-pane <?php echo $index === 0 ? 'active' : ''; ?>"
                                                 id="tab-<?= $index; ?>">
                                                <?= $tab['content'] ?>
                                            </div>

                                            <?php continue;
                                        }
                                        if ($tab['acf_fc_layout'] === 'two_lists') { ?>
                                            <div class="introduction__information-pane <?php echo $index === 0 ? 'active' : ''; ?>"
                                                 id="tab-<?= $index; ?>">
                                                <?= $tab['top_list'] ?>
                                                <div class="introduction__information-pane-bottom_list"><?= $tab['bottom_list'] ?></div>
                                            </div>

                                            <?php continue;
                                        }
                                        if ($tab['acf_fc_layout'] === 'text_and_two-column_lists') { ?>
                                            <div class="introduction__information-pane <?php echo $index === 0 ? 'active' : ''; ?>"
                                                 id="tab-<?= $index; ?>">
                                                <?= $tab['text_above_lists'] ?>
                                                <div class="introduction__information-pane-row">
                                                    <div class=""><?= $tab['left_list'] ?></div>
                                                    <div class=""><?= $tab['right_list'] ?></div>
                                                </div>
                                            </div>
                                            <?php continue;
                                        }
                                    } ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="introduction__sidebar">
                    <div class="introduction__form">
                        <p class="introduction__form-subtitle">
                            <?= !empty($introduction['form_subtitle']) ? $introduction['form_subtitle'] : "Book Your Journey" ?>
                        </p>
                        <h3 class="introduction__form-title title-s">
                            <?= !empty($introduction['form_title']) ? $introduction['form_title'] : "Contact our team" ?>
                        </h3>
                        <?= do_shortcode('[contact-form-7 id="83ca3f2" title="Tour"]'); ?>
                    </div>

                    <div class="introduction__advantages">
                        <h3 class="introduction__advantages-title title-s"><?= $advantages['advantages_title'] ?></h3>
                        <ul class="introduction__advantages-list">
                            <?php if (isset($advantages['advantages']) && !empty($advantages['advantages'])) : ?>
                                <?php foreach ($advantages['advantages'] as $index => $item) { ?>
                                    <li class="introduction__advantages-item">
                                        <?= wp_get_attachment_image_lazy($item['icon'], 'thumbnail', "introduction__advantages-icon") ?>
                                        <p class="introduction__advantages-item-title"><?= $item['title'] ?></p>
                                        <p class="introduction__advantages-text"><?= $item['text'] ?></p>
                                    </li>
                                <?php } ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php endif; ?>

<section id="tripIdeas" class="offers">
    <div class="offers__container container">
        <h2 class="offers__title title-l">
            <?= !empty($offers['title']) ? $offers['title'] : "Similar Tours" ?>
        </h2>
        <div class="offers__swiper-wrap">
            <div class="offers__swiper swiper">
                <div class="offers__swiper-wrapper swiper-wrapper offers__grid">
                    <?php if ($offers['which_posts'] === 'Сhoose yourself') {
                        foreach ($offers['selected_posts'] as $post) {
                            setup_postdata($post);
                            ?>
                            <a class="offers__swiper-slide tour-post swiper-slide" href="<?= get_permalink(); ?>">
                                <div class="tour-post__img">
                                    <?php if (get_the_post_thumbnail($post->ID)) {
                                        echo get_the_post_thumbnail($post->ID, '1536x1536', array('class' => 'img'));
                                    } else { ?>
                                        <?= wp_get_attachment_image_lazy(9717, 'large_1920', 'img') ?>
                                    <?php } ?>
                                </div>
                                <div class="tour-post__content">
                                    <h3 class="tour-post__title title-s">
                                        <?= get_the_title(); ?>
                                    </h3>
                                    <p class="tour-post__text">view trip</p>
                                </div>
                            </a>
                        <?php }
                    } else {
                        $queryArgs = array(
                            'post_type' => 'tour',
                            'posts_per_page' => 9,
                            'orderby' => 'date',
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'destination',
                                    'field' => 'term_id',
                                    'terms' => $categories[0]->term_id,
                                ),
                            ),

                        );

                        $query = new WP_Query($queryArgs);
                        while ($query->have_posts()) {
                            $query->the_post() ?>
                            <a class="offers__swiper-slide tour-post swiper-slide" href="<?= get_permalink(); ?>">
                                <div class="tour-post__img">
                                    <?php if (get_the_post_thumbnail($post->ID)) {
                                        echo get_the_post_thumbnail($post->ID, '1536x1536', array('class' => 'img'));
                                    } else { ?>
                                        <?= wp_get_attachment_image_lazy(9717, 'large_1920', 'img') ?>
                                    <?php } ?>
                                </div>
                                <div class="tour-post__content">
                                    <h3 class="tour-post__title title-s">
                                        <?= get_the_title(); ?>
                                    </h3>
                                    <p class="tour-post__text">view trip</p>
                                </div>
                            </a>
                        <?php }
                    }
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
            <div class="offers__swiper-pagination swiper-pagination"></div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
