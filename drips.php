<?php

use Drips\App;
use Drips\Logger\Logger;
use Drips\Logger\Handler;

if (class_exists('Drips\App')) {
    App::on('create', function (App $app) {
        $app->logger = new Logger;
        $app->logger->pushHandler(new Handler);
    });
}
