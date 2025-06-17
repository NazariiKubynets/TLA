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
            <?= wp_get_attachment_image(9717, 'large_1920',true, ['class' => 'img']) ?>
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
    $query = new WP_Query($args);
    $show = 1;
    if(!$query->have_posts()) {
        $show = 0;
        $args = array(
            'post_type' => 'post',
            'paged' => $paged,
            'orderby' => 'date',
            'order' => 'DESC'
        );
        $query = new WP_Query($args);
    }
    ?>

    <div class="posts-archive__container container">
        <div class="posts-archive__search-filter">
            <div class="posts-archive__search">
                <?php get_search_form(); ?>
            </div>
            <div class="posts-archive__filter">
                <div class="posts-archive__filter-header">
                    <span class="posts-archive__filter-title">Categories:</span>
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
        <div class="posts-archive__posts-none <?= $show ? "hide" : ''?>">
            <p class="posts-archive__posts-none-info">Posts not found!</p>
            <h2 class="title-l">Destination Inspiration</h2>
        </div>
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
                echo "Posts not found!";
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
        let typingTimer;
        let doneTypingInterval = 500;
        $('.loading-indicator').hide();
        $('.archive-posts__grid').addClass('visible');

        function getCheckedCategories() {
            let categories = [];
            $('.posts-archive__filter-checkbox:checked').each(function () {
                categories.push($(this).val());
            });
            return categories;
        }

        const animationsShowItem = () => {
            const laptopScreen = window.matchMedia('(min-width: 992px)');
            if (laptopScreen.matches) {
                const items = document.querySelectorAll('.archive-posts__post-item');
                items.forEach((item, index) => {
                    const delay = (index % 3) * 0.25;
                    gsap.to(item, {
                        opacity: 1,
                        y: 0,
                        ease: 'power3.out',
                        duration: 0.25,
                        delay: delay,
                        scrollTrigger: {
                            trigger: item,
                            start: 'top 90%',
                            toggleActions: 'play none none none',
                        },
                    });
                });
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

        function formateUrl() {
            let url = "";
            if (query) {
                url = `?s=${encodeURIComponent(query)}`;
                if (categories.length > 0) {
                    url += `&categories=${categories.join()}`;
                }
            } else if (categories.length > 0) {
                url = `?categories=${categories.join()}`;
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
                        if(response.grid){
                            $('.posts-archive__posts-none').addClass('hide');
                            $('.archive-posts__grid').html(response.grid);
                        }else{
                            $('.posts-archive__posts-none').removeClass('hide');
                        }

                        $('.posts-archive__pagination').html(response.pagination);
                        $('.posts-archive__filter-selected').html(response.catSelected);
                        $('.posts-archive__filter-count').html(response.remainingCount);

                        if (categories.length > 2) {
                            $('.posts-archive__filter-count').addClass('active');
                        } else {
                            $('.posts-archive__filter-count').removeClass('active');
                        }

                        listCategories();
                        $('.loading-indicator').hide();
                        animationsShowItem();
                        $('.archive-posts__grid').addClass('visible');
                        $('.posts-archive__pagination').removeClass('hide');
                    }, 100);
                }
            });
        }

        // search-form
        $('.search-form__input').on('input', function () {
            clearTimeout(typingTimer);
            let categoriesString = categories.join(',');

            query = $(this).val();
            categories = getCheckedCategories();

            typingTimer = setTimeout(function () {
                load_posts(categories);
            }, doneTypingInterval);
        });

        // filter categories
        $('.posts-archive__filter-list').on('change', function () {
            categories = getCheckedCategories();
            load_posts(categories);
        });

    });
</script>
<?php get_footer(); ?>


