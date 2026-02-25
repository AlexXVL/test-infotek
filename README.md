Сборка
```shell
docker compose up --build -d
```

### Данные для создания и заполнения таблицы tbl_user
testdrive/protected/data/schema.mysql.sql

Миграции
```shell
docker exec -it test-infotek-app ./testdrive/protected/yiic migrate
```

Очистка кэша:
```shell
docker exec -it test-infotek-app rm -rf ./testdrive/protected/runtime/*
```


Также приложил примеры моего кода из laravel (мой рабочий фреймворк)
Они находятся в папке /example