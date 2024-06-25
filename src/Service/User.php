<?php

namespace Ml\Api\Service;
use Ml\Api\Validation\CustomValidation;
use Ml\Api\Validation\Exception\ValidationException;
use Ramsey\Uuid\Uuid;
use Ml\Api\Entity\User as UserEntity;
use Ml\Api\ORM\UserModel;

class User {
    public function __construct(){

    }

    public function create(mixed $data): array|object {
        $validate = new CustomValidation($data);
        if($validate->validate_create()){
            
            $uuid = Uuid::uuid4()->toString();
            $user_entity = new UserEntity(); 

            $user_entity->set_uuid($uuid)
                ->set_firstname($data->firstname)
                ->set_lastname($data->lastname)
                ->set_email($data->email)
                ->set_phone($data->phone)
                ->set_created_at(date('Y-m-d H:i:s'));
            
            $valid = $user_uuid = UserModel::create($user_entity);
            if($valid){
                $data->uuid = $user_uuid;
                return $data;
            }
        return [];
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
        return UserModel::getAll();
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