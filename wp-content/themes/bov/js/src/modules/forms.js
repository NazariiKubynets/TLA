function initForms() {
    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('wpcf7-not-valid-tip')) {
            event.target.style.display = 'none';
        }
    });

    //reset animation
    document.addEventListener('wpcf7submit', function(event) {
        const responseOutputs = document.querySelectorAll('.wpcf7-response-output');

        responseOutputs.forEach(function(responseOutput) {
            responseOutput.classList.remove('animate');
            void responseOutput.offsetWidth;
            responseOutput.classList.add('animate');
        });
    }, false);


}

export {initForms};