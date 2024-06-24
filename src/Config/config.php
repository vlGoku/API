<?php

namespace Ml\Api\Config;

use Whoops\Run as WhoopsRun;
use Whoops\Handler\JsonResponseHandler as WhoopsJsonResponseHandler;

$whoops = new WhoopsRun();
$whoops->pushHandler(new WhoopsJsonResponseHandler());
$whoops->register();