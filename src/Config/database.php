<?php

namespace Ml\Api\Config;
use Ml\Api\Config\Enviroment;
use RedBeanPHP\R;

$dsn = sprintf('mysql:host=%s;dbname=%s', $_ENV['DB_HOST'], $_ENV['DB_NAME']);
R::setup( $dsn, $_ENV['DB_USER'], $_ENV['DB_PASSWORD'] );

$currentEnv = Enviroment::tryFrom($_ENV['APP_ENV']);
if( $currentEnv?->envName() !== Enviroment::DEVELOPMENT->value) {
    R::freeze( TRUE );
}