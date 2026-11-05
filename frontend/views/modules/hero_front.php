<?php
$data = $args['data'];
js_log($data);
?>

<section data-module="hero_front">
    <?php if ($data['background_image']): ?>
        <img class="background_image" src="<?= $data['background_image']['src'] ?>" alt="<?= $data['background_image']['alt'] ?>">
    <?php endif; ?>

    <img class="logo_big" src="<?= $data['logo']['src'] ?>" alt="<?= $data['logo']['alt'] ?>">

    <!-- Mathematik für 3D Formel -->

    <?php
    $original_slides = $data['hero_carousel'] ?? [];
    $slides = $original_slides;
    
    if (count($slides) > 0) {
        while (count($slides) < 14) {
            $slides = array_merge($slides, $original_slides);
        }
    }
    
    $total_slides = count($slides);
    $angle_step = $total_slides > 0 ? 360 / $total_slides : 0;
    
    $segment_width = 350 + 175; 
    $radius = $total_slides > 0 ? round(($segment_width / 2) / tan(pi() / $total_slides)) : 1000;
    ?>

    <?php if ($total_slides > 0) : ?>
        
        <div class="scene-3d" style="--radius: <?= $radius ?>px;">
            <div class="carousel-3d-track">
                
                <?php foreach ($slides as $index => $slide) : ?>
                    <?php if (!empty($slide['carousel_image']['src'])) : ?>
                        
                        <?php
                        $link_url = '#';
                        if (!empty($slide['project_link'])) {
                            $link_url = get_permalink($slide['project_link'][0]['id']);
                        }
                        $current_angle = $index * $angle_step;
                        ?>
                        
                        <a href="<?= $link_url ?>" 
                           class="carousel-3d-slide" 
                           style="transform: rotateY(<?= $current_angle ?>deg) translateZ(calc(var(--radius) * -1));">
                           
                            <img src="<?= $slide['carousel_image']['src'] ?>" alt="<?= $slide['carousel_image']['alt'] ?>">
                            
                        </a>
                        
                    <?php endif; ?>
                <?php endforeach; ?>
                
            </div>
        </div>
        
    <?php endif; ?>
</section>
