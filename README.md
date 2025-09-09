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


## Funkcionality aplikace

Webová aplikace pro čtenářský deník umožňuje registrovaným uživatelům spravovat svůj seznam knih a záznamy o čtení. Klíčové funkce zahrnují:
- Registrace nového uživatele
- Přihlášení a odhlášení
- Zobrazení měsíčního a týdenního reportu
- Zobrazení všech přidaných knih a přidání nové knihy do seznamu
- Zobrazení záznamů o přečtených knihách a přidání nového záznamu o čtení
- Zobrazení přehledu o čtenářských aktivitách
- Úprava údajů o uživateli
- Možnost smazání všech osobních dat a uživatelského účtu


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
    - pokud `php artisan serve` selže, alternativou je `php -S 127.0.0.1:8000 -t public`