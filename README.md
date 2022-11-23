# Laracasts - Inertia.js

Приложение c CRUD-функционалом, демонстрирующее работу [Intertia.js](https://inertiajs.com).

### Установка

Для запуска приложения требуется **Docker** и **Docker Compose**.

Для инициализации приложения выполнить команду:
```
make init
```

### Запуск

```
make up
```

Приложение доступно по адресу - http://localhost:8080

Остановка приложения:

```
make down
```

### Тесты

```
make backend-test
```

Запуск со статистикой "покрытия":

```
make backend-test-coverage
```

Результаты "покрытия" формируются в:

```
tests/Coverage/index.html
```

### Цель проекта

Код написан в образовательных целях на базе уроков [Laracasts](https://laracasts.com). 
