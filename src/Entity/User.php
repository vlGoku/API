<?php

namespace Ml\Api\Entity;

class User {
    private string $uuid;
    private ?string $firstname = null;
    private ?string $lastname = null;
    private ?string $email = null;
    private ?string $password = null;
    private ?string $phone = null;
    private string $created_at;

    public function get_uuid(): string {
        return $this->uuid;
    }

    /**
     * Chainable
     * @param string $uuid
     * 
     * @return $this
     */

    public function set_uuid(string $uuid): self {
        $this->uuid = $uuid;

        return $this;
    }
    
    public function get_firstname(): string {
        return $this->firstname;
    }

    public function set_firstname(string $firstname): self {
        $this->firstname = $firstname;
        return $this;
    }

    public function get_lastname(): string {
        return $this->lastname;
    }

    public function set_lastname(string $lastname): self {
        $this->lastname = $lastname;
        return $this;
    }

    public function get_email(): string {
        return $this->email;
    }

    public function set_email(string $email): self {
        $this->email = $email;
        return $this;
    }

    public function get_phone(): ?string {
        return $this->phone;
    }

    public function set_phone(string $phone): self {
        $this->phone = $phone;
        return $this;
    }

    public function get_password(): string {
        return $this->password;
    }

    public function set_password(string $password): self {
        $this->password = $password;
        return $this;
    }

    public function get_created_at(): string {
        return $this->created_at;
    }

    public function set_created_at(string $created_at): self {
        $this->created_at = $created_at;
        return $this;
    }

    public function unSerialize(array $user) {
        if(!empty($user['uuid'])){
            $this->set_uuid($user['uuid']);
        }
        if(!empty($user['firstname'])){
            $this->set_firstname($user['firstname']);
        }
        if(!empty($user['lastname'])){
            $this->set_lastname($user['lastname']);
        }
        if(!empty($user['email'])){
            $this->set_email($user['email']);
        }
        if(!empty($user['phone'])){
            $this->set_phone($user['phone']);
        }
        if(!empty($user['password'])){
            $this->set_password($user['password']);
        }
        if(!empty($user['created_at'])){
            $this->set_created_at($user['created_at']);
        }
        return $this;
    }

    public function serialize(): array {
        return get_object_vars($this);
    }
}