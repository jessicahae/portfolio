<?php
use Carbon_Fields\Container;
   use Carbon_Fields\Field;
   Container::make('post_meta', 'Projekt')
       ->where('post_type', '=', 'project')
       ->add_fields([
           Field::make('image', 'image', 'Bild') ->set_required(true),
           Field::make('textarea', 'description', 'Beschreibung') ->set_required(true),
           Field::make('text', 'role', 'Rolle') ->set_required(true),
           Field::make('text', 'year', 'Produktionsjahr') ->set_required(true),
           Field::make('rich_text', 'text', 'Text'),
           Field::make('media_gallery', 'project_gallery', 'Bildergallerie') ->set_required(true),
           Field::make('oembed', 'video_link', 'Video-Link'),
       ]);