jQuery(document).ready(function($) {
    $('.gallery-grid').justifiedGallery({
        rowHeight: 450,    
        margins: 20,         
        border: 0,
        lastRow: 'justify',  
        captions: false    
    });
});

jQuery(document).ready(function($) {
    let $links = $('.gallery-grid a');
    if (!$links.length) return; // Bricht ab, falls keine Bilder da sind

    let i = 0; // Speichert das aktuelle Bild

    // 1. Lightbox-HTML ans Ende des <body> hängen
    $('body').append(`
        <div id="custom-lightbox">
            <button class="lightbox-btn lightbox-close">&times;</button>
            <button class="lightbox-btn lightbox-prev">&#10094;</button>
            <img src="" alt="">
            <button class="lightbox-btn lightbox-next">&#10095;</button>
        </div>
    `);

    let $lb = $('#custom-lightbox');
    let $img = $lb.find('img');

    // 2. Kurz-Funktionen für Auf, Zu und Wechseln
    let open = (index) => { i = index; $img.attr('src', $links.eq(i).attr('href')); $lb.addClass('active'); };
    let close = () => $lb.removeClass('active');
    let move = (step) => open((i + step + $links.length) % $links.length);

    // 3. Klick auf ein Bild in der Galerie
    $links.on('click', function(e) {
        e.preventDefault(); 
        open($links.index(this));
    });

    // 4. Klicks innerhalb der Lightbox (Buttons & dunkler Hintergrund)
    $lb.on('click', function(e) {
        if ($(e.target).hasClass('lightbox-close') || e.target === this) close();
        if ($(e.target).hasClass('lightbox-next')) move(1);
        if ($(e.target).hasClass('lightbox-prev')) move(-1);
    });

    // 5. Tastatur-Steuerung (Pfeiltasten & Esc)
    $(document).on('keydown', function(e) {
        if (!$lb.hasClass('active')) return;
        if (e.key === 'Escape') close();
        if (e.key === 'ArrowRight') move(1);
        if (e.key === 'ArrowLeft') move(-1);
    });
});


