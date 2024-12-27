import {listCategories} from './blog-categories';

export default function () {

    jQuery(document).ready(function ($) {
        let categories =  getCheckedCategories();
        let page = 1;
        let query =  $('.hero__title').data('search-query') || '';
        let morePosts = 1;
        let maxPages = $('.posts-archive__next').data('max-pages') || 1;
        let $firstPost = 0;
        $('.loading-indicator').hide();

        function getCheckedCategories() {
            let categories = [];
            $('.posts-archive__filter-checkbox:checked').each(function() {
                categories.push($(this).val());
            });
            return categories;
        }

        function updatePaginationButtons(currentPage, maxPages) {
            if (maxPages === 1) {
                $('.posts-archive__pagination').addClass('hide');
                $('.posts-archive__more-posts').hide();
            } else {
                $('.posts-archive__pagination').removeClass('hide');
                if (currentPage === 1) {
                    $('.posts-archive__prev').addClass('hide');
                } else {
                    $('.posts-archive__prev').removeClass('hide');
                }

                if (currentPage === maxPages) {
                    $('.posts-archive__next').addClass('hide');
                    $('.posts-archive__more-posts').hide();
                } else {
                    $('.posts-archive__more-posts').show();
                    $('.posts-archive__next').removeClass('hide');
                }
            }

            $('.posts-archive__page').each(function () {
                let buttonPage = $(this).data('page');

                if (page === buttonPage) {
                    $(this).addClass('active');
                } else {
                    $(this).removeClass('active');
                }
            });
        }

        function scrollFirstPosts() {
            const $firstPost = $('#first-post');
            if ($firstPost.length) {
                $('html, body').animate({
                    scrollTop: $firstPost.offset().top - 200
                }, 600);
            }
        }

        updatePaginationButtons(page, maxPages);

        function load_posts(page, categories) {
            $.ajax({
                url: window.wp_data.ajax_url,
                type: 'POST',
                data: {
                    action: 'filter_posts',
                    paged: page,
                    s: query,
                    categories: categories,
                    security: wp_data.afp_nonce
                },
                beforeSend: function () {
                    $('.loading-indicator').show();
                    $('.archive-posts__grid').addClass('visible');
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

                        if ($firstPost){
                            scrollFirstPosts();
                        }
                        maxPages = $('.posts-archive__next').data('max-pages') || 1;
                        updatePaginationButtons(page, maxPages);
                        listCategories();
                        $('.loading-indicator').hide();
                        $('.archive-posts__grid').removeClass('visible');
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

            if(categoriesString){
                 url = `/?s=${encodeURIComponent(query)}&categories=${categoriesString}`;
            }else{
                 url = `/?s=${encodeURIComponent(query)}`;
            }

            window.location.href = url;
        });

        // filter categories
        $('.posts-archive__filter-list').on('change', function() {
            categories = getCheckedCategories();

            page = 1;
            morePosts = 1;
            $firstPost = 0;

            load_posts(page, categories);
        });


        // buttons pages
        $('.posts-archive__pagination').on('click', '.posts-archive__page', function (e) {
            page = $(this).data('page');
            $firstPost = 1;
            load_posts(page, categories);
        });

        //button next
        $('.posts-archive__pagination').on('click', '.posts-archive__next', function (e) {
            page += 1;
            $firstPost = 1;
            load_posts(page, categories);
        });

        //button prev
        $('.posts-archive__pagination').on('click', '.posts-archive__prev', function (e) {
            page -= 1;
            $firstPost = 1;
            load_posts(page, categories);
        });

        //more posts btn
        $('.posts-archive__more-posts').on('click', function () {
            page++;
            morePosts = 0;
            load_posts(page, categories);
        });
    });
}
