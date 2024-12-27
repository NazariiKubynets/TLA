export default function () {
    const toggleVisibility = (btnClass, itemClass, thresholds = { desktop: 9, mobile: 6 }) => {
        $(document).ready(() => {
            const $btn = $(btnClass);
            const $allItems = $(itemClass);
            let $hiddenItems = $allItems.filter('.hidden');

            const updateVisibility = () => {
                $hiddenItems = $allItems.filter('.hidden');
                const isDesktop = $(window).width() >= 992;
                const threshold = isDesktop ? thresholds.desktop : thresholds.mobile;

                if ($allItems.length <= threshold || $hiddenItems.length === 0) {
                    $btn.hide();
                } else {
                    $btn.show();
                }
            };

            updateVisibility();

            $btn.on('click', () => {
                $hiddenItems.removeClass('hidden');
                updateVisibility();
            });

            $(window).on('resize', updateVisibility);
        });
    };



    toggleVisibility('.team__btn', '.team__item');
    toggleVisibility('.leadership__btn', '.leadership__item');
    toggleVisibility('.destination__btn', '.destination-tour-post', { desktop: 9, mobile: 6 });
    toggleVisibility('.top-places__btn', '.single-tour-post', { desktop: 9, mobile: 6 });
};

