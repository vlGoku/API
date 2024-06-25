<?php

namespace Ml\Api\Entity;

class User {
    private string $uuid;
    private string $firstname;
    private string $lastname;
    private string $email;
    private ?string $password = null;
    private string $phone;
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

    public function get_phone(): string {
        return $this->phone;
    }

    public function set_phone(string $phone): self {
        $this->phone = $phone;
        return $this;
    }

    public function get_created_at(): string {
        return $this->created_at;
    }

    public function set_created_at(string $created_at): self {
        $this->created_at = $created_at;
        return $this;
    }
}