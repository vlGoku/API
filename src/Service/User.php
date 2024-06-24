<?php

namespace Ml\Api\Service;
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
        return [
            "first_name"=> $this->firstname,
            "last_name"=> $this->lastname,
            "age"=> $this->age
        ];
    }

    public function get(mixed $data): array|object {
        return ['message' => 'hello from get'];
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