# Logger

[![Build Status](https://travis-ci.org/Prowect/Logger.svg)](https://travis-ci.org/Prowect/Logger)
[![Code Climate](https://codeclimate.com/github/Prowect/Logger/badges/gpa.svg)](https://codeclimate.com/github/Prowect/Logger)
[![Test Coverage](https://codeclimate.com/github/Prowect/Logger/badges/coverage.svg)](https://codeclimate.com/github/Prowect/Logger/coverage)
[![Latest Release](https://img.shields.io/packagist/v/drips/Logger.svg)](https://packagist.org/packages/drips/logger)

## Beschreibung

Loggingsystem für Drips basierend auf [Monolog](https://github.com/Seldaek/monolog).

## Logging

Als erstes muss ein `Logger`-Objekt erzeugt werden, auf dem anschließend die verschiedenen Handler gepusht werden können.

### Beispiel

```php
<?php

use Drips\Logger\Logger;
use Monolog\Handler\StreamHandler;

$logger = new Logger('myLogger');
$logger->pushHandler(new StreamHandler('path/to/your.log', Logger::WARNING)); // StreamHandler => schreibt in eine Datei

// Logeinträge hinzufügen
$logger->warning('Warning');
$logger->error('Error');
```

## Logging in der Debugbar

Damit die Log-Einträge in der [Debugbar](https://github.com/Prowect/Debugbar) angezeigt werden, muss der entsprechende Handler im Logger registriert werden:

```php
<?php

use Drips\Logger\Logger;
use Drips\Logger\Handler;

// Neuen Logger anlegen
$logger = new Logger('myLogger');

// DebugbarHandler registrieren
$logger->pushHandler(new Handler);
```

Genauere Informationen befinden sich im [Monolog-Wiki](https://github.com/Seldaek/monolog).