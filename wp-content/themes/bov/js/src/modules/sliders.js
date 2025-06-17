import Swiper from 'swiper/bundle';


export default function () {

    function initializeSwiper(sliderClass, paginationClass, navigationNextClass, navigationPrevClass, spaceBetween) {
        if (document.querySelector(sliderClass)) {
            return new Swiper(sliderClass, {
                speed: 800,
                spaceBetween: spaceBetween,
                slidesPerView: 1,
                pagination: {
                    el: paginationClass,
                    clickable: true,
                    // dynamicBullets: true,
                },
                navigation: {
                    nextEl: navigationNextClass,
                    prevEl: navigationPrevClass,
                },
                watchOverflow: true,
            });
        }
        return null;
    }

    const mainSwiper = initializeSwiper(
        '.introduction__swiper',
        '.introduction__swiper-pagination',
        '.introduction__swiper-nav--next',
        '.introduction__swiper-nav--prev',
        30
    );

    const modalSwiper = initializeSwiper(
        '.introduction__swiper-modal',
        '.introduction__swiper-pagination-modal',
        '.introduction__swiper-nav-modal--next',
        '.introduction__swiper-nav-modal--prev',
        30
    );

    if (mainSwiper && modalSwiper) {
        mainSwiper.on('slideChange', () => {
            modalSwiper.slideTo(mainSwiper.activeIndex);
        });

        document.querySelectorAll('[data-micromodal-open="modal-tour-photos"]').forEach((trigger) => {
            trigger.addEventListener('click', () => {
                modalSwiper.slideTo(mainSwiper.activeIndex);
            });
        });
    }

}

function initiaOffersSwiper(sliderClass, paginationClass) {
    if (document.querySelector(sliderClass)) {
        const slider = new Swiper(sliderClass, {
            speed: 800,
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

function initTabSwiper(sliderClass) {
    if (document.querySelector(sliderClass)) {
        const slider = new Swiper(sliderClass, {
            speed: 800,
            spaceBetween: 40,
            slidesPerView: 'auto',
            freeMode: {
                enabled: true,
                sticky: true,
            },
            grabCursor: true,
        });

        const slides = document.querySelectorAll(`${sliderClass} .swiper-slide`);
        slides.forEach((slide, index) => {
            slide.addEventListener('click', () => {
                slider.slideTo(index);
            });
        });
    }
}

initTabSwiper('.introduction__swiper-tabs');

