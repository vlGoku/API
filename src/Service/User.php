<?php

namespace Ml\Api\Service;
use Ml\Api\Validation\CustomValidation;
use Ml\Api\Validation\Exception\ValidationException;

class User {
    public function __construct(){

    }

    public function create(mixed $data): array|object {
        $validate = new CustomValidation($data);
        if($validate->validate_create()){
            return ['data' => 'passed validation'];
        }
        throw new ValidationException('Validation failed');
    }

    public function get(string $user_id): array|object {
        $validation = new CustomValidation($user_id);
        if($validation->validateUuid()){
            return ['data' => 'passed validation'];
        } else {
            throw new ValidationException('Validation failed, uuid not valid');
        }
    }

    public function getAll(): array|object {
        return  ['message' => 'hello from getAll'];
    }

    public function update(mixed $user): array|object {
        $validation = new CustomValidation($user);
        if($validation->validate_update()){
            return ['data'=> 'passed validation'];
        } else {
            throw new ValidationException('Validation failed, wrong input data');
        }
    }

    public function remove(string $user_id): array {
        $vaildation = new CustomValidation($user_id);
        if($vaildation->validateUuid()){
            return ['valid'];
        }
        throw new ValidationException('Validation failed, uuid no valid');
    }
}