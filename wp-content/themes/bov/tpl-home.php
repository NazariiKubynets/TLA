<?php
/*
    Template name: Home
*/

?>
<?php get_header(); ?>
<?php $pageId = get_queried_object_id(); ?>

<?php

$hero = get_field('hero');
$contact = get_field('contact', 'option');
$blockInfo = get_field('block_info');
$blockInfoSecondary = get_field('block_info_secondary');
$tours = get_field('tours');
$blockInfoThird = get_field('block_info_third');
$guides = get_field('guides');
$infoPosts = get_field('info_posts');
?>


<?php $security = get_field('security') ?>

    <section class="home-hero">
        <div class="home-hero__container container">
            <?php if (isset($hero['titles_list']) && !empty($hero['titles_list'])) : ?>
                <?php foreach ($hero['titles_list'] as $index => $item) { ?>
                    <?php if ($index === 0): ?>
                        <h1 class="home-hero__title title-xxl">
                            <?= $item['title'] ?>
                        </h1>
                    <?php else: ?>
                        <span class="home-hero__title title-xxl">
                            <?= $item['title'] ?>
                        </span>
                    <?php endif; ?>
                <?php } ?>
            <?php endif; ?>
        </div>
        <div class="home-hero__poster">
            <img class="img" src="<?= $hero['bg_img'] ?>" alt="Background Image">
        </div>
        <video class="home-hero__video home-hero__video--desk " muted loop playsinline data-src="<?= $hero['bg_video']['url'] ?>">
            <source src="" type="video/mp4">
        </video>
        <video class="home-hero__video home-hero__video--mobile" muted loop playsinline data-src="<?= $hero['bg_video_mobile']['url'] ?>">
            <source src="" type="video/mp4">
        </video>
    </section>

    <section class="block-info block-info--first">
        <div class="block-info__container container custom-line">
            <h2 class="block-info__title title-xl">
                <?= $blockInfo['title'] ?>
            </h2>
            <p class="block-info__text"><?= $blockInfo['text'] ?></p>
            <p class="block-info__quote"><?= $blockInfo['quote'] ?></p>
            <p class="block-info__author"><?= $blockInfo['author'] ?></p>
            <a class="block-info__btn btn" href="<?= $contact['link_buttons_main']['url'] ?>">
                <?= $contact['link_buttons_main']['title'] ?>
            </a>
        </div>
    </section>

    <section class="tours">
        <div class="block-info">
            <div class="block-info__container container">
                <h2 class="block-info__title title-xl">
                    <?= $blockInfoSecondary['title'] ?>
                </h2>
                <p class="block-info__text"><?= $blockInfoSecondary['text'] ?></p>
                <p class="block-info__quote"><?= $blockInfoSecondary['quote'] ?></p>
                <p class="block-info__author"><?= $blockInfoSecondary['author'] ?></p>
            </div>
        </div>
        <div class="tours__container container custom-line">
            <div class="tours__grid">
                <?php if ($tours['which_posts'] === 'Сhoose yourself') {
                    foreach ($tours['selected_posts'] as $post) {
                        setup_postdata($post);
                        get_template_part('templates/items/_tour-post', null,
                            ['className' => 'tour-post--tours', 'text' => 'Explore Journeys']);
                    }
                } else {
                    $queryArgs = array(
                        'post_type' => 'destinations',
                        'posts_per_page' => -1,
                        'orderby' => 'date',
                    );

                    $query = new WP_Query($queryArgs);

                    while ($query->have_posts()) {
                        $query->the_post();
                        get_template_part('templates/items/_tour-post', null,
                            ['className' => 'tour-post--tours', 'text' => 'Explore Journeys']);
                    }
                }
                wp_reset_postdata();
                ?>
            </div>
            <a class="tours__btn btn" href="<?= $contact['link_buttons_main']['url'] ?>">
                <?= $contact['link_buttons_main']['title'] ?>
            </a>
        </div>
    </section>

    <section class="team">
        <div class="block-info">
            <div class="block-info__container container">
                <h2 class="block-info__title title-xl">
                    <?= $blockInfoThird['title'] ?>
                </h2>
                <p class="block-info__text"><?= $blockInfoThird['text'] ?></p>
                <p class="block-info__quote"><?= $blockInfoThird['quote'] ?></p>
                <p class="block-info__author"><?= $blockInfoThird['author'] ?></p>
            </div>
        </div>
        <?php
            get_template_part('templates/blocks/_leadership', null, [
                'field' => get_field('leadership')]);
        ?>
        <div class="team__container container">
            <h3 class="team__title title-l">
                <?= $guides['title'] ?>
            </h3>
            <p class="team__text"><?= $guides['text'] ?></p>
            <div class="team__grid">
                <?php if (isset($guides['guides']) && !empty($guides['guides'])) : ?>
                    <?php foreach ($guides['guides'] as $index => $item) { ?>
                        <div class="team__item <?= $index >= 6 ? 'hidden' : '' ?>" data-micromodal-open="modal-worker" data-index="<?= $index ?>">
                            <div class="team__img">
                                <?= wp_get_attachment_image_lazy($item['img'], 'medium_large', 'img'); ?>
                                <svg class="team__icon">
                                    <use xlink:href="<?= getSvgSpriteUrl() ?>#leadership-plus"/>
                                </svg>
                            </div>
                            <h4 class="team__name"><?= $item['name'] ?></h4>
                            <p class="team__country">
                                <?= $item['country'] ?>
                            </p>
                        </div>
                    <?php } ?>
                <?php endif; ?>
            </div>
            <?php get_template_part('templates/modals/_worker', null); ?>
            <button class="team__btn btn">
                See More Totally Guides
            </button>
        </div>
    </section>

    <section class="info-posts">
        <div class="info-posts__container container">
            <div class="info-posts__wrap">
                <h2 class="info-posts__title title-l">
                    <?= $infoPosts['title'] ?>
                </h2>
                <a class="info-posts__link info-posts__link--desk"
                   href="<?= $infoPosts['link']['url'] ?>">
                    <?= $infoPosts['link']['title'] ?>
                </a>
            </div>
            <div class="info-posts__grid">
                <?php if ($infoPosts['which_posts'] === 'Сhoose yourself') {
                    foreach ($infoPosts['selected_posts'] as $post) {
                        setup_postdata($post);
                        get_template_part('templates/items/_info-post', 'null');
                    }
                } else {
                    $queryArgs = array(
                        'post_type' => 'post',
                        'posts_per_page' => 3,
                        'orderby' => 'date',
                    );

                    $query = new WP_Query($queryArgs);

                    while ($query->have_posts()) {
                        $query->the_post();
                        get_template_part('templates/items/_info-post', 'null');
                    }
                }
                wp_reset_postdata();
                ?>
            </div>
            <a class="info-posts__link info-posts__link--mobile"
               href="<?= $infoPosts['link']['url'] ?>">
                <?= $infoPosts['link']['title'] ?>
            </a>
        </div>
    </section>


<?php get_footer(); ?>

<script>
    const guides = <?= json_encode($guides['guides']); ?>;
</script>
