<main>
    <div class="conteiner">
        <section class="home">
            <div class="home__form">
                <form method="post" action="/search" class="form" id="form">
                    <h1 class="home__form__title">Поиск</h1>
                    <div class="form_group">
                        <label>
                            <input name="section" checked type="radio" value="full_name">
                            По ФИО
                        </label>
                        <label>
                            <input name="section" type="radio" value="phone">
                            По Телефону
                        </label>
                    </div>
                    <div class="form_group">
                        <input required placeholder="ФИО" class="form_input" type="text" id="search">
                    </div>
                    <div class="form_group">
                        <button class="home__form__button" disabled type="submit">Найти</button>
                    </div>
                </form>
            </div>
            <div class="home__content">
                <div class="info">
                    <p>Введите в поиск</p>
                </div>
                <div class="animate-flicker" style="display: none">Поиск...</div>
                <div class="warning" style="display: none">
                    <p>Не найдено !</p>
                </div>
            </div>
        </section>
    </div>
</main>
<script src="<?php echo public_js_include('home.js'); ?>" type="text/javascript"></script>