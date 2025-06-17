<?php
/**
 * @var array $args
 */

$shortTitle = get_field('short_title');
?>

<a class="tour-post <?= $args["className"] ?? '' ?>
<?= $args["index"] >= 6 ? ' hidden ' : '' ?>
<?= $args["index"] > 5 && $args["index"] < 9 ? 'hidden--desk' : '' ?>" href="<?= get_permalink(); ?>">
    <div class="tour-post__img">
        <?php if (get_the_post_thumbnail($post->ID)) {
            echo wp_get_attachment_image_lazy(get_post_thumbnail_id($post->ID), 'medium_large', 'img');
        } else { ?>
            <?= wp_get_attachment_image_lazy(9717, 'medium_large', 'img') ?>
        <?php } ?>
    </div>
    <div class="tour-post__content">
        <h3 class="tour-post__title title-s">
            <?= !empty($shortTitle) ? $shortTitle :  get_the_title(); ?>
        </h3>
        <p class="tour-post__text"><?= $args["text"] ?? 'view trip'?></p>
    </div>
</a>