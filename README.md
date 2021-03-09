## Руководство по установке веб приложения "Conference"

1. Програмное обеспечение:
    - PHP
    - MySQL
    - Composer
    - Nodejs
    - npm
2. Установка:
    1. Создаем базу данных в MySQL. Заходим в консоль MySQl -  create database Users_db.
    2. Устанавливаем все зависимости npm install && composer install
    3. Создаем файл в проекте .env по примеру .env.example. Настраиваем подключение к БД MySQL
    4. Делаем миграции всех таблиц php artisan migrate
    5. Создаем роль админа php artisan permission:create-role admin
    6. Включаем сиды для заполнения таблицы countries и создания аккаунта админа php artisan db:seed, php artisan db:seed --class=CountrySeeder

       | Admin login  | Admin password |
       | ------------- | ------------- |
       | admin@gmail.com | admin  |
    
    7. Включаем ссылку для хранилища фотографий php artisan storage:link
    8. Устанавливаем ключ шифрования сессий и кук php artisan key:generate
    
    ###Endpoints

   | point  | value |
          | ------------- | ------------- |
   | / | home  |
   | /api/admin_panel | admin panel  |
   | /all_members | All Members page  |
    ****
   Всё готово.
    
