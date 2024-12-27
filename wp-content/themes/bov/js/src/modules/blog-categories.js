const listCategories = () =>  {

    $(document).ready(function () {
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
    });
}

export {listCategories};