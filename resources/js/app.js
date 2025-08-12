// Mobile menu toggle
const mobileBtn = document.getElementById("mobileMenuBtn");
const mobileMenu = document.getElementById("mobileMenu");
if (mobileBtn && mobileMenu) {
    mobileBtn.addEventListener("click", () => {
        mobileMenu.classList.toggle("hidden");
    });
}

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
