<?php
$project = get_project_by_id(get_the_ID());
js_log($project);
?>

<main data-page="project" class="project-page">
  
<div class="hero-left">
        <h1><?= $project['title'] ?></h1>
        <?= !empty($project['description']) ? wpautop($project['description']) : '' ?>
    </div>

        <div class="hero-image">
            <?= !empty($project['image']) ? "<img src='{$project['image']['src']}' alt='{$project['image']['alt']}'>" : '' ?>
        </div>
        
        <div class="meta-data">
            <?= !empty($project['role']) ? "<span class='meta-label'>ROLLE</span><span class='meta-role-value'>{$project['role']}</span>" : '' ?>
            <?= !empty($project['year']) ? "<span class='meta-year'>{$project['year']}</span>" : '' ?>
        </div>

    <div class="media-container">
        <?= !empty($project['video_link']) ? wp_oembed_get($project['video_link']) : '' ?>
        
    <div class="gallery-grid">
    <?php if (!empty($project['gallery'])) foreach ($project['gallery'] as $image_id) : ?>
        <a href="<?= wp_get_attachment_image_url($image_id, 'large') ?>">
            <?= wp_get_attachment_image($image_id, 'large') ?>
        </a>
    <?php endforeach; ?>
    </div>
</div>

    <div class="footer-text">
        <?= !empty($project['text']) ? wpautop($project['text']) : '' ?>
    </div>

</main>
