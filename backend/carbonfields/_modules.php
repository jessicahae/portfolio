<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

// -> Konfiguration der verschiedenen Module
Container::make('post_meta', 'Module')
    ->where('post_type', '=', 'page')
    ->add_fields([
        Field::make('complex', 'modules', 'Module')
            // -> example
            ->add_fields('example', 'Beispiel', [
                Field::make('text', 'title', 'Titel')->set_required(),
                Field::make('image', 'image', 'Bild')->set_required(),
            ])
            // hero_front
            ->add_fields('hero_front', 'Hero Startseite', [
                Field::make('image', 'background_image', 'Hintergrundbild')->set_required(),
                Field::make('complex', 'hero_carousel', 'Carousel Bilder')
                    ->add_fields([
                        Field::make('image', 'carousel_image', 'Bild')->set_required(),
                    ])
                    ->set_layout('tabbed-horizontal'),
                Field::make('image', 'logo', 'Logo')->set_required(),
            ])

            // todo: add new modules here
            // -> SETTINGS
            ->set_layout('tabbed-vertical')
    ]);

// -> Funktion, um die Module und die entsprechenden Templates auf der Seite zu laden
function render_modules (): void {
    $modules = carbon_get_the_post_meta('modules');
    if (empty($modules)) {
        return;
    }
    foreach ($modules as $module) {
        // -> Modifiziere die Daten des Moduls, falls nötig, basierend auf dem Modultyp
        switch ($module['_type']) {
            case 'example':
                $module['image'] = get_media_by_id($module['image']);
                break;
            case 'hero_front':
                $module['background_image'] = get_media_by_id($module['background_image']);
                $module['logo'] = get_media_by_id($module['logo']);

                foreach ($module['hero_carousel'] as $key => $slide) {
                $module['hero_carousel'][$key]['carousel_image'] = get_media_by_id($slide['carousel_image']);
            }
                break;      
        }
        // -> Laden des Templates basierend auf dem Modultyp und weitergeben der Daten
        get_template_part(
            'frontend/views/modules/' . $module['_type'],
            null,
            [
                'data' => $module
            ]
        );
    }
}
