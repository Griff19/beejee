Тестовое задание BeeJee
================
Необходимо создать приложение-задачник. Фреймворки PHP использовать нельзя, библиотеки можно. Сложная архитектура не нужна.
В приложении нужно с помощью чистого PHP реализовать модель MVC. Решите поставленные задачи минимально необходимым количеством кода.
Верстка на bootstrap, к дизайну особых требований нет.

Требования к проекту:
--------------------
Требования к коду: https://beejee.ru/coding-challenge-requirements

Задачи состоят из:
- имени пользователя;
- е-mail;
- текста задачи;

Стартовая страница - список задач с возможностью сортировки по имени пользователя, email и статусу.
- Вывод задач нужно сделать страницами по 3 штуки (с пагинацией).
- Видеть список задач и создавать новые может любой посетитель без авторизации.

Сделайте вход для администратора (логин "admin", пароль "123").
- Администратор имеет возможность редактировать текст задачи и поставить галочку о выполнении.
- Выполненные задачи в общем списке выводятся с соответствующей отметкой.

Структура каталогов
-------------------

```
app/            корневой каталог
- config/       файлы настройки
- - common/     вспомогательные файлы
- controllers/  классы контроллеров
- img/          изображения
- js/           скрипты javascript
- models/       классы моделей 
- template/     шаблоны сайта
- - beejee      новый шаблон
- - default/    шаблон по умолчанию
- views/        файлы представлений
- - site/       представления сайта
- - user/       представления "Пользователя"
vendor/
- griff/        классы "движка"
```

## Конфигурация

В каталоге config/ s файл local.php укажите настройки подключения к Вашей БД.
Вы можете так же указать имя директории, если приложение будет выолняться не в корне.
 
Содержание файла local.php:

```
return [
    'db' => [
        'host' => '127.0.0.1',
        'user' => 'root',
        'pass' => '',
        'base' => 'test',
    ],
    'root' => '/test'    
];
```

Инициализация
-------------
Перед началом работы необходимо запустить скрипт для создания таблиц в БД и прочих 
подготовительных операций: 

    php init.php  
      
Так же в процессе инициализации будет создан файл local.php (если до этого не был создан вручную) 
с исходными настройками (см. раздел ["Конфигурация"](#Конфигурация)). После этого нужно будет запустить файл init.php
еще раз. 

Начальная страница находится по адресу: 

    http://localhost{{/root}}/site/index 

где {{/root}} - корневой каталог
