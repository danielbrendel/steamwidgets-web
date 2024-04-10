<h1 align="center">
    <img src="public/img/logo.png" width="100"/><br/>
    SteamWidgets
</h1>

<p align="center">
    Embed various Steam widgets in your web document<br/>
    (C) 2022 - 2024 by Daniel Brendel<br/>
    Released under the MIT license
</p>

<p align="center">
    <img src="https://img.shields.io/badge/web-php-orange" alt="web-php"/>
    <img src="https://img.shields.io/badge/db-mysql-pink" alt="db-mysql"/>
    <img src="https://img.shields.io/badge/license-MIT-blue" alt="license-mit"/>
    <img src="https://img.shields.io/badge/maintained-yes-green" alt="maintained-yes"/>
</p>

## Information

__Contact__: dbrendel1988(at)gmail(dot)com\
__GitHub__: https://github.com/danielbrendel

## Description
This is the web backend as well as the documentation and resource provider for SteamWidgets.
SteamWidgets offers the possibility to comfortably render Steam related widgets into your web
document with as little effort as possible. 

## Current featured widgets
- Steam App Widget: Renders widgets of Steam apps/games
- Steam Server Widget: Renders widgets of Steam game servers
- Steam User Widget: Renders widgets of Steam users
- Steam Workshop Widget: Renders widgets of Steam workshop items
- Steam Group Widget: Renders widgets of Steam groups 

## Running the project

1. Clone the repository

2. Install the dependencies
```sh
composer install
```

3. Create your `.env` file
```sh
copy .env.example .env
```

4. Adjust some environment settings
```sh
# Example widget item values
APP_EXAMPLE_APP=""
APP_EXAMPLE_SERVER=""
APP_EXAMPLE_USER=""
APP_EXAMPLE_WORKSHOP=""
APP_EXAMPLE_GROUP=""

# Steam API key
STEAM_API_KEY="your-key-here"

# Database settings
DB_ENABLE=true
DB_HOST=localhost
DB_USER=root
DB_PASSWORD=""
DB_PORT=3306
DB_DATABASE=steamwidgets
DB_DRIVER=mysql
DB_CHARSET="utf8mb4"

# Caching
CACHE_DRIVER=db
CACHE_DURATION=123
```

5. Run your MySQL server and perform database table migrations
```sh
php asatru migrate:fresh
```

6. Now launch your local development server
```
php asatru serve
```
The application is now available on http://localhost:8000/.

## Documentation

The documenation of the underlying framework is located inside the `/doc` directory.