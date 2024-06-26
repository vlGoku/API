<?php

namespace Ml\Api\ORM;
use Ml\Api\Entity\User as UserEntity;
use RedBeanPHP\R;
use RedBeanPHP\RedException\SQL;

final class UserModel {
    const TABLE_NAME = "users";

    public static function create(UserEntity $data): false|string {
        $user_bean = R::dispense(self::TABLE_NAME);
        $user_bean->uuid = $data->get_uuid();
        $user_bean->firstname = $data->get_firstname();
        $user_bean->lastname = $data->get_lastname();
        $user_bean->phone = $data->get_phone();
        $user_bean->email = $data->get_email();
        $user_bean->createdAt = $data->get_created_at();
        
        try{
            $user_bean_id = R::store( $user_bean );
        } catch (SQL $e){
            return false;
        } finally {
            R::close();
        }
        $user_bean = R::load(self::TABLE_NAME, $user_bean_id);
        return $user_bean->uuid;
    }

    public static function update(string $uuid, UserEntity $user): false|string|int {
        $user_bean = R::findOne(self::TABLE_NAME, 'uuid = :uuid', ['uuid' => $uuid ]);
        if($user_bean){
            if($firstname = $user->get_firstname()){
                $user_bean->firstname = $firstname;
            }
            if($lastname = $user->get_lastname()){
                $user_bean->lastname = $lastname;
            }
            if($phone = $user->get_phone()){
                $user_bean->phone = $phone;
            }
            try{
                $user_bean_id = R::store( $user_bean );
            } catch (SQL $e){
                return false;
            } finally {
                R::close();
            }
        }
        
        return false;
    }

    public static function getAll(): array {
        $user_beans = R::findAll(self::TABLE_NAME);
        $user_exists = $user_beans && count($user_beans);
        if(!$user_exists){
            return [];
        }
        return array_map(function($bean){
            unset($bean->id);
            return $bean->export();
        }, $user_beans);
    }

    public static function getByUuid(string $uuid): ?object {
        $user = R::findOne(self::TABLE_NAME, 'uuid = :uuid', ['uuid' => $uuid ] );

        return $user;
    }

    public static function remove(string $uuid): bool {
        $user = R::findOne(self::TABLE_NAME,'uuid = :uuid', ['uuid' => $uuid ] );
        if($user){
            return (bool) R::trash( $user );
        }
        return false;
    }

}