export default function () {

    document.addEventListener('DOMContentLoaded', function () {
        function toggleActiveOnClass(clickClass, targetClassOne, targetClassTwo) {
            const clickElements = document.querySelectorAll(clickClass);
            const targetElementsOne = document.querySelectorAll(targetClassOne);
            const targetElementsTwo = document.querySelectorAll(targetClassTwo);

            clickElements.forEach(clickElement => {
                clickElement.addEventListener('click', function (e) {
                    e.stopPropagation();
                    targetElementsOne.forEach(targetElement => targetElement.classList.toggle('active'));
                    targetElementsTwo.forEach(targetElement => targetElement.classList.toggle('active'));
                });
            });

            document.addEventListener('click', function () {
                targetElementsOne.forEach(targetElement => targetElement.classList.remove('active'));
                targetElementsTwo.forEach(targetElement => targetElement.classList.remove('active'));
            });


            [clickElements, targetElementsOne].forEach(elements => {
                elements.forEach(element => {
                    element.addEventListener('click', function (e) {
                        e.stopPropagation();
                    });
                });
            });
        }

        toggleActiveOnClass('.posts-archive__filter-header', '.posts-archive__filter-list', '.posts-archive__filter-icon');
    });



}