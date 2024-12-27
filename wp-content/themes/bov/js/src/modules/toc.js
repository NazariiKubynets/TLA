export default function () {

    const addActiveOnClickAndScroll = (nameClass, sectionSelector) => {
        const navLinks = document.querySelectorAll(nameClass);
        const sections = document.querySelectorAll(sectionSelector);

        navLinks.forEach(link => {
            link.addEventListener('click', function () {
                navLinks.forEach(el => el.classList.remove('active'));
                this.classList.add('active');
            });
        });

        const observerOptions = {
            root: null,
            threshold: 0.2,
        };

        const observerCallback = (entries) => {
            entries.forEach(entry => {
                const section = entry.target;
                const id = section.getAttribute("id");
                const link = document.querySelector(`${nameClass}[href="#${id}"]`);

                const style = window.getComputedStyle(section);
                const isVisible = parseFloat(style.opacity) > 0;

                if (entry.isIntersecting && isVisible) {
                    navLinks.forEach(el => el.classList.remove("active"));
                    link?.classList.add("active");
                }
            });
        };

        const observer = new IntersectionObserver(observerCallback, observerOptions);

        sections.forEach(section => observer.observe(section));
    };

    addActiveOnClickAndScroll('.toc__title', '[id]');

}
