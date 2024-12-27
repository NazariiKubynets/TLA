export default function () {

    const components = d.getAll('.faq__accordion');

    components.forEach((component) => {
        const toggles = d.getAll({'.faq__toggle': component});
        const contents = d.getAll({'.faq__content': component});

        toggles.forEach((toggle, index) => {
            d.on('click', toggle, function () {

                if (toggle.classList.contains('faq__toggle--active')) {
                    toggle.classList.remove('faq__toggle--active');
                    contents[index].classList.remove('faq__content--active');
                } else {

                    toggles.forEach((item, idx) => {
                        item.classList.remove('faq__toggle--active');
                        contents[idx].classList.remove('faq__content--active');
                    });

                    toggle.classList.add('faq__toggle--active');
                    contents[index].classList.add('faq__content--active');
                }
            });
        });
    });

}