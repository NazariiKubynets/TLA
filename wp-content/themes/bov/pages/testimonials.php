<?php
/*
Template Name: Testimonials
*/

get_header();

$pageId = get_queried_object_id();
$testimonials = get_field('testimonials');
$advantages = get_field('advantages', 'option');

?>

    <section class="testimonials-hero hero hero--classic">
        <div class="hero__img">
            <?php if (has_post_thumbnail($pageId)) {
                echo get_the_post_thumbnail($pageId, 'large_1920', array('class' => 'img'));
            } else { ?>
                <img class="img"
                     src="<?= get_template_directory_uri(); ?>/img/decor/dist/default-img.jpg"
                     alt="default-img">
            <?php } ?>
        </div>
        <div class="hero__container container">
            <div class="hero__content">
                <h1 class="hero__title title-xxl"><?php the_title(); ?></h1>
                <div class="hero__text"><?= get_the_content() ?></div>
            </div>
        </div>
    </section>

    <section class="testimonials">
        <div class="testimonials__container container">
            <div class="testimonials__wrap">
                <div class="testimonials__content">
                    <?php
                    $paged = get_query_var('paged') ? get_query_var('paged') : 1;
                    $queryArgs = array(
                        'post_type' => 'testimonials',
                        'paged' => $paged,
                        'posts_per_page' => 5,
                        'orderby' => 'date',
                        'order' => 'DESC'
                    );

                    $query = new WP_Query($queryArgs);
                    while ($query->have_posts()) {
                        $query->the_post();
                        $testimonial = get_field('customer_testimonials');
                        ?>
                        <div class="testimonials__item">
                            <svg class="testimonials__icon" width="51" height="27" viewBox="0 0 51 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2 8V14V14C2 20.6274 7.37258 26 14 26V26C20.6274 26 26 20.6274 26 14V14C26 7.37258 20.6274 2 14 2V2H8" stroke="#B4ADA4"/>
                                <path d="M26 2H38C44.6274 2 50 7.37258 50 14V14C50 20.6274 44.6274 26 38 26V26C31.3726 26 26 20.6274 26 14V2Z" stroke="#B4ADA4"/>
                                <circle cx="2" cy="2" r="2" fill="#144D55"/>
                            </svg>
                            <div class="testimonials__text"><?php the_content(); ?></div>
                            <p class="testimonials__author-name">
                                <?= $testimonial['author_name'] ?>
                            </p>
                            <p class="testimonials__date"><?= $testimonial['date'] ?></p>
                        </div>
                    <?php }

                    get_template_part('templates/items/_archive-posts-pagination', null, ['field' => $query]);

                    wp_reset_postdata(); ?>
                </div>
                <div class="introduction__sidebar">
                    <div class="introduction__form">
                        <p class="introduction__form-subtitle">
                            <?= !empty($testimonial['form_subtitle']) ? $testimonials['form_subtitle'] : "Book Your Journey" ?>
                        </p>
                        <h3 class="introduction__form-title title-s">
                            <?= !empty($testimonial['form_title']) ? $testimonials['form_title'] : "Contact our team" ?>
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


<?php get_footer(); ?>