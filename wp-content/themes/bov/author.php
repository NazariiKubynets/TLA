<?php get_header();

$author_id = get_queried_object_id();
$user_info = get_userdata($author_id);
$user = get_field('user', 'user_' . $author_id);

?>

<section class="author-hero">
    <span class="author-hero__bg"></span>
    <div class="author-hero__container container">
        <div class="author-hero__row">
            <div class="author-hero__avatar">
                <?php if (!empty($user['img'])) {
                    echo wp_get_attachment_image($user['img'], 'thumbnail');
                } else { ?>
                    <img class="img" src="<?= get_template_directory_uri(); ?>/img/decor/dist/default-avatar.jpg"
                         alt="default-img">
                <?php } ?>
            </div>
            <p class="author-hero__author-name title-l">
                <?php if (!empty($user_info->first_name)) {
                    echo $user_info->first_name . ' ' . $user_info->last_name;
                } else {
                    echo ucfirst($user_info->user_nicename);
                } ?>
            </p>
        </div>
        <?php if (!empty($user_info->user_description)) : ?>
        <div class="author-hero__content">
            <p class="author-hero__text"><?= $user_info->user_description?></p>
            <?php if ($user['img_large']) : ?>
            <div class="author-hero__img">
                <?= wp_get_attachment_image($user['img_large'], 'large',true, ['class' => 'img']); ?>
            </div>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </div>
</section>

<section class="posts-archive">
    <div class="posts-archive__container container">
        <div class="archive-posts__grid visible">
            <?php
            $args = [
                'author'        => $author_id,
                'post_type'     => 'post',
                'posts_per_page' => 9,
            ];
            $author_posts = new WP_Query($args);

            if (have_posts()) :
                $post_count = 0;
                while ($author_posts->have_posts()) : $author_posts->the_post();
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
