import Swiper from 'swiper/bundle';


export default function () {

    function initializeSwiper(sliderClass, paginationClass, navigationNextClass, navigationPrevClass, spaceBetween) {
        if (document.querySelector(sliderClass)) {
            const slider = new Swiper(sliderClass, {
                allowTouchMove: true,
                spaceBetween: spaceBetween,
                slidesPerView: 1,
                pagination: {
                    el: paginationClass,
                    clickable: true,
                },
                navigation: {
                    nextEl: navigationNextClass,
                    prevEl: navigationPrevClass,
                },
                watchOverflow: true,
                grabCursor: true,
            });
        }
    }

initializeSwiper('.introduction__swiper',
    '.introduction__swiper-pagination',
    '.introduction__swiper-nav--next',
    '.introduction__swiper-nav--prev', 30);

}

function initiaOffersSwiper(sliderClass, paginationClass) {
    if (document.querySelector(sliderClass)) {
        const slider = new Swiper(sliderClass, {
            spaceBetween: 30,
            slidesPerView: 1,
            pagination: {
                el: paginationClass,
                clickable: true,
            },
            watchOverflow: true,
            grabCursor: true,
            breakpoints: {
                // when window width is >= 992px
                768: {
                    slidesPerView: 9,
                    spaceBetween: 0
                },

            }
        });
    }
}

initiaOffersSwiper('.offers__swiper',
    '.offers__swiper-pagination');

initiaOffersSwiper('.directions__swiper',
    '.directions__swiper-pagination');
