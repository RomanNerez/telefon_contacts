<header class="header">
    <div>
        <h1>Телефоный справочник</h1>
    </div>
    <nav>
        <a class="<?php echo Route::getCurrentUrl() !== '/' ?: 'active' ?>" href="/">Главная</a>
        <a class="<?php echo Route::getCurrentUrl() !== '/phone/create' ?: 'active' ?>" href="/phone/create">Создать телефон</a>
        <a class="<?php echo Route::getCurrentUrl() !== '/phone/list' ?: 'active' ?>" href="/phone/list">Весь список</a>
    </nav>
</header>