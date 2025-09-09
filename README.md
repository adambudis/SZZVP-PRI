# SZZVP - Vývoj webové aplikace

- Zadání úlohy – Vývoj webové aplikace pro čtenářský deník


## Použité technologie 

1. Backend 
    - PHP 8.3.10
    - Laravel 12
2. Databáze
    - SQLite
3. UI
    - Bootstrap 5


## Souborová struktura

- důležité soubory 

```
SZZVP-PRI/
├─ app/                ← aplikační logika (modely, controllery)
│  ├─ Http/            ← controllery
│  └─ Models/          ← db modely
|
├─ config/
│
├─ database/           ← práce s databází
│  └─ migrations/      ← migrace (struktura tabulek)
│
├─ public/
│
├─ resources/          ← zdrojové soubory
│  └─ views/           ← Blade šablony
│
├─ routes/             ← definice rout
│  └─ web.php          ← web routy
|
├─ screenshots/        ← sreenshoty z aplikace
|
├─ .env.example        ← konfigurace prostředí
└─ README.md
```

## Návod ke spuštění

1. Nainstalovat závislosti
    - PHP balíčky (Composer): `composer install`
2. Zkopírovat ukázkový `.env` soubor
    - `cp .env.example .env`
3. Vygenerovat klíč aplikace
    - `php artisan key:generate`
4. Provést migrace
    - `php artisan migrate`
5. Spustit vývojový server
    - `php artisan serve` 
    - projekt běží na http://127.0.0.1:8000
    - alternativa - `php -S 127.0.0.1:8000 -t public`