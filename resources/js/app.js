import './bootstrap';

import Alpine from 'alpinejs';
import Typed from 'typed.js';

window.Alpine = Alpine;

Alpine.start();

// Initialize Typed.js when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    const target = document.getElementById('typewriter');

    if (target) {
        new Typed('#typewriter', {
          strings: [
            "Uncover the truth.",
            "Fact-check with confidence.",
            "Learn to spot misinformation."
          ],
          typeSpeed: 50, // Speed of typing
          backSpeed: 25, // Speed of deleting
          startDelay: 500, // Delay before typing starts
          backDelay: 1500, // Delay before backspacing starts
          loop: true, // Loop the animation indefinitely
          showCursor: false, // THIS IS THE KEY: Set to false to remove the blinking cursor
          cursorChar: '|', // Character for the cursor (not shown if showCursor is false)
          autoInsertCss: true, // Automatically inserts CSS for the cursor
          bindInputFocusEvents: false, // Prevents issues with input fields
        });
    }
});
