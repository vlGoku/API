<?php

namespace Ml\Routes;
use Ml\Api\Validation\Exception\ValidationException;
use Ml\Api\Routes\Exception\NotAllowedException;
use PH7\JustHttp\StatusCode;

use function Ml\Api\Helper\response;

$resource = $_REQUEST['resource'] ?? null;
try {
    return match($resource) {
        'user' => require 'user.routes.php',
        default => require '404.routes.php'
    };
} catch (ValidationException $e) {
    \PH7\PhpHttpResponseHeader\Http::setHeadersByCode(StatusCode::BAD_REQUEST);
    response(data: [
        'errors'=> [
            'message' => $e->getMessage(),
            'code' => $e->getCode(),
        ]
        ]);
} catch (NotAllowedException $e) {
    response( data: [
        'errors' => [
            'message' => $e->getMessage(),
            'code'=> $e->getCode(),
        ]
    ]);
}
