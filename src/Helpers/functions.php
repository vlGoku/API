<?php

namespace Ml\Api\Helper;

/**
 * Returns Data in JSON format
 * @param mixed $data
 * 
 * @return void
 */
function response(mixed $data): void {
    echo json_encode($data);
}