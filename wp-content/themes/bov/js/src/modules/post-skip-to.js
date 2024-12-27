export default function () {
    document.addEventListener("DOMContentLoaded", function () {
        const sideMenuList = document.querySelector('.blog-post__side-menu-list');
        const headers = document.querySelectorAll('.blog-post__content h2, .blog-post__content h3');

        headers.forEach((header, index) => {

            if (!header.id) {
                header.id = `heading-${index}`;
            }

            const listItem = document.createElement('li');
            listItem.classList.add('blog-post__side-menu-item');

            const link = document.createElement('a');
            link.href = `#${header.id}`;

            const title = document.createElement('p');
            title.classList.add('blog-post__side-menu-title');
            title.textContent = header.textContent;

            link.appendChild(title);
            listItem.appendChild(link);
            sideMenuList.appendChild(listItem);
        });
    });

}