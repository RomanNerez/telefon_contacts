<?php

function dump ($value, bool $more_info = false): void {
    if ($more_info) {
        var_dump($value);
        die();
    }
    echo '<pre>';
    print_r($value);
    echo '</pre>';
    die;
}

function public_css_include(string $file): string{
    return HOST.'/public/css/'.$file;
}

function public_js_include(string $file): string{
    return HOST.'/public/js/'.$file;
}

function public_image_include(string $file): string{
    return HOST.'/public/images/'.$file;
}