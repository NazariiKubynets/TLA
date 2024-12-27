export default function () {

    document.addEventListener('DOMContentLoaded', function () {
        const budgetSpan = document.querySelector('.contact-form-budget');
        const hiddenInput = document.querySelector('.contact-form__input-hidden');

        if (budgetSpan && hiddenInput) {
            let slider = document.getElementById('slider');

            const sliderMin = 3000;
            const sliderMax = 20000;

            function formatNumber(num) {
                return `£${num.toLocaleString('en-US')}`;
            }

            noUiSlider.create(slider, {
                start: [5000, 10000],
                step: 1000,
                connect: true,
                range: {
                    'min': [sliderMin],
                    'max': [sliderMax]
                },
            });

            slider.noUiSlider.on('update', function (values, handle) {
                const minVal = parseInt(slider.noUiSlider.get()[0]);
                const maxVal = parseInt(slider.noUiSlider.get()[1]);
                let rangeText;

                if (minVal === maxVal) {
                    if (maxVal === sliderMax) {
                        rangeText = `${formatNumber(maxVal)}+`;
                    } else {
                        rangeText = formatNumber(maxVal);
                    }
                } else {
                    if (maxVal === sliderMax) {
                        rangeText = `${formatNumber(minVal)} - ${formatNumber(maxVal)}+`;
                    } else {
                        rangeText = `${formatNumber(minVal)} - ${formatNumber(maxVal)}`;
                    }
                }

                budgetSpan.textContent = rangeText;
                hiddenInput.value = rangeText;
            });

            const initialMin = parseInt(slider.noUiSlider.get()[0]);
            const initialMax = parseInt(slider.noUiSlider.get()[1]);
            let initialRangeText;

            if (initialMin === initialMax) {
                initialRangeText = formatNumber(initialMax);
            } else {
                if (initialMax === sliderMax) {
                    initialRangeText = `${formatNumber(initialMin)} - ${formatNumber(initialMax)}+`;
                } else {
                    initialRangeText = `${formatNumber(initialMin)} - ${formatNumber(initialMax)}`;
                }
            }

            budgetSpan.textContent = initialRangeText;
            hiddenInput.value = initialRangeText;
        }

        const contactForm = document.querySelector('.contact-form');
        if (contactForm) {
            const selects = contactForm.querySelectorAll('select');

            selects.forEach(select => {
                // Initial style if not changed yet
                select.style.color = 'rgba(0, 0, 0, 0.6)';

                select.addEventListener('change', function () {
                    // When user changes selection
                    select.style.color = 'rgba(0, 0, 0, 1)';
                });
            });
        }

        const selects = document.querySelectorAll('select[name="contact-us-country"], select[name="contact-us-phone-code"]');
        selects.forEach(select => {
            const defaultOption = select.querySelector('option[value=""]');
            if (defaultOption) {
                if (select.name === 'contact-us-country') {
                    defaultOption.textContent = 'Select a country';
                } else if (select.name === 'contact-us-phone-code') {
                    defaultOption.textContent = 'Select a code';
                }
            }
        });
    });
}