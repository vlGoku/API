<?php

namespace Ml\Api\Service;
use Ml\Api\Validation\CustomValidation;

class User {
    private string $firstname;
    private string $lastname;
    private int $age;
    public function __construct(string $first, string $last, int $age){
        $this->firstname = $first;
        $this->lastname = $last;
        $this->age = $age;
    }

    public function create(mixed $data): array|object {
        $validate = new CustomValidation($data);
        if($validate->validate_create()){
            return ['data' => 'passed validation'];
        }
        return ['data' => 'error, validation not passed'];
    }

    public function get(string $user_id): array|object {
        $validation = new CustomValidation($user_id);
        if($validation->validateUuid()){
            return ['data' => 'passed validation'];
        } else {
            return ['data'=> 'failed validation'];
        }
    }

    public function getAll(): array|object {
        return  ['message' => 'hello from getAll'];
    }

    public function update(mixed $data): array|object {
        return  ['message' => 'hello from update'];
    }

    public function remove(mixed $data): array|object {
        return  ['message' => 'hello from remove'];
    }
}