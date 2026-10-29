<?php
$menu = get_menu_by_slug('legals');
$logo = get_globals_logo();
$socials = get_globals_socials();

$is_home = is_front_page();
$theme_class = $is_home ? 'theme-dark' : 'theme-white';

?>

<footer data-layout="footer" class="<?= $theme_class ?>">
   <div class="footer-top">
        <!-- Linke Spalte -->
        <div class="footer-column footer-left">
            <div class="footer-info">
                <?php if ($is_home) : ?>
                    <p>DAS IST EINE AUSWAHL MEINER PROJEKTE.<br>MELDE DICH GERNE BEI INTRESSE ODER FRAGEN!</p>
                    <br>
                    <a href="mailto:jessica.haeseli@live.com">jessica.haeseli@live.com</a>
                <?php endif; ?>
            </div>
            <div class="footer-copyright">
                <span>© Jessica Häseli 2026</span>
            </div>
        </div>

        <div class="footer-column footer-center">
            <div class="footer-socials">
            <?php foreach ($socials as $item) : ?>
                        <a target="_blank" href="<?= $item['link'] ?>">
                            <?= $item ['title'] ?>
                        </a>
            <?php endforeach; ?>
            </div>
            
            <nav class="nav-container">
                <ul class="nav"> 
                    <?php foreach ($menu as $item) : ?>
                        <li class="nav-item">
                            <a target="<?= $item['target'] ?>" href="<?= $item['url'] ?>"><?= $item['title'] ?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </nav>
        </div>
    </div>    
    
     <img class="logo" src="<?= $logo['src'] ?>" alt="<?= $logo['alt'] ?>" />
    
</footer>
