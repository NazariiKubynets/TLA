<?php
$search_query = isset($_GET['s']) ? sanitize_text_field($_GET['s']) : '';

get_header(); ?>


    <section class="hero hero--classic hero--bg-classic">
        <div class="hero__container container">
            <div class="hero__content">
                <h1 class="hero__title title-xl">Search results "<?= $search_query ?>":</h1>
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