# telefon_contacts

1) Перед установкой нужна создать базу данных MySQL

2) Зайти в папку config и открыть файл app.php и указать данные для конекшена к базе

3) Разместить на домене так как настроен файл .htaccess

4) создать таблицу 
BEGIN;
CREATE TABLE `contacts` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
COMMIT;
