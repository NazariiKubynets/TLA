import initTabs from './modules/tabs';
import initAccordion from './modules/accordion';
import { initModals, modalConfig } from './modules/modals';
import initSliders from './modules/sliders';
import initToc from './modules/toc';
import initAnimations from './modules/animations';
import {listCategories} from './modules/blog-categories';
import initAddActive from './modules/blog-filter';
import {initForms} from './modules/forms';
import initTitleVideo from './modules/title-video';
import mobileMenu from './modules/header';
import initSeeMore from './modules/see-more';

initSeeMore();

initToc();
initAnimations();
listCategories();
initAddActive();
mobileMenu();
initTitleVideo();
initForms();
initTabs();
initAccordion();
initModals();
initSliders();

if ('scrollRestoration' in history) {
    history.scrollRestoration = 'manual';
}
window.addEventListener('DOMContentLoaded', () => {
    window.scrollTo(0, 0);
});
