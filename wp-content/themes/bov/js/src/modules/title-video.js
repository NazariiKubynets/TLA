export default function () {

    document.addEventListener("DOMContentLoaded", function () {
        const homeHero = document.querySelector('.home-hero');
        if (!homeHero) return;
        const activeVideo = document.querySelector('.home-hero__video');
        const heroTitlesRefs = document.querySelectorAll('h1.home-hero__title, span.home-hero__title');
        const triggerTimes = [1, 6, 11, 16, 21, 26];
        let lastTriggeredTime = null;

        function executeAction(second) {
            const index = triggerTimes.indexOf(second);
            if (index !== -1) {
                const currentTitle = heroTitlesRefs[index];
                currentTitle.style.opacity = 1;

                setTimeout(() => {
                    currentTitle.style.opacity = 0;
                }, 2500);
            }
        }

        if (activeVideo) {

            activeVideo.addEventListener('timeupdate', () => {
                const currentTime = Math.floor(activeVideo.currentTime);

                if (triggerTimes.includes(currentTime) && lastTriggeredTime !== currentTime) {
                    lastTriggeredTime = currentTime;
                    executeAction(currentTime);
                }
            });

            activeVideo.addEventListener('ended', () => {
                lastTriggeredTime = null;
            });
        }
    });

}

