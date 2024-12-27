<?php
get_header();

$pageId = get_queried_object_id();
$hero = get_field('hero', $pageId);
?>


<section class="blog-hero hero">
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
            <h1 class="hero__title title-xxl"><?= $hero['title'] ?></h1>
            <p class="hero__text"><?= $hero['text'] ?></p>
        </div>
    </div>
</section>


<section class="posts-archive">

    <?php
    $paged = get_query_var('paged') ? get_query_var('paged') : 1;
    $search_query = isset($_GET['s']) ? sanitize_text_field($_GET['s']) : 0;
    $args = array(
        'post_type' => 'post',
        'paged' => $paged,
        'orderby' => 'date',
        'order' => 'DESC'
    );
    $categories_id = !empty($_GET['countries']) ? explode(",", $_GET['countries']) : [];
    if (!empty($categories_id)) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'category',
                'field' => 'term_id',
                'terms' => $categories_id,
                'operator' => 'IN',
            ),
        );
    }
    if (!empty($search_query)) {
        $args['s'] = $search_query;
    }
    $query = new WP_Query($args); ?>

    <div class="posts-archive__container container">
        <div class="posts-archive__search-filter">
            <div class="posts-archive__search">
                <?php get_search_form(); ?>
            </div>
            <div class="posts-archive__filter">
                <div class="posts-archive__filter-header">
                    <span class="posts-archive__filter-title">Countries:</span>
                    <span class="posts-archive__filter-selected">
                        <?php
                        if (!empty($categories_id)) {
                            $selectedCategoriesNames = "";

                            foreach ($categories_id as $key => $value) {
                                $name = get_the_category_by_ID($value);
                                if (!empty($name)) $selectedCategoriesNames .= $name . ", ";
                                if ($key >= 1) break;
                            }
                            $filterCount = (count($categories_id) > 2) ? count($categories_id) - 2 : 0;
                            $selectedCategoriesNames = substr($selectedCategoriesNames, 0, -2);
                            echo $selectedCategoriesNames;
                        } else {
                            echo "All";
                        }
                        ?>
                    </span>
                    <?php
                    if (!empty($filterCount) && $filterCount != 0) { ?>

                        <span class="posts-archive__filter-count active">+<?= $filterCount ?></span>
                    <?php } else { ?>
                        <span class="posts-archive__filter-count"></span>
                    <?php } ?>

                    <button class="posts-archive__filter-toggle" aria-expanded="false">
                        <svg class="posts-archive__filter-icon">
                            <use xlink:href="<?= getSvgSpriteUrl() ?>#blog-toggle-down"/>
                        </svg>
                    </button>
                </div>
                <form class="posts-archive__filter-list">
                    <?php
                    $categories = get_categories();
                    if (!empty($categories)) :
                        foreach ($categories as $category) { ?>
                            <label class="posts-archive__filter-label">
                                <input class="posts-archive__filter-checkbox" type="checkbox"
                                       value="<?= $category->term_id ?>" <?= !empty($categories_id) && in_array($category->term_id, $categories_id) ? "checked" : "" ?>>
                                <?= $category->name ?>
                            </label>
                        <?php } ?>

                    <?php endif; ?>
                </form>
            </div>
        </div>
        <?php
        get_template_part('templates/items/_loading-indicator', null);
        ?>
        <div class="archive-posts__grid">
            <?php if ($query->have_posts()) :
                $post_count = 0;
                while ($query->have_posts()) : $query->the_post();
                    $post_count++;
                    get_template_part('templates/items/_archive-posts', null,
                        ['post-count' => $post_count]);
                    ?>
                <?php endwhile;
                wp_reset_postdata();
            else :
                echo "Posts not found.";
            endif; ?>
        </div>
        <div class="posts-archive__pagination">
            <?php
            echo paginate_links([
                'current' => max(1, get_query_var('paged')),
                'total' => $query->max_num_pages,
                'next_text' => '<svg width="9" height="14" viewBox="0 0 9 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1.5 13l6-6-6-6" stroke-width="1.5"/>
                </svg>',
                'prev_text' => '<svg width="9" height="14" viewBox="0 0 9 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M7.5 13l-6-6 6-6" stroke-width="1.5"/>
             </svg>'
            ]);

            ?>
        </div>
    </div>
</section>
<?php
global $wp;
$current_url = home_url($wp->request);
$pos = strpos($current_url, '/page');
$finalurl = $pos ? substr($current_url, 0, $pos) : $current_url;
?>
<script>
    var blogData = {};
    blogData.blog_url = "<?=$finalurl . "/"?>"
</script>
<script>

    document.addEventListener('DOMContentLoaded', function () {
        $ = jQuery;
        let categories = getCheckedCategories();
        let query = $('.hero__title').data('search-query') || '';
        let morePosts = 1;
        let $firstPost = 0;
        $('.loading-indicator').hide();
        $('.archive-posts__grid').addClass('visible');

        function getCheckedCategories() {
            let categories = [];
            $('.posts-archive__filter-checkbox:checked').each(function () {
                categories.push($(this).val());
            });
            return categories;
        }


        function scrollFirstPosts() {
            const $firstPost = $('#first-post');
            if ($firstPost.length) {
                $('html, body').animate({
                    scrollTop: $firstPost.offset().top - 200
                }, 600);
            }
        }

        // updatePaginationButtons(page, maxPages);
        function listCategories() {
            $('.archive-posts__post-category-container').each(function () {
                const $categoryContainer = $(this);
                const $categoriesList = $categoryContainer.find('.archive-posts__list-categories');
                const $showMoreButton = $categoryContainer.find('.archive-posts__show-more');

                const checkOverflow = function () {
                    if ($categoriesList[0].scrollHeight > $categoryContainer[0].clientHeight) {
                        $showMoreButton.addClass('show');
                    }
                };

                checkOverflow();

                $(window).on('resize', checkOverflow);

                $showMoreButton.on('click', function (event) {
                    event.preventDefault();
                    event.stopPropagation();
                    $categoryContainer.toggleClass('active');
                });
            });
        }

        if (window.location.search != "") {
            $('html, body').scrollTop($(".posts-archive").offset().top);
        }

        function formateUrl() {
            let url = "";
            if (query) {
                url = `?s=${encodeURIComponent(query)}`;
                if (categories.length > 0) {
                    url += `&countries=${categories.join()}`;
                }
            } else if (categories.length > 0) {
                url = `?countries=${categories.join()}`;
            }
            history.pushState({}, null, blogData.blog_url + url);
        }

        function load_posts(categories) {
            query = $('.search-form__input').val();
            formateUrl();
            $.ajax({
                url: window.wp_data.ajax_url,
                type: 'GET',
                data: {
                    action: 'filter_posts',
                    s: query,
                    categories: categories,
                    baseurl: blogData.blog_url,
                    security: wp_data.afp_nonce
                },
                beforeSend: function () {
                    $('.loading-indicator').show();
                    $('.archive-posts__grid').removeClass('visible');
                    $('.posts-archive__pagination').addClass('hide');

                },
                success: function (response) {
                    setTimeout(function () {
                        if (morePosts) {
                            $('.archive-posts__grid').html(response.grid);
                        } else {
                            $('.archive-posts__grid').append(response.grid);
                        }

                        $('.posts-archive__pagination').html(response.pagination);
                        $('.posts-archive__filter-selected').html(response.catSelected);
                        $('.posts-archive__filter-count').html(response.remainingCount);

                        if (categories.length > 2) {
                            $('.posts-archive__filter-count').addClass('active');
                        } else {
                            $('.posts-archive__filter-count').removeClass('active');
                        }

                        if ($firstPost) {
                            scrollFirstPosts();
                        }

                        listCategories();
                        $('.loading-indicator').hide();
                        $('.archive-posts__grid').addClass('visible');
                        $('.posts-archive__pagination').removeClass('hide');
                    }, 100);
                }
            });
        }

        //search-form
        $('.search-form').on('submit', function (e) {
            e.preventDefault();
            let categoriesString = categories.join(',');

            query = $(this).find('.search-form__input').val();
            let url;
            categories = getCheckedCategories();
            morePosts = 1;
            $firstPost = 0;
            load_posts(categories);

        });

        // filter categories
        $('.posts-archive__filter-list').on('change', function () {
            categories = getCheckedCategories();
            morePosts = 1;
            $firstPost = 0;
            load_posts(categories);
        });


    });
</script>
<?php get_footer(); ?>


