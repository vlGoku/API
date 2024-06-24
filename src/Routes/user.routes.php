<?php

namespace Ml\Routes;

echo 'Hello from user.routes';

$action = $_REQUEST['action'] ?? null;

enum UserAction {
    case CREATE = 'create';
    case GET = 'get';
    case REMOVE = 'remove';
    case UPDATE = 'update';
    case GET_ALL = 'get_all';
}