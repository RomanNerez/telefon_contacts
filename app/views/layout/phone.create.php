<main>
    <div class="conteiner">
        <section class="create-edit">
            <?php if(isset($message['success'])): ?>
                <p class="success">Контакт создан успешно</p>
            <?php endif ?>
            <div class="create-edit__content">
                <form method="post" action="<?php echo Route::getCurrentUrl()?>" class="form" id="form">
                    <h1 class="home__form__title"><?php echo Route::getCurrentUrl() == '/phone/create' ? 'Новый контакт' : 'Редактировать контакт'?></h1>
                    <div class="form_group">
                        <input name="full_name"
                               value="<?php echo $data[0]['full_name'] ?? ''?>"
                               required
                               placeholder="ФИО"
                               class="form_input" type="text"
                               id="search">
                    </div>
                    <div class="form_group">
                        <input name="phone"
                               value="<?php echo $data[0]['phone'] ?? ''?>"
                               required
                               placeholder="Телефон"
                               class="form_input"
                               type="number"
                               id="search">
                    </div>
                    <div class="form_group">
                        <button class="home__form__button" type="submit"><?php echo Route::getCurrentUrl() == '/phone/create' ? 'Создать' : 'Редактировать'?></button>
                    </div>
                </form>
            </div>
        </section>
    </div>
</main>