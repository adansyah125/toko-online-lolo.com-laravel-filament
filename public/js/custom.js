document.addEventListener('DOMContentLoaded', () => {
    'use strict';

    // Initialize Tiny Slider for Testimonials
    const initTinySlider = () => {
        const sliderElements = document.querySelectorAll('.testimonial-slider');
        if (sliderElements.length > 0) {
            sliderElements.forEach(el => {
                tns({
                    container: el,
                    items: 1,
                    axis: 'horizontal',
                    controlsContainer: '#testimonial-nav',
                    swipeAngle: false,
                    speed: 700,
                    nav: true,
                    controls: true,
                    autoplay: true,
                    autoplayHoverPause: true,
                    autoplayTimeout: 3500,
                    autoplayButtonOutput: false,
                    responsive: {
                        768: { items: 2 },
                        992: { items: 3 }
                    }
                });
            });
            console.log('Tiny Slider initialized');
        }
    };

    // Initialize Quantity Plus/Minus
    const initQuantityControls = () => {
        const quantityContainers = document.querySelectorAll('.quantity-container');
        if (quantityContainers.length > 0) {
            quantityContainers.forEach(container => {
                const quantityAmount = container.querySelector('.quantity-amount');
                const increase = container.querySelector('.increase');
                const decrease = container.querySelector('.decrease');

                if (quantityAmount && increase && decrease) {
                    increase.addEventListener('click', () => updateQuantity(quantityAmount, 1));
                    decrease.addEventListener('click', () => updateQuantity(quantityAmount, -1));
                }
            });
        }
    };

    // Update Quantity Value
    const updateQuantity = (quantityAmount, change) => {
        let value = parseInt(quantityAmount.value, 10) || 0;
        value = Math.max(0, value + change); // Ensure value doesn't go below 0
        quantityAmount.value = value;
        console.log('Quantity updated to:', value);
    };

    // Initialize all functions
    initTinySlider();
    initQuantityControls();
});