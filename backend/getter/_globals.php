<?php

function get_globals_logo() {
    $logo_id = carbon_get_theme_option('logo');
    $logo = get_media_by_id ($logo_id);
    return $logo;
}
 