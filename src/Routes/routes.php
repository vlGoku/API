<?php

namespace Ml\Routes;
use Ml\Api\Validation\Exception\ValidationException;

use function Ml\Api\Helper\response;

$resource = $_REQUEST['resource'] ?? null;
try {
    return match($resource) {
        'user' => require 'user.routes.php',
        default => require '404.routes.php'
    };
} catch (ValidationException $e) {
    response([
        'error'=> [
            'message' => $e->getMessage(),
            'code' => $e->getCode(),
        ]
        ]);
}
