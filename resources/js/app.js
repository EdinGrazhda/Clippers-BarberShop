// Mobile menu toggle
const mobileBtn = document.getElementById("mobileMenuBtn");
const mobileMenu = document.getElementById("mobileMenu");
if (mobileBtn && mobileMenu) {
    mobileBtn.addEventListener("click", () => {
        mobileMenu.classList.toggle("hidden");
    });
}

// Hero slideshow
function initHeroSlideshow() {
    const slides = document.querySelectorAll(".hero-slide");
    if (slides.length === 0) return;

    let currentSlide = 0;

    function showSlide(index) {
        slides.forEach((slide, i) => {
            slide.classList.toggle("active", i === index);
        });
    }

    function nextSlide() {
        currentSlide = (currentSlide + 1) % slides.length;
        showSlide(currentSlide);
    }

    // Initialize first slide
    showSlide(0);

    // Auto-advance slides
    setInterval(nextSlide, 5000);
}

// Initialize slideshow when DOM is loaded
document.addEventListener("DOMContentLoaded", initHeroSlideshow);

// Subtle reveal animations on scroll
const els = document.querySelectorAll("[data-animate]");
const observer = new IntersectionObserver(
    (entries) => {
        entries.forEach((e) => {
            if (e.isIntersecting) {
                e.target.classList.add("animate-in");
                observer.unobserve(e.target);
            }
        });
    },
    { threshold: 0.15 }
);

els.forEach((el) => {
    el.classList.add("opacity-0", "translate-y-4");
    observer.observe(el);
});

// Smooth scrolling for anchor links
document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener("click", function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute("href"));
        if (target) {
            target.scrollIntoView({
                behavior: "smooth",
                block: "start",
            });
        }
    });
});
