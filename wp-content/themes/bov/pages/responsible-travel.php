<?php
/*
Template Name: Responsible Travel
*/

get_header();
?>

    <section class="hero hero--classic hero--bg-classic">
        <div class="hero__container container">
            <div class="hero__content">
                <h1 class="hero__title title-xl"><?php the_title(); ?></h1>
            </div>
        </div>
    </section>

    <section class="responsible-travel">
        <div class="responsible-travel__container container the-content">
            <?php the_content(); ?>
        </div>
    </section>

<?php get_footer(); ?>