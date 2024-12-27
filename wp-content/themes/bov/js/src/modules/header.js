export default function () {
    //Close/open menu when click on burger
    d.on('click', '.burger', function () {
        this.classList.toggle('burger--open');
        d.get('.mobile-menu').classList.toggle('mobile-menu--open');
        d.get('.main-header__wrap').classList.toggle('mobile-menu--open');
        d.get('.main-header__logo').classList.toggle('logo--bg');
        d.get('html').classList.toggle('js-hidden');
    });


    //Close on click outside
    //Detect all clicks on the document
    d.on("click", 'html', function (event) {
        //If mobile-menu is open and click is not on burger (menu opener)
        if (d.get('.mobile-menu--open') &&
            !event.target.closest('.burger')) {
            // If user clicks inside the mobile menu, do nothing
            if (event.target.closest(".mobile-menu")) return;

            // If user clicks outside the element, hide it!
            d.get('.mobile-menu').classList.remove('mobile-menu--open');
            d.get('.main-header__wrap').classList.remove('mobile-menu--open');
            d.get('.burger').classList.remove('burger--open');
            d.get('html').classList.remove('js-hidden');
        }
    });


    //Close open nesting submenu
    const parentLinks = d.getAll('.main-menu__item--parent  > a');
    d.on('click', parentLinks, function (e) {
        e.preventDefault();
        this.parentElement.classList.toggle('js-active');
        this.parentElement.querySelector('.main-menu__toggle').classList.toggle('js-active');
    });

    const toggles = d.getAll('.main-menu__toggle');
    d.on('click', toggles, function () {
        this.classList.toggle('js-active');
        this.parentElement.classList.toggle('js-active');
    });
}

