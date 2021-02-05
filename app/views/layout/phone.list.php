<main>
    <div class="conteiner">
        <section class="home">
            <div class="home__content">
                <?php if(!$count):?>
                    <div class="info">
                        <p>Список пуст!</p>
                    </div>
                <?php endif?>
                <?php foreach ($lists as $list): ?>
                <div class="item__phone">
                    <div class="item__phone_left">
                        <small>ФИО</small>
                        <span><?php echo $list['full_name']?></span>
                    </div>
                    <div class="item__phone_right">
                        <small>Телефон</small>
                        <span><?php echo $list['phone']?></span>
                    </div>
                    <div class="item__phone_options">
                        <a href="/phone/edit/<?php echo $list['id']?>">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="/phone/delete/<?php echo $list['id']?>">
                            <i class="fas fa-trash"></i>
                        </a>
                    </div>
                </div>
                <?php endforeach;?>
            </div>
        </section>
    </div>
</main>