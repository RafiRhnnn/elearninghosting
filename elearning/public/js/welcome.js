// Initialize AOS when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    // Initialize AOS
    AOS.init({
        duration: 1000,
        once: true,
        offset: 100
    });

    // Initialize all other functions
    initSmoothScroll();
    initCounters();
    initScrollEffects();
    initTypingEffect();
});

// Smooth scroll for anchor links
function initSmoothScroll() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    });
}

// Counter animation
function animateCounter(element) {
    const target = parseInt(element.getAttribute('data-target'));
    const increment = target / 100;
    let current = 0;

    const timer = setInterval(() => {
        current += increment;
        element.textContent = Math.floor(current);

        if (current >= target) {
            element.textContent = target;
            clearInterval(timer);
        }
    }, 20);
}

// Initialize counters with Intersection Observer
function initCounters() {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const counter = entry.target.querySelector('.counter');
                if (counter && !counter.classList.contains('animated')) {
                    counter.classList.add('animated');
                    animateCounter(counter);
                }
            }
        });
    });

    // Observe counter elements
    document.querySelectorAll('.statistics-counter').forEach(el => {
        observer.observe(el);
    });
}

// Scroll effects
function initScrollEffects() {
    // Parallax effect for navbar
    window.addEventListener('scroll', () => {
        const scrolled = window.pageYOffset;
        const navbar = document.querySelector('nav');

        if (navbar) {
            if (scrolled > 100) {
                navbar.classList.add('bg-opacity-95');
            } else {
                navbar.classList.remove('bg-opacity-95');
            }
        }
    });

    // Add entrance animations on scroll
    window.addEventListener('scroll', () => {
        const elements = document.querySelectorAll('.fade-in-up, .slide-in-left, .slide-in-right');
        elements.forEach(element => {
            const elementTop = element.getBoundingClientRect().top;
            const elementVisible = 150;

            if (elementTop < window.innerHeight - elementVisible) {
                element.classList.add('animate');
            }
        });
    });
}

// Typing effect functionality
function initTypingEffect() {
    const typingElement = document.querySelector('.typing-effect');
    
    if (!typingElement) return;

    const restartTyping = () => {
        typingElement.style.animation = 'none';
        setTimeout(() => {
            typingElement.style.animation = 'typing 4s steps(40, end), blink-caret 0.75s step-end infinite';
        }, 100);
    };

    // Restart typing animation when element comes into view
    const typingObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                restartTyping();
            }
        });
    });

    typingObserver.observe(typingElement);
}

// Utility function for debouncing scroll events
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Export functions if needed (for ES6 modules)
if (typeof module !== 'undefined' && module.exports) {
    module.exports = {
        initSmoothScroll,
        initCounters,
        initScrollEffects,
        initTypingEffect
    };
}
