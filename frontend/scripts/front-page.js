document.addEventListener('DOMContentLoaded', () => {
    const heroModule = document.querySelector('[data-module="hero_front"]');
    if (!heroModule) return;

    const track = heroModule.querySelector('.carousel-3d-track');
    const slides = heroModule.querySelectorAll('.carousel-3d-slide');
    if (!track || slides.length === 0) return;

    const state = { angleOffset: 0 };
    // Das ist der feste Schrittwinkel pro Bild auf dem Förderband
    const angleStep = (Math.PI * 2) / slides.length;

    function updatePositions() {
        
        const radius = 2500;

        slides.forEach((slide, i) => {
            
            const currentAngle = (i * angleStep) - state.angleOffset;

            const x = Math.sin(currentAngle) * radius;
            const z = -Math.cos(currentAngle) * radius;

            const rotationY = -currentAngle * (180 / Math.PI);

            slide.style.transform = `translateX(${x}px) translateZ(${z}px) rotateY(${rotationY}deg)`;
        });
    }

    updatePositions();

    // Die Richtung ändern: Wir lassen angleOffset in die andere Richtung laufen (positiver Wert)
    const spinAnim = gsap.to(state, {
        angleOffset: Math.PI * 2,
        duration: 70,
        ease: "none",
        repeat: -1,
        onUpdate: updatePositions
    });

    let scrollTimeout;

    heroModule.addEventListener('wheel', (e) => {
        const imageHeight = firstSlide.offsetHeight;
        const windowCenter = window.innerHeight / 2;
        const imageTop = windowCenter - (imageHeight / 2);
        const imageBottom = windowCenter + (imageHeight / 2);

        if (e.clientY < imageTop || e.clientY > imageBottom) {
            return;
        }

        e.preventDefault();

        const boost = e.deltaY * 5;
        let currentScale = spinAnim.timeScale();
        let newScale = currentScale + boost;

        newScale = Math.max(0, Math.min(newScale, 15));

        gsap.to(spinAnim, {
            timeScale: newScale,
            duration: 0.1,
            overwrite: true
        });

        clearTimeout(scrollTimeout);
        scrollTimeout = setTimeout(() => {
            gsap.to(spinAnim, {
                timeScale: 1,
                duration: 1
            });
        }, 100);

    }, { passive: false });
});