<?php get_header();

$pageId = get_queried_object_id();
$user_id = $post->post_author;
$categories = get_the_category();
$user = get_field('user', 'user_' . $user_id);
$contact = get_field('blog_post', 'option');
$similarArticles = get_field('similar_articles');

?>

<section class="hero">
    <div class="hero__img">
        <?php if (get_the_post_thumbnail($pageId)) {
            echo get_the_post_thumbnail($pageId, 'large_1920', array('class' => 'img'));
        } else { ?>
            <img class="img" src="<?= get_template_directory_uri(); ?>/img/decor/dist/article-hero-img.jpg"
                 alt="default-img">
        <?php } ?>
    </div>
    <div class="hero__container container">
        <div class="hero__content">
            <a class="hero__subtitle" href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>">
                <?php if (get_the_category()) {
                    echo esc_html($categories[0]->name);
                } ?>
            </a>
            <h1 class="hero__title title-xl"><?php the_title(); ?></h1>
        </div>
    </div>
</section>

<section class="blog-post">
    <div class="blog-post__container container">
        <div class="blog-post__header">
            <div class="blog-post__row">
                <div class="blog-post__avatar">
                    <?php if (!empty($user['img'])) {
                        echo wp_get_attachment_image_lazy($user['img'], 'thumbnail');
                    } else { ?>
                        <img class="img" src="<?= get_template_directory_uri(); ?>/img/decor/dist/default-avatar.jpg"
                             alt="default-img">
                    <?php } ?>
                </div>
                <div class="blog-post__data">
                    <p class="blog-post__author-name title-s">
                        <?php if (!empty(get_userdata($user_id)->first_name)) {
                            echo get_userdata($user_id)->first_name . ' ' . get_userdata($user_id)->last_name;
                        } else {
                            echo ucfirst(get_userdata($user_id)->user_nicename);
                        } ?>
                    </p>
                    <p class="blog-post__date">
                        <?= get_the_date('F j, Y', $pageId); ?>
                    </p>
                </div>
            </div>
            <div class="blog-post__row">
                <p class="blog-post__views">
                    <svg width="22" height="22">
                        <use xlink:href="<?= getSvgSpriteUrl() ?>#post-views" />
                    </svg>
                    <?= get_post_views(get_the_ID()); ?>
                </p>
                <p class="blog-post__views">
                    <?= get_daily_post_views(get_the_ID()); ?>
                </p>
            </div>
        </div>
        <div class="blog-post__content">
            <?php the_content(); ?>
        </div>
        <div class="blog-post__contact-us">
            <p class="blog-post__contact-us-text title-s"><?= $contact['contact_us_text'] ?></p>
            <a class="blog-post__contact-us-btn btn btn--secondary" href="<?= $contact['contact_us_link']['url'] ?>">
                <?= $contact['contact_us_link']['title'] ?>
            </a>
        </div>
    </div>
</section>

<section class="similar-articles">
    <div class="similar-articles__container container custom-line">
        <h2 class="similar-articles__title title-l">
            <?= $similarArticles['title'] ?>
        </h2>
        <div class="similar-articles__grid">
            <?php if ($similarArticles['which_posts'] === 'Сhoose yourself') {
                foreach ($similarArticles['selected_posts'] as $post) {
                    setup_postdata($post); ?>
                    <a class="similar-articles__post" href="<?= get_permalink(); ?>">
                        <div class="similar-articles__post-img">
                            <?php if (get_the_post_thumbnail($post->ID)) {
                                echo get_the_post_thumbnail($post->ID, 'medium_large', array('class' => 'img'));
                            } else { ?>
                                <img class="img"
                                     src="<?= get_template_directory_uri(); ?>/img/decor/dist/default-img.jpg"
                                     alt="default-img">
                            <?php } ?>
                        </div>
                        <div class="similar-articles__post-content">
                            <p class="similar-articles__post-category">
                                <?= esc_html(get_the_category()[0]->name); ?>
                            </p>
                            <h3 class="similar-articles__post-title title-s">
                                <?= get_the_title(); ?>
                            </h3>
                            <p class="similar-articles__post-date">
                                <?= get_the_date('F j, Y', $post->ID); ?>
                            </p>
                        </div>
                    </a>
                <?php }
            } else {
                $queryArgs = array(
                    'post_type' => 'post',
                    'posts_per_page' => 3,
                    'orderby' => 'date',
                    'post__not_in' => array(get_the_ID()),
                );

                $query = new WP_Query($queryArgs);

                while ($query->have_posts()) {
                    $query->the_post();
                    get_template_part('templates/items/_archive-posts', null,);
                    ?>
                <?php }
            }
            wp_reset_postdata();
            ?>
        </div>
    </div>
</section>


<?php get_footer(); ?>
