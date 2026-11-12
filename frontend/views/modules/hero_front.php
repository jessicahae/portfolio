<?php
$data = $args['data'];
js_log($data);
?>

<section data-module="hero_front">

    <img class="logo_big" src="<?= $data['logo']['src'] ?>" alt="<?= $data['logo']['alt'] ?>">

   <?php
    $original_slides = $data['hero_carousel'] ?? [];
    $slides = $original_slides;
    
    if (count($slides) > 0) {
        while (count($slides) < 14) {
            $slides = array_merge($slides, $original_slides);
        }
    }
    
    $total_slides = count($slides);
    ?>

    <?php if ($total_slides > 0) : ?>
        <div class="scene-3d">
            <div class="carousel-3d-track">
                
                <?php foreach ($slides as $slide) : ?>
                    <?php if (!empty($slide['carousel_image']['src'])) : ?>
                        
                        <?php
                        $link_url = '#';
                        if (!empty($slide['project_link'])) {
                            $link_url = get_permalink($slide['project_link'][0]['id']);
                        }
                        ?>
                        
                        <a href="<?= $link_url ?>" class="carousel-3d-slide">
                            <img src="<?= $slide['carousel_image']['src'] ?>" alt="<?= $slide['carousel_image']['alt'] ?>">
                        </a>
                    
                    <?php endif; ?>
                <?php endforeach; ?>
            
            </div>
        </div>
    <?php endif; ?>
</section>
