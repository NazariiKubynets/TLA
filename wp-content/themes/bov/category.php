<?php get_header();
$pageId = get_queried_object_id();
$blog_page_id = get_option('page_for_posts');
$field_img = get_field('img', 'category_' . $pageId);
?>


    <section class="category-hero hero hero--classic">
        <div class="hero__img">
            <?php if ($field_img) {
                echo wp_get_attachment_image($field_img, 'large_1920', false, array('class' => 'img'));
            } else {
                echo get_the_post_thumbnail($blog_page_id, 'large_1920', array('class' => 'img'));
            } ?>
        </div>
        <div class="hero__container container">
            <div class="hero__content">
                <h1 class="hero__title title-xl"><?php single_cat_title();?></h1>
            </div>
        </div>
    </section>

    <section class="posts-archive">
        <div class="posts-archive__container container">
            <div class="archive-posts__grid visible">
                <?php if (have_posts()) :
                    $post_count = 0;
                    while (have_posts()) : the_post();
                        $post_count++;
                        get_template_part('templates/items/_archive-posts', null,
                            ['post_count' => $post_count]);
                        ?>
                    <?php endwhile;
                    wp_reset_postdata();
                else :
                    echo "Posts not found.";
                endif; ?>
            </div>
            <?php
            get_template_part('templates/items/_archive-posts-pagination', null,);
            ?>
        </div>
    </section>

<?php get_footer(); ?>