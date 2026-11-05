document.addEventListener('DOMContentLoaded', () => {
    const heroModule = document.querySelector('[data-module="hero_front"]');
    if (!heroModule) return;

    const track = heroModule.querySelector('.carousel-3d-track');
    // Wir holen uns gezielt das erste Bild, um seine exakte Höhe (100%) als Massstab zu nehmen
    const firstSlide = heroModule.querySelector('.carousel-3d-slide');
    if (!track || !firstSlide) return;

    let targetSpeed = 1;
    let currentSpeed = 1;
    let scrollTimeout;

    heroModule.addEventListener('wheel', (e) => {
        // 1. Liest die exakte Pixel-Höhe der Bilder aus (in deinem Fall ca. 450px)
        const imageHeight = firstSlide.offsetHeight;
        
        // 2. Da die Bilder per Flexbox zentriert sind, berechnen wir die exakte Ober- und Unterkante
        const windowCenter = window.innerHeight / 2;
        const imageTop = windowCenter - (imageHeight / 2);
        const imageBottom = windowCenter + (imageHeight / 2);

        // 3. Wenn die Maus auch nur 1 Pixel über oder unter den Bildern ist: normal scrollen!
        if (e.clientY < imageTop || e.clientY > imageBottom) {
            return; 
        }

        // Ab hier greift dein Karussell (inklusive den Gaps zwischen den Bildern)
        e.preventDefault(); 
        
        // SPEED-BOOST: Von 0.01 auf 0.04 erhöht, damit es deutlich stärker reagiert
        const speedBoost = e.deltaY * 0.04; 
        targetSpeed += speedBoost; 
        
        // Max-Speed etwas angehoben (12 statt 8), damit du richtig Schwung geben kannst. Minimum bleibt 0.
        targetSpeed = Math.max(0, Math.min(targetSpeed, 12));

        clearTimeout(scrollTimeout);
        scrollTimeout = setTimeout(() => {
            targetSpeed = 1; 
        }, 150);
        
    }, { passive: false });

    function renderLoop() {
        currentSpeed += (targetSpeed - currentSpeed) * 0.05;

        const anims = track.getAnimations();
        if (anims.length > 0) {
            anims[0].playbackRate = currentSpeed;
        }

        requestAnimationFrame(renderLoop);
    }
    renderLoop();
});