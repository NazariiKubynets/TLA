gsap.registerPlugin(ScrollTrigger);

const laptopScreen = window.matchMedia('(min-width: 1200px)');
if (laptopScreen.matches) {

////////HOME PAGE////////
    if (document.querySelectorAll('.block-info')) {

        const blocks = document.querySelectorAll('.block-info');

        blocks.forEach(block => {
            const elements = block.querySelectorAll('.block-info__title, .block-info__text, .block-info__quote, .block-info__author, .block-info__btn');

            elements.forEach((element, index) => {
                gsap.from(element, {
                        opacity: 0,
                        y: 60,
                        duration: 0.5,
                        ease: 'power3.out',
                        scrollTrigger: {
                            trigger: block,
                            start: 'top 80%',
                            end: 'bottom 50%',
                            scrub: 1,
                            once: true,
                        }
                    },
                );
            });
        });
    }


    if (document.querySelector('.team')) {

        const leadershipItems = document.querySelectorAll('.leadership__item:not(.hidden), .leadership__btn');
        const hiddenItems = document.querySelectorAll('.leadership__item.hidden');
        const seeMoreBtn = document.querySelector('.leadership__btn');
        const guidesItems = document.querySelectorAll('.team__item');
        const elements = document.querySelectorAll('.team__title, .team__text');
        const showItem = (items) => {

            items.forEach((item, index) => {
                const delay = (index % 3) * 0.25;
                gsap.to(item, {
                    opacity: 1,
                    y: 0,
                    ease: 'power3.out',
                    duration: 0.5,
                    delay: delay,
                    scrollTrigger: {
                        trigger: item,
                        start: 'top 80%',
                        toggleActions: 'play none none none',
                        once: true,
                    },
                });
            });
        }

        showItem(leadershipItems);

        seeMoreBtn.addEventListener('click', () => {
            // hiddenItems.forEach(item => {
            //     item.classList.remove('hidden');
            // });
            showItem(hiddenItems);
        });

        guidesItems.forEach((item, index) => {
            const delay = (index % 4) * 0.15;
            gsap.from(item, {
                opacity: 0,
                y: 80,
                ease: 'power3.out',
                delay: delay,
                scrollTrigger: {
                    trigger: item,
                    start: 'top 80%',
                    toggleActions: 'play none none none',
                    once: true,
                },
            });
        });


        const tl = gsap.timeline({
            scrollTrigger: {
                trigger: '.team__title',
                start: 'top 80%',
                end: 'bottom 20%',
                once: true,
            }
        });

        elements.forEach((element, index) => {
            tl.from(element,
                {opacity: 0, y: 60, duration: 0.5, ease: 'power3.out'},
                index * 0.2
            );
        });
    }

    if (document.querySelector('.info-posts')) {
        const tl = gsap.timeline({
            scrollTrigger: {
                trigger: '.info-posts__wrap',
                start: 'top 80%',
                once: true,
            }
        });

        gsap.set(['.info-posts__title', '.info-posts__link'], {opacity: 0, y: 60});

        tl.to(['.info-posts__title', '.info-posts__link'], {
            opacity: 1,
            y: 0,
            duration: 0.5,
            ease: 'power3.out',
            stagger: 0
        });
    }


///////////SINGLE DESTINATION ////////////////////////////////////////
    /////////INTRODUCTIONS////////////
    if (document.querySelector('.cognitive-block')) {
        const tl = gsap.timeline();

        tl.from(['.cognitive-block__subtitle', '.cognitive-block__title'], {
            opacity: 0,
            y: 40,
            ease: 'power3.out',
            duration: 1,
            stagger: 0.5,
        }, 1);

        const children = document.querySelectorAll('.cognitive-block__text > *, .cognitive-block__btn');

        children.forEach((item) => {
            gsap.from(item, {
                opacity: 0,
                y: 40,
                ease: 'power3.out',
                duration: 0.5,
                scrollTrigger: {
                    trigger: item,
                    start: 'top 90%',
                    toggleActions: 'play none none none',
                    once: true
                },
            });
        });

        const childrenSidebar = document.querySelectorAll('.cognitive-block__sidebar > *');

        childrenSidebar.forEach((item) => {
            gsap.from(item, {
                opacity: 0,
                x: 40,
                ease: 'power3.out',
                duration: 1,
                scrollTrigger: {
                    trigger: item,
                    start: 'top 80%',
                    toggleActions: 'play none none none',
                    once: true
                },
            });
        });
    }


    ///////// PRINCIPAL DESTINATIONS ///////////////
    if (document.querySelector('.directions')) {
        const tl = gsap.timeline({
            scrollTrigger: {
                trigger: '.directions',
                start: 'top 80%',
                once: true,
            }
        });

        tl.from('.directions__subtitle, .directions__title', {
            opacity: 0,
            y: 60,
            duration: 0.5,
            ease: 'power3.out',
            stagger: 0.25,
        });

        const items = document.querySelectorAll('.directions__swiper-slide');

        items.forEach((item, index) => {
            const delay = (index % 3) * 0.25;
            gsap.from(item, {
                opacity: 0,
                y: 80,
                ease: 'power3.out',
                delay: delay,
                scrollTrigger: {
                    trigger: item,
                    start: 'top 80%',
                    toggleActions: 'play none none none',
                    once: true,
                },
            });
        });
    }


    ///////// NEED TO KNOW //////////////
    if (document.querySelector('.important-info')) {

        const tl = gsap.timeline({
            scrollTrigger: {
                trigger: '.important-info',
                start: 'top 80%',
                once: true,
            }
        });

        tl.from('.important-info__title', {
            opacity: 0,
            y: 60,
            duration: 0.5,
            ease: 'power3.out',
        });

        const items = document.querySelectorAll('.important-info__item');
        tl.from(items, {
            opacity: 0,
            duration: 0.5,
            ease: 'power3.out',
            stagger: 0.15,
        }, 0.5);
    }

/////////////SINGLE TOUR////////////////////////////////////////
    /////////INTRODUCTION/////////////////
    if (document.querySelector('.introduction')) {

        const tl = gsap.timeline();

        tl.from('.introduction__title', {
            opacity: 0,
            y: 40,
            ease: 'power3.out',
            duration: 1,
            stagger: 0.5,
        }, 1);

        const children = document.querySelectorAll('.introduction__text > *');

        children.forEach((item) => {
            gsap.from(item, {
                opacity: 0,
                y: 40,
                ease: 'power3.out',
                duration: 0.5,
                scrollTrigger: {
                    trigger: item,
                    start: 'top 90%',
                    toggleActions: 'play none none none',
                    once: true
                },
            });
        });

        const elements = document.querySelectorAll('.introduction__img, .introduction__video-container, .introduction__overview, .introduction__info-block, .introduction__info-block-secondary, .introduction__swiper-wrap');

        elements.forEach((item) => {
            gsap.from(item, {
                opacity: 0,
                ease: 'power3.out',
                duration: 1,
                scrollTrigger: {
                    trigger: item,
                    start: 'top 80%',
                    toggleActions: 'play none none none',
                    once: true,
                },
            });
        });

        const items = document.querySelectorAll('.introduction__descriptions-item');

        items.forEach((item) => {
            gsap.from(item, {
                opacity: 0,
                y: 40,
                ease: 'power3.out',
                duration: 0.5,
                scrollTrigger: {
                    trigger: item,
                    start: 'top 90%',
                    toggleActions: 'play none none none',
                    once: true
                },
            });
        });

        const childrenSidebar = document.querySelectorAll('.introduction__sidebar > *');

        childrenSidebar.forEach((item) => {
            gsap.from(item, {
                opacity: 0,
                x: 40,
                ease: 'power3.out',
                duration: 1,
                scrollTrigger: {
                    trigger: item,
                    start: 'top 80%',
                    toggleActions: 'play none none none',
                    once: true
                },
            });
        });

        const tlTabs = gsap.timeline({
            scrollTrigger: {
                trigger: '.introduction__information',
                start: 'top 80%',
                once: true,
            }
        });

        tlTabs.from('.introduction__information-title', {
            opacity: 0,
            y: 40,
            ease: 'power3.out',
            duration: 0.5,
        });

        tlTabs.from('.introduction__information-toggle', {
            opacity: 0,
            x: 40,
            ease: 'power3.out',
            duration: 0.5,
            stagger: 0.25
        });

        tlTabs.from('.introduction__information-content', {
            opacity: 0,
            ease: 'power3.out',
            duration: 0.5,
        });
    }


    ///////////OFFERS////////////////////
    if (document.querySelector('.offers')) {

        const tl = gsap.timeline({
            scrollTrigger: {
                trigger: '.offers__title',
                start: 'top 90%',
                once: true,
            }
        });

        tl.from('.offers__title',
            {opacity: 0, y: 60, duration: 0.5, ease: 'power3.out'},
        )


        const items = document.querySelectorAll('.tour-post');
        items.forEach((item, index) => {
            const delay = (index % 3) * 0.25;
            gsap.from(item, {
                opacity: 0,
                y: 80,
                ease: 'power3.out',
                delay: delay,
                scrollTrigger: {
                    trigger: item,
                    start: 'top 80%',
                    toggleActions: 'play none none none',
                    once: true,
                },
            });
        });
    }


//////////// TRAVELOGUE /////////////
    if (document.querySelector('.posts-archive')) {

        const elements = document.querySelectorAll('.posts-archive__search, .posts-archive__filter');
        const tl = gsap.timeline();

        tl.from(elements, {
            opacity: 0,
            y: 60,
            ease: 'power3.out',
            duration: 1,
            stagger: 0,
        }, 0.7);

        const items = document.querySelectorAll('.archive-posts__post-item');
        items.forEach((item, index) => {
            const delay = (index % 3) * 0.15;
            gsap.from(item, {
                opacity: 0,
                y: 60,
                ease: 'power3.out',
                delay: delay,
                scrollTrigger: {
                    trigger: item,
                    start: 'top 95%',
                    toggleActions: 'play none none none',
                    once: true,
                },
            });
        });
    }


//////////// SINGLE BLOG POST/////////////
    if (document.querySelector('.blog-post')) {

        const elements = document.querySelectorAll('.blog-post__row');
        const tl = gsap.timeline();

        tl.from(elements, {
            opacity: 0,
            y: 60,
            ease: 'power3.out',
            duration: 1,
            stagger: 0,
        }, 0.7);

        const children = document.querySelectorAll('.blog-post__content > *, .blog-post__contact-us');

        children.forEach((item) => {
            gsap.from(item, {
                opacity: 0,
                y: 40,
                ease: 'power3.out',
                duration: 0.5,
                scrollTrigger: {
                    trigger: item,
                    start: 'top 90%',
                    toggleActions: 'play none none none',
                    once: true
                },
            });
        });
    }

    ////////// SIMILAR ARTICLES //////////
    if (document.querySelector('.similar-articles')) {


        gsap.from('.similar-articles__title', {
            opacity: 0,
            y: 60,
            duration: 0.5,
            ease: 'power3.out',
            scrollTrigger: {
                trigger: '.similar-articles__title',
                start: 'top 80%',
                once: true,
            }
        });

        const items = document.querySelectorAll('.archive-posts__post-item');

        items.forEach((item, index) => {
            gsap.from(item, {
                opacity: 0,
                duration: 0.5,
                ease: 'power3.out',
                delay: index * 0.15,
                scrollTrigger: {
                    trigger: item,
                    start: 'top 80%',
                    once: true
                }
            });
        });
    }


//////////// CONTACT US /////////////
    if (document.querySelector('.contact-us-form')) {

        const tl = gsap.timeline();

        tl.from('.contact-form__top', {
            opacity: 0,
            ease: 'power3.out',
            duration: 1,
            stagger: 0,
        }, 0.7);

        tl.from('.contact-us-form__info, .contact-us-form__contact', {
            opacity: 0,
            x: 60,
            ease: 'power3.out',
            duration: 1,
            stagger: 0,
        }, 0.7);

        gsap.from('.contact-form__bottom', {
            opacity: 0,
            ease: 'power3.out',
            duration: 1,
            scrollTrigger: {
                trigger: '.contact-form__bottom',
                start: 'top 80%',
                once: true,
            },
        });
    }
//////////// TESTIMONIALS /////////////

    if (document.querySelector('.testimonials')) {

        const tl = gsap.timeline();
        const items = document.querySelectorAll('.testimonials__item');
        items.forEach((item) => {
            gsap.from(item, {
                opacity: 0,
                y: 60,
                ease: 'power3.out',
                scrollTrigger: {
                    trigger: item,
                    start: 'top 80%',
                    toggleActions: 'play none none none',
                    once: true,
                },
            });
        });

        tl.from('.introduction__form', {
            opacity: 0,
            x: 60,
            ease: 'power3.out',
            duration: 1,
        });

        gsap.from('.introduction__advantages', {
            opacity: 0,
            x: 60,
            ease: 'power3.out',
            duration: 1,
            scrollTrigger: {
                trigger: '.introduction__advantages',
                start: 'top 80%',
                once: true,
            },
        });
    }


//////////// ETHICAL CONSCIENCE /////////////
    if (document.querySelector('.ethical-conscience')) {

        const children = document.querySelectorAll('.ethical-conscience__content > *, .ethical-conscience__motto, .quote');

        children.forEach((item) => {
            gsap.from(item, {
                opacity: 0,
                y: 40,
                ease: 'power3.out',
                duration: 0.5,
                scrollTrigger: {
                    trigger: item,
                    start: 'top 90%',
                    toggleActions: 'play none none none',
                    once: true
                },
            });
        });

        const tl = gsap.timeline({
            scrollTrigger: {
                trigger: '.ethical-conscience-advantages',
                start: 'top 80%',
                once: true,
            }
        });

        tl.from('.ethical-conscience-advantages__title', {
            opacity: 0,
            y: 60,
            duration: 0.5,
            ease: 'power3.out',
        });

        const items = document.querySelectorAll('.ethical-conscience-advantages__item');
        tl.from(items, {
            opacity: 0,
            duration: 0.5,
            ease: 'power3.out',
            stagger: 0.15,
        }, 0.5);
    }


//////////// ON DIFFERENT PAGES /////////////
///////////// HERO ///////////////////
    if (document.querySelector('.hero')) {

        const elements = document.querySelectorAll('.hero__subtitle, .hero__title, .hero__text');
        const tl = gsap.timeline();

        tl.from(elements, {
            opacity: 0,
            y: 60,
            ease: 'power3.out',
            duration: 1,
            stagger: 0.25,
        });
    }


/////////////TOC///////////////////
    if (document.querySelector('.toc')) {

        const elements = document.querySelectorAll('.toc__title');
        const tl = gsap.timeline();

        tl.from(elements, {
            opacity: 0,
            x: 40,
            ease: 'power3.out',
            duration: 1,
            stagger: 0.25,
        });
    }


///////////TOURS////////////
    if (document.querySelector('.tours')) {

        const elementsTours = document.querySelectorAll('.tours__subtitle, .tours__title');
        const tl = gsap.timeline({
            scrollTrigger: {
                trigger: '.tours',
                start: 'top 80%',
                end: 'bottom 50%',
                once: true,
            }
        });

        elementsTours.forEach((element) => {
            tl.from(
                element,
                {opacity: 0, y: 60, duration: 0.5, ease: 'power3.out'},
            )
        });

        const items = document.querySelectorAll('.tour-post, .tours__btn');
        items.forEach((item, index) => {
            const delay = (index % 3) * 0.15;
            gsap.from(item, {
                opacity: 0,
                y: 80,
                ease: 'power3.out',
                delay: delay,
                scrollTrigger: {
                    trigger: item,
                    start: 'top 90%',
                    toggleActions: 'play none none none',
                    once: true,
                },
            });
        });
    }


///////////LIST DESTINATIONS////////////
    if (document.querySelector('.top-places')) {
        const elements = document.querySelectorAll('.top-places__subtitle, .top-places__title');
        const tl = gsap.timeline({
            scrollTrigger: {
                trigger: '.top-places',
                start: 'top 80%',
                end: 'bottom 50%',
                once: true,
            }
        });

        elements.forEach((element) => {
            tl.from(
                element,
                {opacity: 0, y: 60, duration: 0.5, ease: 'power3.out'},
            )
        });

        const items = document.querySelectorAll('.tour-post:not(.hidden), .tour-post.hidden--desk, .top-places__btn');
        const itemsHiddenDesk = document.querySelectorAll('.tour-post.hidden:not(.hidden--desk)');
        const seeMoreBtn = document.querySelector('.top-places__btn');

        const showItem = (items) => {

            items.forEach((item, index) => {
                const delay = (index % 3) * 0.25;
                gsap.from(item, {
                    opacity: 0,
                    y: 80,
                    ease: 'power3.out',
                    delay: delay,
                    scrollTrigger: {
                        trigger: item,
                        start: 'top 80%',
                        toggleActions: 'play none none none',
                        once: true,
                    },
                });
            });
        }

        showItem(items);

        // seeMoreBtn.addEventListener('click', () => {
        // const tl = gsap.timeline();
        // tl.from(itemsHiddenDesk, {
        //     opacity: 0,
        //     y: 80,
        //     ease: 'power3.out',
        //     duration: 1,
        //     stagger: 0.5,
        // });
        // });
    }


///////////FAQs////////////
    if (document.querySelector('.faq')) {
        const items = document.querySelectorAll('.faq__accordion-item');
        const tl = gsap.timeline({
            scrollTrigger: {
                trigger: '.faq',
                start: 'top 90%',
                once: true,
            }
        });

        tl.from('.faq__title', {
            opacity: 0,
            duration: 1,
            ease: 'power3.out',
        });

        items.forEach((item) => {
            gsap.from(item, {
                opacity: 0,
                y: 80,
                ease: 'power3.out',
                duration: 0.5,
                scrollTrigger: {
                    trigger: item,
                    start: 'top 95%',
                    toggleActions: 'play none none none',
                    once: true,
                },
            });
        });
    }


///////////INSPIRATION////////////
    if (document.querySelector('.info-posts__grid') || document.querySelector('.inspiration')) {

        const items = document.querySelectorAll('.info-post__item');

        items.forEach((item, index) => {
            gsap.from(item, {
                opacity: 0,
                duration: 0.5,
                ease: 'power3.out',
                delay: index * 0.15,
                scrollTrigger: {
                    trigger: item,
                    start: 'top 80%',
                    toggleActions: 'play none none reverse',
                    once: true
                }
            });
        });
    }

    if (document.querySelector('.inspiration')) {

        const tl = gsap.timeline({
            scrollTrigger: {
                trigger: '.inspiration',
                start: 'top 80%',
                once: true,
            }
        });

        tl.from('.inspiration__title', {
            opacity: 0,
            y: 60,
            duration: 0.5,
            ease: 'power3.out',
        });
    }


///////////CONTACT BLOCK////////////
    if (document.querySelector('.contact')) {
        const tl = gsap.timeline({
            scrollTrigger: {
                trigger: '.contact',
                start: 'top 80%',
                once: true,
            }
        });
        gsap.set(['.contact__title', '.btn-animations'], {opacity: 0, y: 60});
        gsap.set('.contact__column-first', {opacity: 0, x: 60});
        gsap.set('.contact__column-secondary', {opacity: 0, x: -60});
        tl.to('.contact__title', {
            opacity: 1,
            y: 0,
            duration: 0.5,
            ease: 'power3.out',
        });

        tl.to(['.contact__column-first', '.contact__column-secondary'], {
            opacity: 1,
            x: 0,
            duration: 1,
            ease: 'power3.out',
            stagger: 0
        });

        tl.to('.btn', {
            opacity: 1,
            y: 0,
            duration: 0.5,
            ease: 'power3.out',
        });
    }
}
