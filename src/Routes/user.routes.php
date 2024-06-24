<?php

namespace Ml\Routes;
use Ml\Api\Service\User;

$action = $_REQUEST['action'] ?? null;

enum UserAction: string {
    case CREATE = 'create';
    case GET = 'get';
    case REMOVE = 'remove';
    case UPDATE = 'update';
    case GET_ALL = 'get_all';
    
    
    function getResponse(): string {
        //TODO: GET USER DATA From http body
        $user_id = 1;
        $user_data = ['name' => 'test'];
        $user = new User('marko', 'lucic', 24);
        $response = match($this) {
            self::CREATE => $user->create(['name' => 'test']),
            self::GET => $user->get($user_id),
            self::REMOVE => $user->remove($user_id),
            self::UPDATE => $user->update($user_data),
            self::GET_ALL => $user->getAll()
        };
        return json_encode($response);
    }
}


$user_action = UserAction::tryFrom($action);
if($user_action){
    echo $user->actio->getResponse();
} else {
    require '404.routes.php';
}
