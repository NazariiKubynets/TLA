export default function () {
    $(document).ready(function () {
        const currentUrl = window.location.pathname;
        const pageMatch = currentUrl.match(/\/page\/(\d+)/);

        if (pageMatch && pageMatch[1] > 1) {

            const $firstPost = $('#first-post');
            if ($firstPost.length) {
                $('html, body').animate({
                    scrollTop: $firstPost.offset().top - 100
                }, 'smooth');
            }
        }
    });

}