<?php
    // маршруты (можно хранить в конфиге приложения)
    // можно использовать wildcards (подстановки):
    // :any - любое цифробуквенное сочетание
    // :num - только цифры
    // в результирующее выражение записываются как $1, $2 и т.д. по порядку

    $routes = array(
        '/' => 'IndexController/index',
        '/phone/create' => 'PhoneController/create',
        '/phone/edit/:num' => 'PhoneController/edit',
        '/phone/delete' => 'PhoneController/deleteAjax',
        '/phone/delete/:num' => 'PhoneController/delete',
        '/phone/list' => 'PhoneController/list',
        '/search' => 'PhoneController/search',
        '/404' => 'NotPageController/index'
    );

    Route::addRoute($routes);
    Route::dispatch();
