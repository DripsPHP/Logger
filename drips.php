<?php

use Drips\App;
use Drips\Logger\Logger;
use Drips\Logger\Handler;
use Monolog\Handler\StreamHandler;

if (class_exists('Drips\App')) {
    App::on('create', function (App $app) {
        $app->logger = new Logger('dripslogger');
        $app->logger->pushHandler(new StreamHandler(DRIPS_LOGS.'/drips.log'));
        $app->logger->pushHandler(new Handler);
    });
}
