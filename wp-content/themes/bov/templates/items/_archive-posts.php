<?php
/**
 * @var array $args
 */

$post_count = $args['post-count'];
?>


<div class="archive-posts__post-item"
     id="<?= ($post_count == 1) ? 'first-post' : ''; ?>">
    <a class="archive-posts__post-img" href="<?= get_permalink(); ?>">
        <?php if (has_post_thumbnail($post->ID)) {
            echo get_the_post_thumbnail($post->ID, 'medium_large', array('class' => 'img'));
        } else { ?>
            <img class="img"
                 src="<?= get_template_directory_uri(); ?>/img/decor/dist/default-img.jpg"
                 alt="default-img">
        <?php } ?>
    </a>
    <div class="archive-posts__post-content">
        <div class="archive-posts__post-category-container">
            <div class="archive-posts__list-categories">
                <?php
                $categories = get_the_category();
                if (!empty($categories)) {
                    foreach ($categories as $category) { ?>
                        <a class="archive-posts__post-category"
                           href="<?php echo esc_url(get_category_link($category->term_id)); ?>">
                            <?= esc_html($category->name) ?>
                        </a>
                    <?php }
                }
                ?>
            </div>
            <button class="archive-posts__show-more">
                <svg class="archive-posts__arrow-icon">
                    <use xlink:href="<?= getSvgSpriteUrl() ?>#blog-post-arrow"/>
                </svg>
            </button>
        </div>
        <a href="<?= get_permalink(); ?>">
            <h3 class="archive-posts__post-title">
                <?= get_the_title(); ?>
            </h3>
            <p class="archive-posts__post-date">
                <?= get_the_date('F j, Y', $post->ID); ?>
            </p>
        </a>
    </div>
</div>

