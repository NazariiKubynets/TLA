<?php
/**
 * @var array $args
 */

?>

<a href="<?php the_permalink(); ?>" class="info-post__item <?= $args["className"] ?? '' ?>">
    <div class="info-post__img">
        <?php if (get_the_post_thumbnail($post->ID)) {
            echo get_the_post_thumbnail($post->ID, 'medium_large', array('class' => 'img'));
        } else { ?>
            <img class="img" src="<?= get_template_directory_uri(); ?>/img/decor/dist/default-img.jpg"
                 alt="default-img">
        <?php } ?>
    </div>
    <h3 class="info-post__title title-s"><?= get_the_title() ?></h3>
    <div class="info-post__description">
        <?php
        $post_content = get_the_content();
        $post_excerpt = get_the_excerpt();

        if (!empty($post_excerpt)) {
            echo '<p>' . wp_trim_words($post_excerpt, 15, '...') . '</p>';
        } else {
            echo  '<p>' . wp_trim_words($post_content, 15, '...') . '</p>';
        }
        ?>
    </div>
</a>