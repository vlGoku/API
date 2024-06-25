<?php

namespace Ml\Api\Config;

use Whoops\Run as WhoopsRun;
use Whoops\Handler\JsonResponseHandler as WhoopsJsonResponseHandler;
use Dotenv\Dotenv;

enum Enviroment: string {
    case DEVELOPMENT = "development";
    case PRODUCTION = "production";

    public function envName(): string {
        return match ($this) {
            self::DEVELOPMENT => "development",
            self::PRODUCTION => "production",
        };
    }
}

$whoops = new WhoopsRun();
$whoops->pushHandler(new WhoopsJsonResponseHandler());
$whoops->register();

$dotenv = Dotenv::createImmutable(dirname(__DIR__, 2));
$dotenv->load();

$dotenv->required(["DB_HOST", "DB_NAME", "DB_USER", "DB_PASSWORD"]);