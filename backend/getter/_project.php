<?php

function get_project_by_id(int $id): array {

    $title = get_the_title($id);
    $image_id = carbon_get_post_meta($id, 'image');
    $image = get_media_by_id($image_id);
    $description = carbon_get_post_meta($id, 'description');
    $role = carbon_get_post_meta($id, 'role');
    $year = carbon_get_post_meta($id, 'year');
    $text = carbon_get_post_meta($id, 'text');
    $gallery = carbon_get_post_meta($id, 'project_gallery');

    // load project_category
    $project_categories = array_map(function ($item) {
        return $item->name;
    }, get_the_terms($id, 'project_category'));
    js_log($project_categories);

    return [
        'title' => $title,
        'image' => $image,
        'description' => $description,
        'role' => $role,
        'year' => $year,
        'text' => $text,
        'gallery' => $gallery,
        'project_categories' => $project_categories
    ];
}

