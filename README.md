<div align="center">
    <h1>PHP DotEnv Parser</h1>
    <p>Lightweight parser for `.env` files for PHP.</p>
    <hr>
</div>

## Features
* Parse `.env` files and access them with `$_ENV`.

## Installation & Usage
### Composer installation: 
`composer req "noelclick/php-dotenv"`
### Load the environment variables 
```php
// Composer autoloader
require "./vendor/autoload.php"; 

// Load environment variables
    (new \NoelClick\PhpDotEnv\DotEnv(__DIR__ . '/../.env'))
        ->load();
    echo $_ENV["APP_NAME"];
```

## Changelog
All notable changes to this project will be documented in the [CHANGELOG.md](CHANGELOG.md) file.

## Copyright
&copy; Copyright 2022 by Noel Kayabasli