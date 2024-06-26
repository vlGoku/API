<?php
namespace Ml\Api\Service;
use Ml\Api\Validation\CustomValidation;
use Ml\Api\Validation\Exception\ValidationException;
use Ml\Api\Service\Exception\EmailExistsException;
use Ramsey\Uuid\Uuid;
use Ml\Api\Entity\User as UserEntity;
use Ml\Api\ORM\UserModel;
use PH7\PhpHttpResponseHeader\Http;
use PH7\JustHttp\StatusCode;

class User
{
    public function login(mixed $data){
        $validation = new CustomValidation($data);
        if($validation->validate_login()){
            return ['hello'];
        }
        throw new ValidationException('invalid login credentials');
    }
    public function create(mixed $data): array|object
    {
        $validate = new CustomValidation($data);
        if ($validate->validate_create()) {

            $uuid = Uuid::uuid4()->toString();
            $user_entity = new UserEntity();

            $user_entity->set_uuid($uuid)
                ->set_firstname($data->firstname)
                ->set_lastname($data->lastname)
                ->set_email($data->email)
                ->set_phone($data->phone)
                ->set_created_at(date('Y-m-d H:i:s'));
            //TODO: Set Password

            if (UserModel::email_exists($user_entity->get_email()));{
              throw new EmailExistsException(sprintf('Email already exists', $user_entity->get_email()));  
            };

            $valid = $user_uuid = UserModel::create($user_entity);
            if (!$valid) {
                Http::setHeadersByCode(StatusCode::BAD_REQUEST);
                return [];
            }
            $data->uuid = $user_uuid;
            return $data;
        }
        throw new ValidationException('Validation failed');
    }

    public function get(string $user_id): array|object
    {
        $validation = new CustomValidation($user_id);
        if ($validation->validateUuid()) {
            if ($user_bean = UserModel::getByUuid($user_id)) {
                //TODO: Refactor unset
                return $user_bean;
            };
            return [];
        }
        throw new ValidationException('Validation failed, uuid not valid');
    }

    public function getAll(): array|object
    {
        return UserModel::getAll();
    }

    public function update(mixed $user): array|object
    {
        $validation = new CustomValidation($user);
        if ($validation->validate_update()) {
            $user_entity = new UserEntity();
            if(!empty($user->firstname)){
                $user_entity->set_firstname($user->firstname);
            }
            if(!empty($user->lastname)){
                $user_entity->set_lastname($user->lastname);
            }
            if(!empty($user->phone)){
                $user_entity->set_phone($user->phone);
            }
            $valid = UserModel::update($user->uuid, $user_entity);
            if(!$valid){
                Http::setHeadersByCode(StatusCode::NOT_FOUND);
                return [];
            }
            return $user;
        }

        throw new ValidationException('Validation failed, wrong input data');
    }

    public function remove(string $user_uuid): bool
    {
        $vaildation = new CustomValidation($user_uuid);
        if ($vaildation->validateUuid()) {
            return UserModel::remove($user_uuid);
        }
        throw new ValidationException('Validation failed, uuid no valid');
    }


}
